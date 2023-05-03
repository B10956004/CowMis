#include <LWiFi.h>
#include <WiFiClient.h>
#include <DHT.h>
#include <Arduino.h>
#include <U8g2lib.h>
//引入套件
#ifdef U8X8_HAVE_HW_SPI
#include <SPI.h>
#endif
#ifdef U8X8_HAVE_HW_I2C
#include <Wire.h>
#endif

U8G2_SSD1306_128X64_NONAME_F_HW_I2C OLEDScreen(U8G2_R0,SCL,SDA,U8X8_PIN_NONE);//OLED螢幕

// WiFi網絡的SSID和密碼
const char* ssid = "YOUR-WIFI-ID";
const char* password = "YOUR-PASSWORD";
const char* server = "YOUR-SERVER-ADDRESS"; // 伺服器地址

// DHT11傳感器
#define DHTPIN 5
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

WiFiClient client;

int failCounter=0;//重新連線

bool flag=true;//按鈕狀態

void setup() {
  Serial.begin(9600);
  // 連接WiFi網絡
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  // 初始化DHT11傳感器
  dht.begin();
  // 讀取DHT11傳感器的濕度和溫度值
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  // 如果無法讀取到數據，則退出函數
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  
  //初始化OLED螢幕
  OLEDScreen.begin();
  //OLEDScreen Display
  OLEDScreen.clearBuffer();//清緩存面板訊息
  OLEDScreen.setFont(u8g2_font_unifont_t_chinese1);//設定字體
  OLEDScreen.drawStr(0,10,"Temp: "); //輸出文字
  OLEDScreen.setCursor(50,10); //設定準備輸出的座標位置
  OLEDScreen.print(t);//輸出
  OLEDScreen.drawStr(100,10,"°C");
  OLEDScreen.drawStr(0,30,"Humi: "); 
  OLEDScreen.setCursor(50,30);
  OLEDScreen.print(h);
  OLEDScreen.drawStr(100,30,"%");
  OLEDScreen.sendBuffer();
   
  //按鈕
  pinMode(7, INPUT);
}

void loop() {
  //按鈕
  int button=digitalRead(7);
  
  // 讀取DHT11傳感器的濕度和溫度值
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  // 如果無法讀取到數據，則退出函數
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  //control oled screen display
  if(button==0){
    delay(10);
    if(button==0){
      flag=!flag;
     }
    }
  if(flag){
      //OLEDScreen Display
      OLEDScreen.clearBuffer();//清緩存面板訊息
      OLEDScreen.setFont(u8g2_font_unifont_t_chinese1);//設定字體
      OLEDScreen.drawStr(0,10,"Temp: "); //輸出文字
      OLEDScreen.setCursor(50,10); //設定準備輸出的座標位置
      OLEDScreen.print(t);//輸出
      OLEDScreen.drawStr(100,10,"°C");
      OLEDScreen.drawStr(0,30,"Humi: "); 
      OLEDScreen.setCursor(50,30);
      OLEDScreen.print(h);
      OLEDScreen.drawStr(100,30,"%");
      OLEDScreen.sendBuffer();
      }
  else{
      OLEDScreen.clearBuffer();//清緩存面板訊息
      OLEDScreen.sendBuffer();
      }

  //reconnect WiFi
  if(failCounter>=10){
    failCounter=0;
    if (client.connected()) {
    client.println("Connection closed.");
    client.stop(); // 關閉連線
    }
    delay(500);
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }
    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
  }
  
  // connect WebServer
  if (!client.connect(server, 80)) {
    Serial.println("Connection failed");
    OLEDScreen.drawStr(0,50,"Connection failed");
    OLEDScreen.sendBuffer();
    failCounter+=1;
    delay(500);
    return;
  }
  
  // send http request
  client.print("GET /CowMis/fEnvironment/dht/sendDHT.php?");
  client.print("temperature=");
  client.print(t);
  client.print("&humidity=");
  client.print(h);
  client.println(" HTTP/1.1");
  client.print("Host: ");
  client.println(server);
  client.println("Connection: close");
  client.println();

  delay(1000);
}