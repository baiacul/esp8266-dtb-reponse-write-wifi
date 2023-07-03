#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// Update HOST URL here
#define HOST ""   // Enter HOST URL without "http://" and "/" at the end of URL

#define WIFI_SSID ""      // WIFI SSID here                                   
#define WIFI_PASSWORD ""     // WIFI password here

// Declare global variables which will be uploaded to server
int id_user = 12345;   // id user to link database
String sendva1, sendva2, sendId, postData;

/////setup/////
void setup() {
 
  
  Serial.begin(115200);
  Serial.println("Communication Started \n\n");
  delay(1000);

  pinMode(LED_BUILTIN, OUTPUT);     // initialize built-in LED on the board
  WiFi.mode(WIFI_STA);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);  // try to connect with WiFi
  Serial.print("Connecting to ");
  Serial.print(WIFI_SSID);
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println();
  Serial.print("Connected to ");
  Serial.println(WIFI_SSID);
  Serial.print("IP Address is: ");
  Serial.println(WiFi.localIP());    // print local IP address
  delay(30);
}


////////////////////começo do loop/////////
void loop() {
  HTTPClient http;    // HTTPClient object
  WiFiClient wclient; // WiFiClient object

  // Convert integer variables to string
  
  sendva1 = "random value"; //it can be the reading of a sensor or the return of a function
  sendva2 = "random value"; //it can be the reading of a sensor or the return of a function
  sendId = String(id_user);

  postData = "sendva1=" + sendva1 + "sendva2=" + sendva2 + "&sendId=" + sendId;

  // Update Host URL here:  
  http.begin(wclient, "http://********webhostapp.com/dbwrite.php");  // Connect to host where MySQL database is hosted
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // Specify content-type header

  int httpCode = http.POST(postData);   // Send POST request to PHP file and store server response code in variable named httpCode
  Serial.println("values sand: val1 = " + sendva1 );
  Serial.println("values sand: val2 = " + sendva2 );

  // If connection established, then do this
  if (httpCode == 200) {
    Serial.println("Values uploaded successfully.");
    String payload = http.getString();
    Serial.println(httpCode);
    Serial.println(payload);
    String response_server = payload; //server response, reading of changed variables in the database by the previw page
   
    
  }
  // If failed to connect, then return and restart
  else {
    Serial.println(httpCode);
    Serial.println("Failed to upload values.\n");
    http.end();
    return;
  }

  delay(100); // Wait for servo movement to complete

  http.end();
  delay(3000);
}
