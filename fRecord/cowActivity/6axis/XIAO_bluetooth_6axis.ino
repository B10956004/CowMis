#include "LSM6DS3.h"
#include "Wire.h"
#include <ArduinoBLE.h>;

//Create a instance of class LSM6DS3
LSM6DS3 myIMU(I2C_MODE, 0x6A);    //I2C device address 0x6A

// 建立藍牙服務和特徵ID
BLEService sixAxisService("19B10000-E8F2-537E-4F6C-D104768A1214");

BLEFloatCharacteristic sixAxisCharacteristic("19B10001-E8F2-537E-4F6C-D104768A1214", BLERead | BLENotify);

void setup() {
  // put your setup code here, to run once:
    Serial.begin(9600);
    //while (!Serial);
    if (myIMU.begin() != 0) {
      Serial.println("Device error");
    } else {
      Serial.println("Device OK!");
    }

   // 藍芽啟動
   if (!BLE.begin()) {
    Serial.println("starting Bluetooth® Low Energy module failed!");
    while (1);
  }
  //藍芽設定外部名稱
  BLE.setLocalName("XAIO_sixAxis");
  //設定藍芽廣播Service與特徵
  BLE.setAdvertisedService(sixAxisService);
  sixAxisService.addCharacteristic(sixAxisCharacteristic);
  // Start the service
  BLE.addService(sixAxisService);
  //開始廣播
  BLE.advertise();
  // 印出MAC位置
  Serial.print("Address: ");
  Serial.println(BLE.address());

  Serial.println("XIAO sixAxis is ready!");
  
}

void loop() {
  // put your main code here, to run repeatedly:
  //開啟連線對象
  BLEDevice central = BLE.central();
  // 如果連上了:
  if (central) {
    Serial.print("已連線到裝置: ");
    // print the central's MAC address:
    Serial.println(central.address());

    // 當與裝置持續連線時:
    while (central.connected()) {
      float ax = myIMU.readFloatAccelX();
      float ay = myIMU.readFloatAccelY();
      float az = myIMU.readFloatAccelZ();
      float gx = myIMU.readFloatGyroX();
      float gy = myIMU.readFloatGyroY();
      float gz = myIMU.readFloatGyroZ();
    //Accelerometer
      Serial.print("\nAccelerometer:\n");
      Serial.print(" X1 = ");
      Serial.println(ax, 4);
      Serial.print(" Y1 = ");
      Serial.println(ay, 4);
      Serial.print(" Z1 = ");
      Serial.println(az, 4);
    //Gyroscope
      Serial.print("\nGyroscope:\n");
      Serial.print(" X1 = ");
      Serial.println(gx, 4);
      Serial.print(" Y1 = ");
      Serial.println(gy, 4);
      Serial.print(" Z1 = ");
      Serial.println(gz, 4);
      sixAxisCharacteristic.writeValue(1);
      sixAxisCharacteristic.writeValue(ax);
      sixAxisCharacteristic.writeValue(ay);
      sixAxisCharacteristic.writeValue(az);
      sixAxisCharacteristic.writeValue(gx);
      sixAxisCharacteristic.writeValue(gy);
      sixAxisCharacteristic.writeValue(gz);
      delay(500);
    }
    // 斷線時
    Serial.print(F("Disconnected from central: "));
    Serial.println(central.address());
    //重新廣播
    BLE.advertise();
    Serial.println("XIAO sixAxis restart!");
  }
  delay(100);
}
