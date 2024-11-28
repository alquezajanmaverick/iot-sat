#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <LiquidCrystal_I2C.h>
#include <CuteBuzzerSounds.h>

#define SS_PIN 5
#define RST_PIN 0

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

const char* ssid     = "GlobeAtHome_B6DAA";
const char* password = "D00484D1";
const char* serverUrl = "http://192.168.254.160/iot-sat/endpoint/endpoint_out.php";
const char* serverUrl2 = "http://192.168.254.160/iot-sat/endpoint/check_stat.php";

byte nuidPICC[4];

// LCD setup
int lcdColumns = 16;
int lcdRows = 2;
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);

// for ping
unsigned long lastPingTime = 0;
unsigned long pingInterval = 5000;

// for buzzer
const int buzzer =  13;

void setup() {
  Serial.begin(9600);
  SPI.begin();
  rfid.PCD_Init();
  pinMode(buzzer, OUTPUT);
  cute.init(buzzer);

  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }

  Serial.println(F("This code scans the MIFARE Classic NUID."));

  // initialize lcd 
  lcd.init();
  lcd.backlight();

  // Connect to WiFi
  Serial.println("Connecting to WiFi...");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Connecting...");
  }
  Serial.println("\nWiFi connected");

  // Initialize last ping time
  lastPingTime = millis();

  // Print "WiFi connected" on the LCD
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("WiFi Connected");
  cute.play(S_HAPPY_SHORT);
  delay(1000);
}

void loop() {
  delay(300);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("RFID Scanner");
  lcd.setCursor(0, 1);
  lcd.print("is ready!");

  // Check if it's time to send a ping
  unsigned long currentMillis = millis();
  if (currentMillis - lastPingTime >= pingInterval) {
    sendPingToServer();
    lastPingTime = currentMillis; // Update last ping time
  }

  if (!rfid.PICC_IsNewCardPresent() || !rfid.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  String cardID = "";
  for (byte i = 0; i < rfid.uid.size; i++) {
    cardID += String(rfid.uid.uidByte[i], HEX);
  }
  cardID.toUpperCase();
  Serial.println("Card ID: " + cardID);

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Card ID:");
  lcd.setCursor(0, 1);
  lcd.print(cardID);

  String response = sendToServer(cardID);
  Serial.println("Response from server: " + response);

  // Parse JSON response
  DynamicJsonDocument doc(512); // Adjust the size according to your JSON response
  deserializeJson(doc, response);

  // Check if the response contains the status
  if (doc.containsKey("status")) {
    String status = doc["status"];
    Serial.println("Status: " + status);

    // If the response is success, print additional data
    if (status == "success") {
      String successMessage = doc["message"];
      String firstName = doc["firstName"];
      String lastName = doc["lastName"];
      String lcdMessage = doc["lcdMessage"];
      Serial.println(successMessage);
      Serial.println("First Name: " + firstName);
      Serial.println("Last Name: " + lastName);
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print(lcdMessage);
      lcd.setCursor(0, 1);
      lcd.print(firstName + " " + lastName);
      cute.play(S_DISCONNECTION); // out
    } else if (status == "error") {
      String errorMessage = doc["message"];
      String lcdMessage = doc["lcdMessage"];
      Serial.println("Error: " + errorMessage);
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print(lcdMessage);
      cute.play(S_OHOOH2); // error
    }
  }

  rfid.PICC_HaltA();
  rfid.PCD_StopCrypto1();
  delay(1500);
}

String sendToServer(String cardID) {
  HTTPClient http;

  http.begin(serverUrl);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String postData = "card_id=" + cardID;

  int httpResponseCode = http.POST(postData);

  String response = "";
  if(httpResponseCode > 0) {
    if (http.getSize() > 0) {
      response = http.getString();
    }
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
  } else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Server IP error!");
    cute.play(S_CONFUSED);
  }

  http.end();
  return response;
}

void sendPingToServer() {
  HTTPClient http;

  // Your PHP endpoint URL for sending ping
  http.begin(String(serverUrl2) + "?ping=1"  + "&devcode=exitus");

  // Send the GET request
  int httpResponseCode = http.GET();

  // Check for errors
  if(httpResponseCode > 0) {
    // Serial.print("Ping sent. HTTP Response code: ");
    // Serial.println(httpResponseCode);
  } else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }

  // Free resources
  http.end();
}
