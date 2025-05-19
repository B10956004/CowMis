#include <WiFi.h>
#include <WiFiClient.h>
#include <DHT.h>

// WiFi網絡的SSID和密碼
const char* ssid = "YOUR-WIFI-ID";
const char* password = "YOUR-PASSWORD";
const char* server = "YOUR-SERVER-ADDRESS"; // Server地址

// DHT11傳感器
#define DHTPIN 4  
#define DHTTYPE DHT22
DHT dht(DHTPIN, DHTTYPE);

WiFiClient client;

int failCounter=0;

void setup() {
  Serial.begin(9600);
  delay(1000);

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

  // 初始化DHT22傳感器
  dht.begin();
}

void loop() {
  // 讀取DHT11傳感器的濕度和溫度值
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  // 如果無法讀取到數據，則退出函數
  if (isnan(h) || isnan(t)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  float thi=9.0/5.0*t+32-0.55*(1-(h/100))*(9.0/5.0*t-26);

  
  //reconnect WiFi
  if(failCounter>=10){
    failCounter=0;
    if (client.connected()) {
    client.println("Connection closed.");
    client.stop(); // 關閉連線
    }

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
  // connent server
  if (!client.connect(server, 80)) {
    Serial.println("Connection failed");
    failCounter+=1;
    delay(500);
    return;
  }

  // send http request
  client.print("GET /cowmis/fEnvironment/dht/sendDHT.php?");
  client.print("temperature=");
  client.print(t);
  client.print("&humidity=");
  client.print(h);
  client.print("&THI=");
  client.print(thi);
  client.println(" HTTP/1.1");
  client.print("Host: ");
  client.println(server);
  client.println("Connection: close");
  client.println();

  delay(1000);
}