import serial
import struct 
from datetime import datetime
import mysql.connector
import time

import usb.core
import serial.tools.list_ports

# 找尋符合的USB HID裝置
dev = usb.core.find(idVendor=0x1a86, idProduct=0x7523)

# 若找到符合的USB HID裝置，則開始搜尋COM Port
if dev is not None:
    # 將所有COM Port列出來
    com_ports = list(serial.tools.list_ports.comports())

    # 找到符合的COM Port
    for port in com_ports:
        try:
            # 建立一個新的串列埠連線
            ser_port=port.device
            baudrate=115200
            ser = serial.Serial()
            ser.port=ser_port
            ser.baudrate=baudrate
            ser.parity=serial.PARITY_NONE
            ser.stopbits=serial.STOPBITS_ONE
            ser.bytesize=serial.EIGHTBITS
            # 透過判斷USB HID的Vendor ID和Product ID，來判斷是否為對應的裝置
            if dev.idVendor == 0x1a86 and dev.idProduct == 0x7523:
                #print(f"Device found on {port.device}")
                port=port.device
            # 關閉串列埠連線
            ser.close()
        except:
            # 忽略無法連線的COM Port
            pass


def add_data_to_mysql(data, table_name):
    # 连接 MySQL 数据库
    cnx = mysql.connector.connect(user='aecd0258', password='10956004',
                                  host='localhost', database='cowmis')
    
    # 创建游标对象
    cursor = cnx.cursor()

    # 将字典数据插入到 MySQL 表中
    columns = ', '.join(data.keys())
    values = ', '.join(['%s'] * len(data))
    query = "INSERT INTO {} ({}) VALUES ({})".format(table_name, columns, values)
    cursor.execute(query, tuple(data.values()))
    cnx.commit()

    # 关闭连接和游标
    cursor.close()
    cnx.close()

# 获取加速度数据
"""
加速度计算方法：单位 g
高位優先表示
ax=((axH<<8)|axL)/32768*16g(g 为重力加速度，可取 9.8m/s 2)
ay=((ayH<<8)|ayL)/32768*16g(g 为重力加速度，可取 9.8m/s 2)
az=((azH<<8)|azL)/32768*16g(g 为重力加速度，可取 9.8m/s 2)
忽略重力加速度常量g = 9.8
"""
def get_acceleration(data):
    signed_short_ax = struct.unpack("<h", bytes([data[3], data[2]]))[0]
    signed_short_ay = struct.unpack("<h", bytes([data[5], data[4]]))[0]
    signed_short_az = struct.unpack("<h", bytes([data[7], data[6]]))[0]
    k_acc = 16.0

    ax = signed_short_ax / 32768.0 /k_acc
    ay = signed_short_ay / 32768.0 /k_acc
    global az
    az = signed_short_az / 32768.0 /k_acc
    if ax >= k_acc:
        ax -= 2 / k_acc
    if ay >= k_acc:
        ay -= 2 / k_acc
    if az >= k_acc:
        az -= 2 / k_acc
        
    print(datetime.now())
    print("ax: {:.3f} g".format(ax))
    print("ay: {:.3f} g".format(ay))
    print("az: {:.3f} g".format(az))
    return {'ax': "{:.3f} g".format(ax), 'ay': "{:.3f} g".format(ay), 'az': "{:.3f} g".format(az)}

# 获取温度数据
def get_temperature(data):
    """
    T = ((np.int16(data[5]) << 8) | data[4]) / 100
    """
    T = struct.unpack(">h", bytes([data[9], data[8]]))[0]
    T=T / 100
    #print(datetime.now())
    print("溫度: {:.2f} °C".format(T))
    return {'temp': "{:.2f} °C".format(T)}

# 获取角速度数据
"""
wx=((wxH<<8)|wxL)/32768*2000(°/s)
wy=((wyH<<8)|wyL)/32768*2000(°/s)
wz=((wzH<<8)|wzL)/32768*2000(°/s)
"""
def get_angular_velocity(data):
    signed_short_wx = struct.unpack(">h", bytes([data[3], data[2]]))[0]
    signed_short_wy = struct.unpack(">h", bytes([data[5], data[4]]))[0]
    signed_short_wz = struct.unpack(">h", bytes([data[7], data[6]]))[0]
    k_gyro = 2000.0
    
    wx = signed_short_wx / 32768.0 * k_gyro
    wy = signed_short_wy / 32768.0 * k_gyro
    wz = signed_short_wz / 32768.0 * k_gyro
    if wx >= k_gyro:
        wx -= 2 * k_gyro
    if wy >= k_gyro:
        wy -= 2 * k_gyro
    if wz >=k_gyro:
        wz-= 2 * k_gyro
    print("wx: {:.3f} °/s".format(wx))
    print("wy: {:.3f} °/s".format(wy))
    print("wz: {:.3f} °/s".format(wz))
    return {'wx': "{:.3f} °/s".format(wx), 'wy': "{:.3f} °/s".format(wy), 'wz': "{:.3f} °/s".format(wz)}

# 获取姿态角数据
"""
滚转角（x 轴）Roll=((RollH<<8)|RollL)/32768*180(°)
俯仰角（y 轴）Pitch=((PitchH<<8)|PitchL)/32768*180(°)
偏航角（z 轴）Yaw=((YawH<<8)|YawL)/32768*180(°)
"""
def get_orientation(data):
    signed_short_roll = struct.unpack(">h", bytes([data[3], data[2]]))[0]
    signed_short_pitch = struct.unpack(">h", bytes([data[5], data[4]]))[0]
    signed_short_yaw = struct.unpack(">h", bytes([data[7], data[6]]))[0]
    k_angle = 180.0
    global az#加速度z軸
    roll = signed_short_roll / 32768.0 * k_angle
    pitch = signed_short_pitch / 32768.0 * k_angle
    yaw = signed_short_yaw / 32768.0 * k_angle
    if roll >= k_angle:
        roll -= 2 * k_angle
    if pitch >= k_angle:
        pitch -= 2 * k_angle
    if yaw >=k_angle:
        yaw-= 2 * k_angle
        
    if(abs(roll)>=177):
        az=-1+az
    if(abs(roll)<=1):
        az=1+az
        
    print("X(roll): {:.3f} °".format(roll))
    print("Y(pitch): {:.3f} °".format(pitch))
    print("Z(yaw): {:.3f} °".format(yaw))
    print("修正az: {:.3f} g".format(az))
    return {'X': "{:.3f} °".format(roll), 'Y': "{:.3f} °".format(pitch), 'Z': "{:.3f} °".format(yaw),'az': "{:.3f} g".format(az)}

#磁場數據
"""
磁场（x 轴）Hx=(( HxH<<8)| HxL)
磁场（y 轴）Hy=(( HyH <<8)| HyL)
磁场（z 轴）Hz =(( HzH<<8)| HzL)
"""
def get_magnetometer(data):
    """
    hx = (np.int16(data[3]) << 8 | data[2])
    hy = (np.int16(data[5]) << 8 | data[4])
    hz = (np.int16(data[7]) << 8 | data[6])
    """
    hx = struct.unpack(">h", bytes([data[3], data[2]]))[0]
    hy = struct.unpack(">h", bytes([data[5], data[4]]))[0]
    hz = struct.unpack(">h", bytes([data[7], data[6]]))[0]
    
    print(datetime.now())
    print("Hx: {:.2f} mG".format(hx))
    print("Hy: {:.2f} mG".format(hy))
    print("Hz: {:.2f} mG".format(hz))
    return {'hx': "{:.2f} mG".format(hx), 'hy': "{:.2f} mG".format(hy), 'hz': "{:.2f} mG".format(hz)}
    

#四元數數據
"""
Q0=((Q0H<<8)|Q0L)/32768
Q1=((Q1H<<8)|Q1L)/32768
Q2=((Q2H<<8)|Q2L)/32768
Q3=((Q3H<<8)|Q3L)/32768
"""
def get_quaternion(data):
    """
    q0 = ((np.int16(data[5]) << 8) | data[4]) / 32768
    q1 = ((np.int16(data[7]) << 8) | data[6]) / 32768
    q2 = ((np.int16(data[9]) << 8) | data[8]) / 32768
    q3 = ((np.int16(data[11]) << 8) | data[10]) / 32768
    """
    q0 = struct.unpack(">h", bytes([data[3], data[2]]))[0]
    q1 = struct.unpack(">h", bytes([data[5], data[4]]))[0]
    q2 = struct.unpack(">h", bytes([data[7], data[6]]))[0]
    q3 = struct.unpack(">h", bytes([data[9], data[8]]))[0]
    q0=q0 / 32768.0
    q1=q1 / 32768.0
    q2=q2 / 32768.0
    q3=q3 / 32768.0
    print(datetime.now())
    print("Q0: {:.4f}".format(q0))
    print("Q1: {:.4f}".format(q1))
    print("Q2: {:.4f}".format(q2))
    print("Q3: {:.4f}".format(q3))
    return {'q0': "{:.4f}".format(q0), 'q1': "{:.4f}".format(q1), 'q2': "{:.4f}".format(q2), 'q3': "{:.4f}".format(q3)}
    
# 解析数据包
def parse_data_packet(data):
    if data[0] == 0x55:
        if data[1] == 0x51 :
            return get_acceleration(data),get_temperature(data)
        elif data[1] == 0x52 :
            return get_angular_velocity(data)
        elif data[1] == 0x53 :
            return get_orientation(data)
        elif data[1] == 0x54 :
            return get_magnetometer(data)
        elif data[1] == 0x59 :
            return get_quaternion(data)
        else:
            return None
        
# 获取用户输入的串口和波特率
#port = input("请输入串口号（例如 COM1 或 /dev/ttyUSB0）：")
#baudrate = int(input("请输入波特率："))
#port="COM7" 透過usb hid尋找在哪個port
baudrate=115200
# 创建serial实例
ser = serial.Serial()
ser.port=port
ser.baudrate=baudrate
ser.parity=serial.PARITY_NONE
ser.stopbits=serial.STOPBITS_ONE
ser.bytesize=serial.EIGHTBITS

#Data={'Time':datetime.now(),'deviceName':'WT901BLE67(D03E7DA4620A)'} 5.0
Data={'Time':datetime.now(),'deviceName':'BWT901CL'}#2.0
def main():
    global Data
    # 打开串口连接
    ser.open()
    
    while True:
        if ser.in_waiting >0:
            while True:
                # 从串口读取数据51~59
                data = ser.read(11)#最大11Byte
                # 将数据转换为16进制并输出
                strData=' '.join(format(x, '02X') for x in data)
                byteArr=bytearray.fromhex(strData)
                #print('收到数据:',' '.join(format(x, '02X') for x in data))
                # 解析数据包并输出内容
                outPut=parse_data_packet(byteArr)
                if len(outPut)==2:
                    for i in outPut:
                        Data.update(i)
                else:
                    if(byteArr[0:2]==b'UY'):
                        Data.update(outPut)
                        break
                    else:
                        Data.update(outPut)
            add_data_to_mysql(Data, 'test2')
            #time.sleep(0.01)
            Data.update({'Time':datetime.now()})
           
        
if __name__ == '__main__':
    try:
        main() 
    except KeyboardInterrupt:
        if ser != None:
            ser.close()
            

        
    