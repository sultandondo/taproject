#include <WiFiS3.h>
#include <WiFiSSLClient.h>
#include <ArduinoHttpClient.h>
#include <ArduinoJson.h>

// Pin HMC472 ke Arduino UNO R4 Wifi
#define PIN_V1  7   // 16 dB
#define PIN_V2  6   //  8 dB  
#define PIN_V3  5   //  4 dB
#define PIN_V4  4   //  2 dB
#define PIN_V5  3   //  1 dB
#define PIN_V6  2   //  0.5 dB

// Setting Koneksi Wifi dan Website
char ssid[] = "SSID"; //SSID Wifi
char pass[] = "PASSWORD"; //Password Wifi
char server[] = "skylinkcalculator.space"; //Website Tujuan
int port = 443;

const float nilaiAtenuasi[6] = {16.0, 8.0, 4.0, 2.0, 1.0, 0.5};
const int pinAtenuasi[6] = {PIN_V1, PIN_V2, PIN_V3, PIN_V4, PIN_V5, PIN_V6};

int requestCount = 0;

void setup() {
  Serial.begin(9600);
  while (!Serial);

  // Setup pin HMC472
  for (int i = 0; i < 6; i++) {
    pinMode(pinAtenuasi[i], OUTPUT);
    digitalWrite(pinAtenuasi[i], HIGH); // Default HIGH
  }

  connectToWiFi();
}

void loop() {
  Serial.println("\nMengambil data dari Laravel...");

  // Reset koneksi Wifi sebelum polling
  WiFi.disconnect();
  delay(1000);
  WiFi.begin(ssid, pass);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nReconnected to WiFi!");

  // Ambil dan proses data dari Laravel
  getDataFromLaravel();

  // Delay antar polling
  delay(10000);
}



void connectToWiFi() {
  Serial.print("Connecting to WiFi...");
  while (WiFi.begin(ssid, pass) != WL_CONNECTED) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("\nConnected!");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());
}

void getDataFromLaravel() {
  Serial.println("\nMengambil data dari Laravel...");

  WiFiSSLClient wifiClient;
  HttpClient client(wifiClient, server, port);
  client.get("/getData");

  int statusCode = client.responseStatusCode();
  String response = client.responseBody();

  Serial.print("Status Code: ");
  Serial.println(statusCode);
  Serial.print("Response: ");
  Serial.println(response);

  // Jika status bukan 200 atau respons tidak mengandung data
  if (statusCode != 200 || response.indexOf("No data") != -1) {
    Serial.println("Tidak ada data/Status tidak valid.");
    client.stop();
    return;
  }

  // Parsing JSON dari respons
  StaticJsonDocument<256> doc;
  DeserializationError error = deserializeJson(doc, response);
  if (error) {
    Serial.print("JSON Parsing Error: ");
    Serial.println(error.c_str());
    client.stop();
    return;
  }

  // Ambil nilai path_loss dari JSON
  float path_loss = doc["path_loss"];
  float path_loss_downlink = doc["path_loss_downlink"];

  Serial.print("Path Loss Uplink: ");
  Serial.println(path_loss);

  // Hitung nilai attenuator
  float attenuatorValue = path_loss - 150.0;
  if (attenuatorValue < 0) attenuatorValue = 0;
  if (attenuatorValue > 31.5) attenuatorValue = 31.5;

  attenuatorValue = round(attenuatorValue * 2.0) / 2.0;

  Serial.print("Set Atenuator: ");
  Serial.print(attenuatorValue, 1);
  Serial.println(" dB");

  // Set pin atenuator
  setAttenuation(attenuatorValue);

  delay(5000);

  Serial.print("Path Loss Downlink: ");
  Serial.println(path_loss_downlink);

  // Hitung nilai attenuator
  attenuatorValue = path_loss_downlink - 150.0;
  if (attenuatorValue < 0) attenuatorValue = 0;
  if (attenuatorValue > 31.5) attenuatorValue = 31.5;

  attenuatorValue = round(attenuatorValue * 2.0) / 2.0;

  Serial.print("Set Atenuator: ");
  Serial.print(attenuatorValue, 1);
  Serial.println(" dB");

  // Set pin atenuator
  setAttenuation(attenuatorValue);

  // Tutup koneksi setelah selesai
  client.stop();
  delay(500);
}


void setAttenuation(float target_db) {
  for (int i = 0; i < 6; i++) {
    digitalWrite(pinAtenuasi[i], HIGH); // Reset semua HIGH
  }

  if (target_db <= 0.0) {
    Serial.println("Semua pin HIGH (0 dB)");
    return;
  }

  float remaining = target_db;
  Serial.print("Pin aktif: ");
  
  for (int i = 0; i < 6; i++) {
    if (remaining >= nilaiAtenuasi[i]) {
      digitalWrite(pinAtenuasi[i], LOW);
      remaining -= nilaiAtenuasi[i];
      Serial.print("V"); Serial.print(i+1); Serial.print(" ");
    }
  }

  Serial.println();
}
