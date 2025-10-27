import threading
import time
import asyncio
from bleak import BleakScanner, BleakClient
import numpy as np
import tensorflow as tf
from tensorflow.keras.models import load_model
from collections import deque, defaultdict
import struct
import datetime
import requests

class attention(tf.keras.layers.Layer):
    def __init__(self, **kwargs):
        super(attention, self).__init__(**kwargs)

    def build(self, input_shape):
        self.W = self.add_weight(name = "att_weight", shape = (input_shape[-1], 1), initializer ='random_normal', trainable = True)
        self.b = self.add_weight(name = "att_bias", shape = (input_shape[1], 1), initializer ='zeros')
        super(attention, self).build(input_shape)

    def call(self, x):
        e = tf.keras.backend.tanh(tf.keras.backend.dot(x, self.W) + self.b)
        e = tf.keras.backend.squeeze(e, axis = -1)
        alpha = tf.keras.backend.softmax(e)
        alpha = tf.keras.backend.expand_dims(alpha, axis = -1)
        context = x * alpha
        context = tf.keras.backend.sum(context, axis = 1)
        return context

    def compute_output_shape(self, input_shape):
        return (input_shape[0], input_shape[-1])

# 註冊自訂層
tf.keras.utils.get_custom_objects()['attention'] = attention

model = load_model("Att+GRU.h5")
LABELS = ['Laying(躺臥)', 'Restless(躁動)', 'Stand_Up(站立)', 'Walking(行走)']

# 緩衝區與裝置管理
n_time_steps = 15
n_features = 3
accel_buffers = defaultdict(lambda: deque(maxlen=n_time_steps))
incoming_packets = defaultdict(list)
latest_labels = defaultdict(str)
connected_devices = set()

def get_target_uuids():
    url = "http://140.127.22.64/cowmis/fEnvironment/sensorManagement/getSensorUUIDs.php"  # ⬅ 請替換成實際的 URL
    try:
        response = requests.get(url)
        response.raise_for_status()  # 若不是 200 會引發 HTTPError
        data = response.json()
        return [item['uuid'].upper() for item in data if 'uuid' in item]
    except (requests.RequestException, ValueError) as e:
        print(f"Error fetching UUIDs from URL: {e}")
        return []

def insert_data(uuid,device_id, x, y, z, step, label):
    now = datetime.datetime.now().isoformat()  # 時間戳記轉為 ISO 格式（例如：2025-05-25T19:00:00）

    url = "http://140.127.22.64/cowmis/fRecord/cowActivity/sendPedometerData.php"  # ⬅ 請替換為實際的 API URL
    params = {
        "timestamp": now,
        "uuid":uuid,
        "device_id": device_id,
        "x": x,
        "y": y,
        "z": z,
        "step": step,
        "label": label
    }

    try:
        response = requests.get(url, params=params)
        response.raise_for_status()  # 若非 2xx 會引發錯誤
        print("Data inserted successfully:", response.text)
    except requests.RequestException as e:
        print("Failed to insert data:", e)

def preprocess_segment(buffer):
    return np.array(buffer, dtype=np.float32).reshape(-1, n_time_steps, n_features)

def predict_posture(segment):
    prediction = model.predict(segment).argmax(axis=1)
    return LABELS[prediction[0]]

def create_notification_callback(device_id,uuid):
    def callback(sender, data: bytearray):
        try:
            float_value = struct.unpack('<f', data)[0]
        except Exception:
            return

        if abs(float_value - 999.0) < 0.1:
            incoming_packets[device_id].clear()
        else:
            incoming_packets[device_id].append(float_value)
            if len(incoming_packets[device_id]) == 4:
                x, y, z, step = incoming_packets[device_id]
                incoming_packets[device_id].clear()
                accel_buffers[device_id].append([x, y, z])
                label = latest_labels[device_id]

                if len(accel_buffers[device_id]) == n_time_steps:
                    segment = preprocess_segment(accel_buffers[device_id])
                    label = predict_posture(segment)

                    if label != latest_labels[device_id]:
                        print(f"🚨 裝置 {device_id} 姿態變更：{latest_labels[device_id]} -> {label}")
                    latest_labels[device_id] = label

                insert_data(uuid,device_id, x, y, z, int(step), label)
                print(f"裝置 {device_id} | 姿態：{label} | 步數：{int(step)} | X:{x:.2f}, Y:{y:.2f}, Z:{z:.2f}")
    return callback

async def connect_and_listen(device_id, uuid):
    try:
        async with BleakClient(device_id) as client:
            if client.is_connected:
                print(f"已連接裝置 {device_id}")
                await client.start_notify(uuid, create_notification_callback(device_id,uuid))
                while client.is_connected:
                    await asyncio.sleep(1)
    except Exception as e:
        print(f"裝置 {device_id} 發生錯誤：{e}")
    finally:
        connected_devices.discard(device_id)

async def ble_loop():
    while True:
        try:
            print("掃描裝置中...")
            target_uuids = get_target_uuids()
            devices = await BleakScanner.discover()
            for d in devices:
                for s in d.metadata.get("uuids", []):
                    s=s.upper()
                    if s in target_uuids:
                        device_id = d.address
                        if device_id not in connected_devices:
                            connected_devices.add(device_id)
                            asyncio.create_task(connect_and_listen(device_id, s))
            await asyncio.sleep(10)
        except Exception as e:
            print(f"BLE 錯誤：{e}")
        await asyncio.sleep(10)

if __name__ == '__main__':
    asyncio.run(ble_loop())