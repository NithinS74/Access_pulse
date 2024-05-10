#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
WiFiClient wcl;
#include <ESP8266WiFi.h>
#define ssid "Nith"
#define password "nithi9905"
String card="009009";
String URL = "http://smartlockrfid.000webhostapp.com/add_rfid_data.php";
String name="jik";
String Link;

void setup()
{

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid,password);
  Serial.begin(9600);
  delay(500);
  while(WiFi.status() != WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }
  Serial.println("\n");
  Serial.print("Connected to :");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  if(WiFi.status() == WL_CONNECTED)
  {
    HTTPClient http;
    String getData = "?carduid=" + card + "&name=" + name;
    Link = URL + getData;
    Serial.println(Link);
    http.begin(wcl,Link);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int httpCode = http.GET(); 
    Serial.println(httpCode); 
    if(httpCode==200)
      Serial.println("Value added");
    http.end();
  }
  
}
void loop()
{

}