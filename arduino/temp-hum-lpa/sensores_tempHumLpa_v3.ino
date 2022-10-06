// ############# LIBRARIES ############### //

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>
#include <DHT.h>
#include <DHT_U.h>

DHT dht(D1, DHT11);

// ############# VARIABLES ############### //

const char *SSID = "A50"; // Network Wi-Fi
const char *PASSWORD = "12345678"; // Password Wifi

String BASE_URL = "https://soportec.net";

// Pins
int sensorPin = A0;

String codeClient="C-HRAEB";
String codeDevice="D-HRAEB";
int timeToRequest =1;


//IPAddress ip(172, 16, 100, 52); // mudar o ultimo digito
//IPAddress gateway(172, 16, 100, 1);
//IPAddress netmask(255, 255, 255, 0);

// ############# PROTOTYPES ############### //

void initSerial();
void initWiFi();
void initSensors();
void httpRequest(String path);

// ############### OBJECTS ################# //

WiFiClient client;             // Declare object of class WiFiClient
WiFiClientSecure clientSecure; // Declare object of class WiFiClientSecure ...Secure Connection

HTTPClient http; // Declare object of class HTTPClient

// ############## SETUP ################# //

void setup()
{

  initSerial();
  initWiFi();
  initSensors();
}

// ############### LOOP ################# //

void loop()
{
  delay(100);

  if (WiFi.status() == WL_CONNECTED)
  {
    httpRequest("/sensores-qa/php/index.php/devices/sensores");
  }else{
    initWiFi();
    }
  

  Serial.println("Wainting time to request");

  delay(timeToRequest * 60 * 1000);
}
// ############# HTTP REQUEST ################ //

void httpRequest(String path)
{
  String payload = sendDataToServer(path);

  if (!payload)
  {
    return;
  }

  Serial.println("##[RESULTADO]## ==> " + payload);
 }

// ############# HTTP SEND_DATA_TO_SERVER ################ //

String sendDataToServer(String path)
{
  Serial.println("[POST] /devices/sensors - Sending request...");
  Serial.println("");

  String requestBody = serializeComplex();
  if (requestBody == "")
  {
    Serial.println("Error to read Data");
    return "";
  }

  Serial.println(BASE_URL + path);
  clientSecure.setFingerprint("4A 9F 77 39 6D 87 A0 F4 21 88 93 67 E8 C9 D8 D6 70 F9 0D 40");
  http.begin(clientSecure, BASE_URL + path);
  http.addHeader("Content-Type", "application/json");
  
  int httpCode = http.POST(requestBody);

  if (httpCode < 0)
  {
    Serial.println("Request error - " + httpCode);
    return "";
  }

  if (httpCode != HTTP_CODE_OK)
  {
    return "";
  }

  String response = http.getString();
  http.end();
  Serial.println(response);

  return response;
}

// ############# INIT METHODS ################ //

void initSerial()
{
  // Serial
  Serial.begin(115200);
}

void initWiFi()
{
  Serial.println("Setting configuration [Network]...");
  Serial.println("");
  delay(10);
  Serial.println("Conectandondo a: " + String(SSID));

  WiFi.begin(SSID, PASSWORD); // Connect to your WiFi router

  // Wait for connection
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(100);
    Serial.print(".");
  }

  // Config IP address to your ESP
  //WiFi.config(ip, gateway, netmask);

  // If connection successful show IP address in serial monitor
  Serial.println();
  Serial.print("Conected to wi-fi" + String(SSID) + " | IP => ");
  Serial.println(WiFi.localIP());
}

void initSensors()
{

  // Init DHT
  dht.begin();
}

String serializeComplex()
{
  
  float analogica = 0;
  // Reading temperature and humidity and analog
  float temp = dht.readTemperature();
  float hume = dht.readHumidity();
  // Reading from analog sensor
  analogica = analogRead(sensorPin)*0.1;

  if (isnan(hume) && isnan(temp)) {
     Serial.println("Failed to read from DHT sensor!");
     temp=0;
     hume=0;
   }

  String json;
  StaticJsonDocument<300> doc;
  doc["codeClient"] = codeClient;
  doc["codeDevice"] = codeDevice;

  StaticJsonDocument<300> tempDoc;
  tempDoc["codSensor"] = "S-TEMP";
  tempDoc["value"] = temp;
  StaticJsonDocument<300> humeDoc;
  humeDoc["codSensor"] = "S-HUM";
  humeDoc["value"] = hume;
  StaticJsonDocument<300> analogicaDoc;
  analogicaDoc["codSensor"] = "S-CLP";
  analogicaDoc["value"] = analogica;

  JsonArray arr = doc.createNestedArray("sensorData");
  arr.add(tempDoc);
  arr.add(humeDoc);
  arr.add(analogicaDoc);

  serializeJson(doc, json);
  Serial.println(json);
  return json;
}
