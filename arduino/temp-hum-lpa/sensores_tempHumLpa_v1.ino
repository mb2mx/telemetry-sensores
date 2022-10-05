// ############# LIBRARIES ############### //

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#include <DHT.h>
#include <DHT_U.h>

DHT dht(D1,DHT11);
// ############# VARIABLES ############### //

const char* SSID = "Repetidor2.4"; // Network Wi-Fi
const char* PASSWORD = "Beatle99"; // Password Wifi

const String longitud = "113.2";
const String latitud = "23.1";
String BASE_URL = "http://localhost:8080/devices/sensors";


int analogica;
int valor;
int refr = 0;
int temp;
int hume;
int val = 1;


IPAddress ip(172, 16, 100, 50);   //mudar o ultimo digito
IPAddress gateway(172, 16, 100, 1);
IPAddress netmask(255, 255, 255, 0);

// ############# PROTOTYPES ############### //

void initSerial();
void initWiFi();
void initSensors();
void httpRequest(String path);

// ############### OBJECTS ################# //

WiFiClient client;
WiFiClientSecure clientSecure;

HTTPClient http;

// ############## SETUP ################# //

void setup() {
  
  initSerial();
  initWiFi();
  initSensors();
}

// ############### LOOP ################# //

void loop() {
  delay(100);

  if (WiFi.status() == WL_CONNECTED) {
      httpRequest("sensors");
  }

  Serial.println("");
  delay(10000);

}
// ############# HTTP REQUEST ################ //

void httpRequest(String path)
{
  String payload = test();

  if (!payload) {
    return;
  }

  Serial.println("##[RESULTADO]## ==> " + payload);

} 

String sendDataToServer(String path)
{
  Serial.println("[POST] /devices/sensors - Sending request...");
  Serial.println("");

//    temp = dht.readTemperature();
//    hume = dht.readHumidity();
//     Serial.println(temp);
//     Serial.println(hume);
//
//    analogica = analogRead(A0);
//    Serial.println(analogica);
//    valor = (analogica)*10000 + (temp)*100 + (hume);
// 

   Serial.println(BASE_URL);

    http.begin(client, BASE_URL);
    http.addHeader("Content-Type", "application/json");
    String body ="{\"codeClient\":\"123\",\"sensorData\":\"[]\"}";
   int httpCode = http.POST(body);
 
  if (httpCode < 0) {
    Serial.println("Request error - " + httpCode);
    return "";

  }

  if (httpCode != HTTP_CODE_OK) {
    return "";
  }

  String response =  http.getString();
  http.end();
  Serial.println(response);

  return response;
}
 

// ###################################### //

// Metodos de inicializacion

void initSerial() {
  Serial.begin(115200);
  
}

void initWiFi() {
  Serial.println("Setting configuration [Network]...");
  Serial.println("");
  delay(10);
  Serial.println("Conectandondo a: " + String(SSID));

  WiFi.begin(SSID, PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(100);
    Serial.print(".");
  }

  WiFi.config(ip, gateway, netmask); 
  Serial.println();
  Serial.print("Conected to wi-fi" + String(SSID) + " | IP => ");
  Serial.println(WiFi.localIP());
}

void initSensors() {
  dht.begin();   
}
