import asyncio
from bleak import BleakClient
import struct
import pandas as pd
from math import isclose
from datetime import datetime

# Arduino delay(500)以上就會Timeout
# delay(500) 讀進來的第一筆資料固定少az值

address = "66:37:15:60:bd:44"  # BLE感測器的MAC地址
CHARACTERISTIC_UUID = "19B10001-E8F2-537E-4F6C-D104768A1214"  # 需要訂閱的特徵的UUID

# 定義欄位名稱
column_names = ['timestamp', 'ax', 'ay', 'az', 'gx', 'gy', 'gz']
# 建立空的 DataFrame
data_df = pd.DataFrame(columns=column_names)

data_list = []


async def run():
    global data_df
    async with BleakClient(address) as client:
        # 訂閱特徵
        await client.start_notify(CHARACTERISTIC_UUID, notification_callback)

        # 等待數據收集完成
        await asyncio.sleep(20.0)

        # 停止訂閱特徵
        await client.stop_notify(CHARACTERISTIC_UUID)

        # 將 data_df 存成 CSV 檔案
        data_df.to_csv(
            'C:/Users/User/Desktop/程式碼/python/csv/sensor_data.csv', index=False)

# 訂閱特徵後的回調函數


def notification_callback(sender, data):
    global data_list
    global data_df
    # 在這裡處理收到的數據
    f = struct.unpack('f', data)[0]
    f = ("{:.4f}".format(f))
    x = 1.0000000000
    if isclose(float(f), x, abs_tol=0.0000000001) == True:
        data_list = []  # 清空數據
    else:
        data_list.append(f)

    if len(data_list) == 6:
        print(data_list)

        # 取得目前時間
        timestamp = datetime.now()

        # 將 timestamp 和 value 存成一個 dict
        data_dict = {'timestamp': timestamp, 'ax': data_list[0], 'ay': data_list[1],
                     'az': data_list[2], 'gx': data_list[3], 'gy': data_list[4], 'gz': data_list[5]}

        # 將 dict 轉換為一個 DataFrame
        data_row = pd.DataFrame(data_dict, index=[0])

        # 將 DataFrame 加入 data_df
        data_df = pd.concat([data_df, data_row], ignore_index=True)


# 開始執行
loop = asyncio.get_event_loop()
loop.run_until_complete(run())
