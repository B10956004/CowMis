#!C:\ProgramData\Anaconda3\python.exe
#print("Content-Type: text/html\n\n")

import sys
#sys.path.append("C:\\ProgramData\\Anaconda3\\Lib\\site-packages")

import matplotlib.pyplot as plt
import pandas as pd



# 將字體換成SimHei
plt.rcParams['font.sans-serif'] = ['SimHei']
# 修復負號顯示問題
plt.rcParams['axes.unicode_minus'] = False

# 讀取 CSV 檔案，並轉換為 DataFrame
df = pd.read_csv('cowActivity0309.csv', skiprows=1, header=None)
df = df.iloc[:, :-1]
# 命名 DataFrame 的欄位名稱
df.columns = ['時間', '設備名稱', '加速度X(g)', '加速度Y(g)', '加速度Z(g)',
              '角速度X(°/s)', '角速度Y(°/s)', '角速度Z(°/s)',
              '角度X(°)', '角度Y(°)', '角度Z(°)', '磁場X(ʯt)',
              '磁場Y(ʯt)', '磁場Z(ʯt)', '溫度(℃)', '四元數0()',
              '四元數1()', '四元數2()', '四元數3()']
# 將時間欄位轉換為 Pandas 的日期時間對象
df['時間'] = pd.to_datetime(df['時間'], format=' %H:%M:%S.%f')

time = df['時間']

x_g = df['加速度X(g)']
y_g = df['加速度Y(g)']
z_g = df['加速度Z(g)']

x_α = df['角速度X(°/s)']
y_α = df['角速度Y(°/s)']
z_α = df['角速度Z(°/s)']

x_angle = df['角度X(°)']
y_angle = df['角度Y(°)']
z_angle = df['角度Z(°)']

x_ʯt = df['磁場X(ʯt)']
y_ʯt = df['磁場Y(ʯt)']
z_ʯt = df['磁場Z(ʯt)']

# 顯示 DataFrame
# print(df)

# 繪圖
fig1 = plt.figure()
plt.plot(time, x_g, label='加速度X')
plt.plot(time, y_g, label='加速度Y')
plt.plot(time, z_g, label='加速度')

# 設定圖表標題及軸標籤
plt.title('加速度')
plt.xlabel('時間')
plt.ylabel('數值')

# 設定圖例
plt.legend()

fig1.savefig('加速度.png')

# 2
fig2 = plt.figure()
plt.plot(time, x_α, label='角速度X')
plt.plot(time, y_α, label='角速度Y')
plt.plot(time, z_α, label='角速度Z')

# 設定圖表標題及軸標籤
plt.title('角速度')
plt.xlabel('時間')
plt.ylabel('數值')

# 設定圖例
plt.legend()

fig2.savefig('角速度.png')

# 3
fig3 = plt.figure()
plt.plot(time, x_angle, label='角度X')
plt.plot(time, y_angle, label='角度Y')
plt.plot(time, z_angle, label='角度Z')

# 設定圖表標題及軸標籤
plt.title('角度')
plt.xlabel('時間')
plt.ylabel('數值')

# 設定圖例
plt.legend()

fig3.savefig('角度.png')

# 4
fig4 = plt.figure()
plt.plot(time, x_ʯt, label='磁場X')
plt.plot(time, y_ʯt, label='磁場Y')
plt.plot(time, z_ʯt, label='磁場Z')

# 設定圖表標題及軸標籤
plt.title('磁場')
plt.xlabel('時間')
plt.ylabel('數值')

# 設定圖例
plt.legend()

fig4.savefig('磁場.png')

#plt.show()

sys.exit()
