
#include <Wire.h>
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>



/* Set these to your desired credentials. */
const char *ssid = "HOLOGRAM2";  //ENTER YOUR WIFI SETTINGS
const char *password = "untukapa?";

//Web/Server address to read/write from 
const char *host = "simbatproject.000webhostapp.com";
const int httpsPort = 443;  //HTTPS= 443 and HTTP = 80

//SHA1 finger print of certificate use web browser to view and copy
const char fingerprint[] PROGMEM = "5B FB D1 D4 49 D3 0F A9 C6 40 03 34 BA E0 24 05 AA D2 E2 01";
String data, bat1, bat2, bat3, bat4;

void setup() {
  Serial.begin(9600);
 
  Serial.println("Approximate your card to the reader...");
  Serial.println();
  
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //Only Station No AP, This line hides the viewing of ESP as wifi hotspot
  
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println(""); 
  Serial.print("Connecting");
 
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
   
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP

  
}

void loop() {
  while (Serial.available() > 0) {
    data = Serial.readStringUntil('\n');
    data.trim();
    bat1 = getValue(data, '|', 0);
    bat2 = getValue(data, '|', 1);
    bat3 = getValue(data, '|', 2);
    bat4 = getValue(data, '|', 3);

    sendPostData(bat1,bat2,bat3,bat4); 

 
  }  
  
}


void sendPostData(String s1, String s2, String s3, String s4){
  s1.trim();  
  s2.trim();  
  s3.trim();  
  s4.trim();  
  WiFiClientSecure httpsClient;    //Declare object of class WiFiClient

  Serial.println(host);

  Serial.printf("Using fingerprint '%s'\n", fingerprint);
  httpsClient.setFingerprint(fingerprint);
  httpsClient.setTimeout(15000); // 15 Seconds
  delay(1000);
  
  Serial.print("HTTPS Connecting");
  int r=0; //retry counter
  while((!httpsClient.connect(host, httpsPort)) && (r < 30)){
      delay(100);
      Serial.print(".");
      r++;
  }
  if(r==30) {
    Serial.println("Connection failed");
    
    
    
  }
  else {
    Serial.println("Connected to web");
  }
  
  String getData, Link, reqData, dataLength;
  
  //POST Data
  Link = "/api/add_data.php";
  reqData = "s1="+s1+"&s2="+s2+"&s3="+s3+"&s4="+s4;
  dataLength = String(reqData.length());

  Serial.print("requesting URL: ");
  Serial.println(host);

  httpsClient.print(String("POST ") + Link + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded"+ "\r\n" +
               "Content-Length: "+ dataLength + "\r\n\r\n" +
                reqData + "\r\n" +
               "Connection: close\r\n\r\n");

  Serial.println("request sent");
                  
  while (httpsClient.connected()) {
    String line = httpsClient.readStringUntil('\n');
    if (line == "\r") {
      Serial.println("headers received");
      break;
    }
  }

  Serial.println("reply was:");
  Serial.println("==========");
  String line;
  while(httpsClient.available()){        
    line = httpsClient.readStringUntil('\n');  //Read Line by Line
    Serial.println(line); //Print response
  }
  Serial.println("==========");
  Serial.println("closing connection");  
  Serial.println("Connection failed");

  
  delay(2000);
    
}

String getValue(String data, char separator, int index) {
  int found = 0;
  int strIndex[] = {0, -1};
  int maxIndex = data.length() - 1;

  for (int i = 0; i <= maxIndex && found <= index; i++) {
    if (data.charAt(i) == separator || i == maxIndex) {
      found++;
      strIndex[0] = strIndex[1] + 1;
      strIndex[1] = (i == maxIndex) ? i + 1 : i;
    }
  }
  return found > index ? data.substring(strIndex[0], strIndex[1]) : "";
}
