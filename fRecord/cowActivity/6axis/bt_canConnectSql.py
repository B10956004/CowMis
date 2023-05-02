import asyncio
from bleak import BleakClient
import struct
import mysql.connector
from math import isclose
from datetime import datetime

address = "66:37:15:60:bd:44"  # BLE感測器的MAC地址
CHARACTERISTIC_UUID = "19B10001-E8F2-537E-4F6C-D104768A1214"  # 需要訂閱的特徵的UUID
cnx = mysql.connector.connect(user='root', password='',
                              host='localhost',
                              database='test_db')  # 填入你的mysql連線資訊
cursor = cnx.cursor()

data_list = []


async def run():
    async with BleakClient(address) as client:
        # 訂閱特徵
        await client.start_notify(CHARACTERISTIC_UUID, notification_callback)

        # 等待數據收集完成
        await asyncio.sleep(60.0)

        # 停止訂閱特徵
        await client.stop_notify(CHARACTERISTIC_UUID)

    cursor.close()
    cnx.close()

# 訂閱特徵後的回調函數


def notification_callback(sender, data):
    global data_list
    # 在這裡處理收到的數據
    f = struct.unpack('f', data)[0]
    f = ("{:.4f}".format(f))
    # data_list.append("{:.4f}".format(f))
    x = 1.00000
    if isclose(float(f), x, abs_tol=0.0001) == True:
        data_list = []  # 清空數據
    else:
        data_list.append(f)
    if len(data_list) == 6:
        data_list.insert(0,datetime.now())
        print("資料插入成功", data_list)
        # 插入數據庫
        query = ("INSERT INTO sensor_data (time,ax, ay, az, gx, gy, gz) "
                 "VALUES (%s,%s, %s, %s, %s, %s, %s)")
        cursor.execute(query, data_list)
        cnx.commit()


# 開始執行
loop = asyncio.get_event_loop()
loop.run_until_complete(run())
