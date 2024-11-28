#include <Arduino.h>
#include <SPI.h>
#include <MFRC522.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
#include <Adafruit_Fingerprint.h>
#include <CuteBuzzerSounds.h>

#define SS_PIN 5
#define RST_PIN 0

MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
MFRC522::MIFARE_Key key;

HardwareSerial mySerial(1);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);
uint8_t id;

const char* ssid     = "GlobeAtHome_B6DAA";
const char* password = "D00484D1";
const char* serverUrl = "http://192.168.254.200/iot-sat/endpoint/endpoint_in.php";
const char* serverUrl2 = "http://192.168.254.200/iot-sat/endpoint/check_stat.php";
const char* fpCaptureUrl = "http://192.168.254.200/iot-sat/endpoint/fp_capture.php";

byte nuidPICC[4];

uint8_t imageBuffer[534]; 
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
  // initialize lcd 
  Wire.begin();  
  lcd.init();
  lcd.backlight();

  mySerial.begin(57600, SERIAL_8N1, 16, 17);
  
  if (finger.verifyPassword())
  {
    // Print "WiFi connected" on the LCD
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("FP Sensor ready!");
    delay(1000);
    Serial.println("Fingerprint sensor is ready...");
  }
  
  testCommunication();

  SPI.begin();
  rfid.PCD_Init();
  pinMode(buzzer, OUTPUT);
  cute.init(buzzer);

  for (byte i = 0; i < 6; i++) {
    key.keyByte[i] = 0xFF;
  }

  Serial.println(F("This code scans the MIFARE Classic NUID."));


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
  lcd.print("RFID & FPScanner");
  lcd.setCursor(0, 1);
  lcd.print("ready!");
  
  // if (captureImage()) {
  //   Serial.println("Image captured successfully.");
    
  //   lcd.clear();
  //   lcd.setCursor(0, 0);
  //   lcd.print("SCANNING");
  //   lcd.setCursor(0, 1);
  //   lcd.print("Please hold ...");
  //   uint8_t imageBuffer[534] = {0}; // Adjust buffer size based on image chunk size
  //   if (retrieveImage(imageBuffer, sizeof(imageBuffer))) {
  //     sendFPToServer(imageBuffer, sizeof(imageBuffer));
  //   }
  // }
  if (captureImage()) {
    Serial.println("Image captured successfully.");
    if (retrieveImage(imageBuffer, sizeof(imageBuffer))) {
      Serial.println("Image retrieved successfully.");
      if (sendImageToServer(imageBuffer, sizeof(imageBuffer))) {
        Serial.println("Image sent to server successfully.");
      } else {
        Serial.println("Failed to send image to server.");
      }
    } else {
      Serial.println("Failed to retrieve image.");
    }
  } else {
    Serial.println("Failed to capture image.");
  }

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
      cute.play(S_CONNECTION); // in
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
  http.begin(String(serverUrl2) + "?ping=1"  + "&devcode=primaria");

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

void sendFPToServer(uint8_t* imageData, size_t imageSize) {
  
  uint8_t response[12];
  // Set up HTTPClient
  HTTPClient http;
  uint8_t command[] = {0xEF, 0x01, 0xFF, 0xFF, 0xFF, 0xFF, 0x01, 0x00, 0x03, 0x02, 0x00, 0x06};
  mySerial.write(command, sizeof(command));
  delay(100); // Wait for response

  if (mySerial.available() > 0) {
    // Read response header
    mySerial.readBytes(response, 12);

  }
  
  // Make the HTTP POST request
  http.begin(fpCaptureUrl);  // Connect to the server
  http.addHeader("Content-Type", "application/octet-stream");  // Set the content type to binary data
  
  // Send the raw binary data in the POST request
  int httpResponseCode = http.POST(response, imageSize);  // Send raw binary data

  // Handle server response
  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.println("Server Response: " + response);
  } else {
    Serial.println("Error in HTTP request, code: " + String(httpResponseCode));
  }

  // End HTTP connection
  http.end();
}


bool captureImage() {
  uint8_t command[] = {0xEF, 0x01, 0xFF, 0xFF, 0xFF, 0xFF, 0x01, 0x00, 0x03, 0x01, 0x00, 0x05};
  mySerial.write(command, sizeof(command));
  delay(100);

  if (mySerial.available() > 0) {
    uint8_t response[12];
    mySerial.readBytes(response, 12);
    return response[9] == 0x00; // Return true if the capture was successful
  }
  return false;
}

bool retrieveImage(uint8_t *buffer, size_t bufferSize) {
  uint8_t command[] = {0xEF, 0x01, 0xFF, 0xFF, 0xFF, 0xFF, 0x01, 0x00, 0x03, 0x02, 0x00, 0x06};
  mySerial.write(command, sizeof(command));
  delay(200);

  if (mySerial.available() > 0) {
    uint8_t response[12];
    mySerial.readBytes(response, 12);

    if (response[9] == 0x00) {
      size_t bytesRead = 0;
      while (bytesRead < bufferSize) {
        if (mySerial.available() > 0) {
          int chunkSize = mySerial.readBytes(buffer + bytesRead, bufferSize - bytesRead);
          bytesRead += chunkSize;
        }
      }
      Serial.println("Image retrieved successfully.");
      return true;
    } else {
      Serial.print("Error: ");
      Serial.println(response[9], HEX);
    }
  }
  return false;
}

bool sendImageToServer(uint8_t *imageData, size_t imageSize) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(fpCaptureUrl);
    http.addHeader("Content-Type", "application/octet-stream");

    // Send the image data
    int httpResponseCode = http.POST(imageData, imageSize);

    if (httpResponseCode > 0) {
      Serial.printf("HTTP Response Code: %d\n", httpResponseCode);
      String response = http.getString();
      Serial.println("Server Response: " + response);
      http.end();
      return true;
    } else {
      Serial.printf("Error Code: %d\n", httpResponseCode);
      http.end();
      return false;
    }
  } else {
    Serial.println("WiFi not connected.");
    return false;
  }
}


bool testCommunication() {
  uint8_t command[] = {0xEF, 0x01, 0xFF, 0xFF, 0xFF, 0xFF, 0x01, 0x00, 0x03, 0x01, 0x00, 0x05};
  mySerial.write(command, sizeof(command));
  delay(200);

  if (mySerial.available() > 0) {
    uint8_t response[12];
    mySerial.readBytes(response, 12);

    Serial.print("Response: ");
    for (int i = 0; i < 12; i++) {
      Serial.print(response[i], HEX);
      Serial.print(" ");
    }
    Serial.println();

    if (response[9] == 0x00) {
      Serial.println("Communication successful!");
      return true;
    } else {
      Serial.print("Error code: ");
      Serial.println(response[9], HEX);
    }
  } else {
    Serial.println("No response from sensor.");
  }
  return false;
}


// bool captureImage() {
//   uint8_t command[] = {0xEF, 0x01, 0xFF, 0xFF, 0xFF, 0xFF, 0x01, 0x00, 0x03, 0x01, 0x00, 0x05};
//   mySerial.write(command, sizeof(command));
//   delay(100); // Wait for response
  

//   if (mySerial.available() > 0) {
//     uint8_t response[12];
//     mySerial.readBytes(response, 12);
//     return (response[9] == 0x00); // 0x00 means success
//   }
//   return false;
// }

// bool retrieveImage(uint8_t *buffer, size_t bufferSize) {
//   uint8_t command[] = {0xEF, 0x01, 0xFF, 0xFF, 0xFF, 0xFF, 0x01, 0x00, 0x03, 0x01, 0x00, 0x05};
//   mySerial.write(command, sizeof(command));
//   delay(100); // Wait for response

//   // Check for sensor response
//   if (mySerial.available() > 0) {
//     // Read and print the response header
//     uint8_t response[12];
//     mySerial.readBytes(response, 12);

//     // Verify the status byte
//     if (response[9] == 0x00) {
//       // Read data size from the response header
//       int dataSize = (response[7] << 8) | response[8];
//       Serial.print("Data Size: ");
//       Serial.println(dataSize);

//       // Check buffer size
//       if (dataSize > bufferSize) {
//         Serial.println("Error: Buffer size is too small.");
//         return false;
//       }

//       // Read image data into buffer
//       int bytesRead = mySerial.readBytes(buffer, dataSize);
//       Serial.print("Bytes Read: ");
//       Serial.println(bytesRead);

//       if (bytesRead == dataSize) {
//         Serial.println("Image data retrieved successfully.");
//         return true;
//       } else {
//         Serial.println("Error: Data read mismatch.");
//       }
//     } else {
//       Serial.print("Error: Sensor returned status ");
//       Serial.println(response[9], HEX);
//     }
//   } else {
//     Serial.println("Error: No response from sensor.");
//   }
//   return false;
// }


