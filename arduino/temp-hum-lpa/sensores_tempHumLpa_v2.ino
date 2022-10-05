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
String BASE_URL = "http://192.168.15.3:3000/";


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

String test(){
  String link = "https://soportec.net/wifi/dato1.php";
 clientSecure.setFingerprint("4A 9F 77 39 6D 87 A0 F4 21 88 93 67 E8 C9 D8 D6 70 F9 0D 40");
 String httpRequestData = "dat_o=1000";

  http.begin(clientSecure,link);     //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header

  int httpCode = http.POST(httpRequestData);            //Send the request
  String payload = http.getString();    //Get the response payload

  Serial.println(httpCode);   //Print HTTP return code
  Serial.println(payload);    //Print request response payload

  http.end();  //Close connection
  
  delay(5000);  //GET Data at every 5 seconds
 }

String sendDataToServer(String path)
{
 //http.begin(client, BASE_URL, 80, path);
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

  String url = "https://soportec.net";
  Serial.println(url);

    http.begin(client, BASE_URL, 80, path);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    client.println("GET /wifi/dato2.php HTTP/1.1");
    client.println("Host: soportec.net");
    client.println("Connection: close");
    client.println();
  String body = "id=7890&name=NTC&type=temperature&value=10";

  int httpCode = http.GET();

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

// ############# HTTP REQUEST ################ //


String getConfigDeviceFromServer(String path)
{
 //http.begin(client, BASE_URL, 80, path);


  http.begin(client,"http://www.7timer.info/bin/astro.php?lon=" + longitud + "&lat=" + latitud + "&ac=0&unit=metric&output=json");
  http.addHeader("content-type", "application/x-www-form-urlencoded");

  String body = "id=7890&name=NTC&type=temperature&value=10";

  int httpCode = http.GET();

  if (httpCode < 0) {
    Serial.println("Request error - " + httpCode);
    return "";

  }

  if (httpCode != HTTP_CODE_OK) {
    return "";
  }

  String response =  http.getString();
  http.end();

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
