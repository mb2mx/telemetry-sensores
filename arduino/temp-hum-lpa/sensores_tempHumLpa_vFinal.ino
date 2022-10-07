// ############# LIBRARIES ############### //

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>
#include <DHT.h>
#include <DHT_U.h>

#define DHTTYPE DHT11   // DHT 11
//#define DHTTYPE DHT22   // DHT 22  
DHT dht(D1, DHTTYPE);

// ############# VARIABLES ############### //

const char *SSID = "Repetidor2.4"; // Network Wi-Fi
const char *PASSWORD = "Beatle99"; // Password Wifi

String BASE_URL = "https://soportec.net";

// Pins
int sensorPin = A0;

String codeClient="C-HAP";
String codeDevice="D-HAP";
int timeToRequest =25;


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

  int numAverage=10;
  float averageDiv=10;
  Serial.println("Average ...");
  
  float temp = 0 ;
  float hume = 0 ;
  float analog = 0;
   while(numAverage > 0) { 
    
     analog = analog+ analogRead(sensorPin);
     temp = temp+ dht.readTemperature();;
     hume = hume+ dht.readHumidity();

    //Serial.println("Analog");
    // Serial.print(analog);
    //Serial.println("Temp");
    //Serial.print(temp);

    //  Serial.println("Hume");
    //  Serial.print(hume);

     if (isnan(hume) && isnan(temp)) {
        Serial.println("Failed to read from DHT sensor!");
        temp=temp+0;
        hume=hume +0;
    }

     numAverage--;
     delay(100);

}
  float averageTemp = temp / averageDiv;
  float averageHum = hume / averageDiv;
  float averageAnalog = analog / averageDiv;

  Serial.println("#################################");
   
  //float analogica = 0;
  // Reading temperature and humidity and analog
  //float temp = dht.readTemperature();
  //float hume = dht.readHumidity();
  // Reading from analog sensor
  //analogica = analogRead(sensorPin)*0.1;

 

  String json;
  StaticJsonDocument<300> doc;
  doc["codeClient"] = codeClient;
  doc["codeDevice"] = codeDevice;

  StaticJsonDocument<300> tempDoc;
  tempDoc["codSensor"] = "S-TEMP";
  tempDoc["value"] = averageTemp;
  StaticJsonDocument<300> humeDoc;
  humeDoc["codSensor"] = "S-HUM";
  humeDoc["value"] = averageHum;
  StaticJsonDocument<300> analogicaDoc;
  analogicaDoc["codSensor"] = "S-CLP";
  analogicaDoc["value"] = averageAnalog;

  JsonArray arr = doc.createNestedArray("sensorData");
  arr.add(tempDoc);
  arr.add(humeDoc);
  arr.add(analogicaDoc);

  serializeJsonPretty(doc, json);
  Serial.println(json);
  return json;
}
