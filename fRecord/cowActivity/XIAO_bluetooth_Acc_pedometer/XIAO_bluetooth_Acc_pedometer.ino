#include "LSM6DS3.h"
#include "Wire.h"
#include <ArduinoBLE.h>;
#include <U8x8lib.h>

#define CLEAR_STEP      true
#define NOT_CLEAR_STEP  false

U8X8_SSD1306_128X64_NONAME_HW_I2C u8x8(/* clock=*/ PIN_WIRE_SCL, /* data=*/ PIN_WIRE_SDA, /* reset=*/ U8X8_PIN_NONE);   // OLEDs without Reset of the Display

//Create a instance of class LSM6DS3
LSM6DS3 myIMU(I2C_MODE, 0x6A);    //I2C device address 0x6A

// 建立藍牙服務和特徵ID
BLEService AccService("19B10001-E8F2-537E-4F6C-D104768A1214");

BLEFloatCharacteristic AccCharacteristic("19B10001-E8F2-537E-4F6C-D104768A1214", BLERead | BLENotify);

void setup() {
  // put your setup code here, to run once:
    Serial.begin(9600);
    u8x8.begin();
    u8x8.setFlipMode(1);
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
  BLE.setLocalName("XAIO_Accelerometer");
  //設定藍芽廣播Service與特徵
  BLE.setAdvertisedService(AccService);
  AccService.addCharacteristic(AccCharacteristic);
  // Start the service
  BLE.addService(AccService);
  //開始廣播
  BLE.advertise();
  // 印出MAC位置
  Serial.print("Address: ");
  Serial.println(BLE.address());

  Serial.println("XIAO Accelerometer is ready!");

  if (0 != config_pedometer(NOT_CLEAR_STEP)) {
       Serial.println("Configure pedometer fail!");
    }
  Serial.println("Success to Configure pedometer!");
  
  u8x8.setFont(u8x8_font_chroma48medium8_r);   // choose a suitable font
}

void loop() {
  u8x8.setCursor(0, 0);
  u8x8.print("TotalStep:");
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
      uint8_t dataByte = 0;
      uint16_t stepCount = 0;
      float ax = myIMU.readFloatAccelX();
      float ay = myIMU.readFloatAccelY();
      float az = myIMU.readFloatAccelZ();
      
    //pedometer
      myIMU.readRegister(&dataByte, LSM6DS3_ACC_GYRO_STEP_COUNTER_H);
      stepCount = (dataByte << 8) & 0xFFFF;

      myIMU.readRegister(&dataByte, LSM6DS3_ACC_GYRO_STEP_COUNTER_L);
      stepCount |=  dataByte;
      u8x8.setCursor(0, 0);
      u8x8.print("TotalStep:");
      u8x8.print(stepCount);
      
    //Accelerometer
      Serial.print("\nAccelerometer:\n");
      Serial.print(" X1 = ");
      Serial.println(ax, 4);
      u8x8.setCursor(0, 10);
      u8x8.print("X1 = ");
      u8x8.print(ax);
      Serial.print(" Y1 = ");
      Serial.println(ay, 4);
      u8x8.setCursor(0, 20);
      u8x8.print("Y1 = ");
      u8x8.print(ay);
      Serial.print(" Z1 = ");
      Serial.println(az, 4);
      u8x8.setCursor(0, 30);
      u8x8.print("Z1 = ");
      u8x8.print(az);
      AccCharacteristic.writeValue(999);
      AccCharacteristic.writeValue(ax);
      AccCharacteristic.writeValue(ay);
      AccCharacteristic.writeValue(az);
      AccCharacteristic.writeValue(stepCount);
      delay(100);
    }
    // 斷線時
    Serial.print(F("Disconnected from central: "));
    Serial.println(central.address());
    //重新廣播
    BLE.advertise();
    Serial.println("XIAO Accelerometer restart!");
  }
  delay(100);
}

//Setup pedometer mode
int config_pedometer(bool clearStep) {
    uint8_t errorAccumulator = 0;
    uint8_t dataToWrite = 0;  //Temporary variable

    //Setup the accelerometer******************************
    dataToWrite = 0;
    dataToWrite |= LSM6DS3_ACC_GYRO_FS_XL_8g;
    dataToWrite |= LSM6DS3_ACC_GYRO_ODR_XL_26Hz;

    // Step 1: Configure ODR-26Hz and FS-8g
    errorAccumulator += myIMU.writeRegister(LSM6DS3_ACC_GYRO_CTRL1_XL, dataToWrite);

    //Setup the gyroscope**********************************
    dataToWrite = 0;
    dataToWrite |= LSM6DS3_ACC_GYRO_FS_G_500dps;
    dataToWrite |= LSM6DS3_ACC_GYRO_ODR_G_208Hz;

    // Step 2: Configure ODR-208Hz and FS-250dps
    errorAccumulator += myIMU.writeRegister(LSM6DS3_ACC_GYRO_CTRL2_G, dataToWrite);

    // Step 3: Set bit Zen_G, Yen_G, Xen_G, FUNC_EN, PEDO_RST_STEP(1 or 0)
    if (clearStep) {
        errorAccumulator += myIMU.writeRegister(LSM6DS3_ACC_GYRO_CTRL10_C, 0x3E);
    } else {
        errorAccumulator += myIMU.writeRegister(LSM6DS3_ACC_GYRO_CTRL10_C, 0x3C);
    }

    // Step 4:  Enable pedometer algorithm
    errorAccumulator += myIMU.writeRegister(LSM6DS3_ACC_GYRO_TAP_CFG1, 0x40);

    //Step 5: Step Detector interrupt driven to INT1 pin, set bit INT1_FIFO_OVR
    errorAccumulator += myIMU.writeRegister(LSM6DS3_ACC_GYRO_INT1_CTRL, 0x10);

    return errorAccumulator;
}
