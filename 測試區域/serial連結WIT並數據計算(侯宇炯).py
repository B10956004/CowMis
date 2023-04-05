import serial
import struct 
from datetime import datetime
import mysql.connector

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
    az = signed_short_az / 32768.0 /k_acc
    if ax >= k_acc:
        ax -= 2 / k_acc
    if ay >= k_acc:
        ay -= 2 / k_acc
    if az >= k_acc:
        az -= 2 / k_acc
        
    #計算az+1 or -1  
    signed_short_roll = struct.unpack(">h", bytes([data[15], data[14]]))[0]
    k_angle = 180.0
    roll = signed_short_roll / 32768.0 * k_angle
    if roll >= k_angle:
        roll -= 2 * k_angle
    """
    if abs(roll)>=160:
        az-=1
    else:
        az+=1
    """
    
    
    print(datetime.now())
    print("ax: {:.3f} g".format(ax))
    print("ay: {:.3f} g".format(ay))
    print("az: {:.3f} g".format(az))
    return {'ax': "{:.3f} g".format(ax), 'ay': "{:.3f} g".format(ay), 'az': "{:.3f} g".format(az)}

# 获取角速度数据
"""
wx=((wxH<<8)|wxL)/32768*2000(°/s)
wy=((wyH<<8)|wyL)/32768*2000(°/s)
wz=((wzH<<8)|wzL)/32768*2000(°/s)
"""
def get_angular_velocity(data):
    signed_short_wx = struct.unpack(">h", bytes([data[9], data[8]]))[0]
    signed_short_wy = struct.unpack(">h", bytes([data[11], data[10]]))[0]
    signed_short_wz = struct.unpack(">h", bytes([data[13], data[12]]))[0]
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
    signed_short_roll = struct.unpack(">h", bytes([data[15], data[14]]))[0]
    signed_short_pitch = struct.unpack(">h", bytes([data[17], data[16]]))[0]
    signed_short_yaw = struct.unpack(">h", bytes([data[19], data[18]]))[0]
    k_angle = 180.0
    
    roll = signed_short_roll / 32768.0 * k_angle
    pitch = signed_short_pitch / 32768.0 * k_angle
    yaw = signed_short_yaw / 32768.0 * k_angle
    if roll >= k_angle:
        roll -= 2 * k_angle
    if pitch >= k_angle:
        pitch -= 2 * k_angle
    if yaw >=k_angle:
        yaw-= 2 * k_angle
    print("X(roll): {:.3f} °".format(roll))
    print("Y(pitch): {:.3f} °".format(pitch))
    print("Z(yaw): {:.3f} °".format(yaw))
    return {'X': "{:.3f} °".format(roll), 'Y': "{:.3f} °".format(pitch), 'Z': "{:.3f} °".format(yaw)}

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
    q0 = struct.unpack(">h", bytes([data[5], data[4]]))[0] / 32768
    q1 = struct.unpack(">h", bytes([data[7], data[6]]))[0] / 32768
    q2 = struct.unpack(">h", bytes([data[9], data[8]]))[0] / 32768
    q3 = struct.unpack(">h", bytes([data[11], data[10]]))[0] / 32768
    print(datetime.now())
    print("Q0: {:.4f}".format(q0))
    print("Q1: {:.4f}".format(q1))
    print("Q2: {:.4f}".format(q2))
    print("Q3: {:.4f}".format(q3))
    return {'q0': "{:.4f}".format(q0), 'q1': "{:.4f}".format(q1), 'q2': "{:.4f}".format(q2), 'q3': "{:.4f}".format(q3)}
    

# 获取温度数据
def get_temperature(data):
    """
    T = ((np.int16(data[5]) << 8) | data[4]) / 100
    """
    T = struct.unpack(">h", bytes([data[5], data[4]]))[0] / 100
    print(datetime.now())
    print("溫度: {:.2f} °C".format(T))
    return {'temp': "{:.2f} °C".format(T)}

# 获取電池数据
def get_battery_data(data):
    Battery_bytes = data[4:6]
    Battery_bytes =reversed(Battery_bytes)
    Battery = int.from_bytes(Battery_bytes, byteorder="big", signed=False)
    print(Battery)
    print(datetime.now())
    if Battery > 830:
        print("电量为100%")
        return {'Battery': '100%'}
    elif 750 <= Battery <= 830:
        print("电量为75%")
        return {'Battery': '75%'}
    elif 715 <= Battery < 750:
        print("电量为50%")
        return {'Battery': '50%'}
    elif 675 <= Battery < 715:
        print("电量为25%")
        return {'Battery': '25%'}
    else:
        print("电量为0%")
        return {'Battery': '0%'}

# 解析数据包
def parse_data_packet(data):
    if data[0] == 0x55 and data[1] == 0x71:
        if data[2] == 0x3A and data[3] == 0x00:
            return get_magnetometer(data)
        elif data[2] == 0x51 and data[3] == 0x00:
            return get_quaternion(data)
        elif data[2] == 0x40 and data[3] == 0x00:
            return get_temperature(data)
        elif data[2] == 0x64 and data[3] == 0x00:
            return get_battery_data(data)
        else:
            return None
    else:
        if data[0] == 0x55 and data[1] == 0x61:
            return get_acceleration(data),get_angular_velocity(data),get_orientation(data)
        else:
            return None

def read_mag_data():
    while True:
        # 向串口发送读取磁场数据指令
        ser.write(bytearray.fromhex('FF AA 27 3A 00'))
        #time.sleep(0.1)
        if ser.in_waiting >0:
            # 从串口读取数据
            data = ser.read(20)  # 最大20Byte
            # 将数据转换为16进制并输出
            byteArr = bytearray.fromhex(' '.join(format(x, '02X') for x in data))
            if byteArr[0:4] == b'Uq:\x00':
                print('收到磁场数据:', ' '.join(format(x, '02X') for x in data))
                # 解析数据包并输出内容
                outPut=parse_data_packet(byteArr)
                Data.update(outPut)
                break
            else:
                continue
                
def read_quaternion_data():
    while True:
        # 向串口发送读取四元素数据指令
        ser.write(bytearray.fromhex('FF AA 27 51 00'))
        #time.sleep(0.1)
        if ser.in_waiting >0:
            # 从串口读取数据
            data = ser.read(20)  # 最大20Byte
            # 将数据转换为16进制并输出
            byteArr = bytearray.fromhex(' '.join(format(x, '02X') for x in data))
            if byteArr[0:4] == b'UqQ\x00':
                print('收到四元素数据:', ' '.join(format(x, '02X') for x in data))
                # 解析数据包并输出内容
                outPut=parse_data_packet(byteArr)
                Data.update(outPut)
                break
            else:
                continue
        

def read_temperature_data():
    while True:
        # 向串口发送读取温度数据指令
        ser.write(bytearray.fromhex('FF AA 27 40 00'))
        #time.sleep(0.1)
        if ser.in_waiting >0:
            # 从串口读取数据
            data = ser.read(20)  # 最大20Byte
            # 将数据转换为16进制并输出
            byteArr = bytearray.fromhex(' '.join(format(x, '02X') for x in data))
            if byteArr[0:4] == b'Uq@\x00':
                print('收到温度数据:', ' '.join(format(x, '02X') for x in data))
                # 解析数据包并输出内容
                outPut=parse_data_packet(byteArr)
                Data.update(outPut)
                break
            else:
                continue
        

def read_battery_data():
    while True:
        # 向串口发送读取温度数据指令
        ser.write(bytearray.fromhex('FF AA 27 64 00'))
        #time.sleep(0.1)
        if ser.in_waiting >0:
            # 从串口读取数据
            data = ser.read(20)  # 最大20Byte
            # 将数据转换为16进制并输出
            byteArr = bytearray.fromhex(' '.join(format(x, '02X') for x in data))
            if byteArr[0:4] == b'Uqd\x00':
                print('收到電池数据:', ' '.join(format(x, '02X') for x in data))
                # 解析数据包并输出内容
                outPut=parse_data_packet(byteArr)
                Data.update(outPut)
                break
            else:
                continue

# 获取用户输入的串口和波特率
#port = input("请输入串口号（例如 COM1 或 /dev/ttyUSB0）：")
#baudrate = int(input("请输入波特率："))
port="COM7"
baudrate=115200
# 创建serial实例
ser = serial.Serial()
ser.port=port
ser.baudrate=baudrate
ser.parity=serial.PARITY_NONE
ser.stopbits=serial.STOPBITS_ONE
ser.bytesize=serial.EIGHTBITS

Data={'Time':datetime.now(),'deviceName':'WT901BLE67(D03E7DA4620A)'}

def main():
    global Data
    # 打开串口连接
    ser.open()
    while True:
        
        read_battery_data()#有BUG?
        read_mag_data()#計算錯誤
        read_temperature_data() 
        read_quaternion_data() 
        
        while True:
            if ser.in_waiting >0:
                # 从串口读取数据
                data = ser.read(20)#最大20Byte
                # 将数据转换为16进制并输出
                strData=' '.join(format(x, '02X') for x in data)
                byteArr=bytearray.fromhex(strData)
                if byteArr[0:2] == b'Ua':
                    print('收到数据:',' '.join(format(x, '02X') for x in data))
                    # 解析数据包并输出内容
                    outPut=parse_data_packet(byteArr)
                    for i in outPut:
                        Data.update(i)
                    add_data_to_mysql(Data, 'test')
                    Data.update({'Time':datetime.now()})
                    break
                else:
                    continue
        
if __name__ == '__main__':
    try:
        main()
    except KeyboardInterrupt:
        if ser != None:
            ser.close()

        
    