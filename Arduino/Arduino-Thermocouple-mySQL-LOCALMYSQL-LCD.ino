// include SPI library
#include <SPI.h>

// include Liquid Crystal I2C library
#include <LiquidCrystal_I2C.h>

// set the LCD address to 0x27 for a 16 chars and 2 line display
LiquidCrystal_I2C lcd(0x27, 16, 2); 

// include Ethernet library
#include <Dhcp.h>
#include <Dns.h>
#include <Ethernet.h>
#include <EthernetClient.h>
#include <EthernetServer.h>
#include <EthernetUdp.h>

// Ethernet settings (depending on MAC and Local network)
byte mac[] = {0x90, 0xA2, 0xDA, 0x0E, 0x94, 0xB5 };
IPAddress ip(192, 168, 1, 177);
IPAddress gateway(192, 168, 1, 1);
IPAddress subnet(255, 255, 255, 0);
EthernetClient client;

// address of webserver
byte server[] = { 192, 168, 1, 78 };


//include max6675 library for thermocouple chips
#include <max6675.h>

// pin definitions for SPI communications
int thermoDO = 48;
int SDCS = 4;
int etherCS = 10;
int thermoCS1 = 44;
int thermoCS2 = 42;
int thermoCLK = 46;

MAX6675 thermocouple1(thermoCLK, thermoCS1, thermoDO);
MAX6675 thermocouple2(thermoCLK, thermoCS2, thermoDO);

// Initilize variables for millis() delay timing
long previousMillis1 = 0; 
long previousMillis2 = 0; 

// interval variable for mysql updating records.
long interval1 = 5000;

// interval variable for mysql inserting record.
long interval2 = 10000;

// Declare thermocouple 1 string for LCD printing (truncating to one digit after decimal point).
String TC1S="";

// Declare thermocouple 2 string for LCD printing (truncating to one digit after decimal point).
String TC2S="";

void setup() {

  //initialize the lcd
  lcd.init();
  //open the backlight
  lcd.backlight();  
  
  // disable SD SPI
  pinMode(4, OUTPUT);
  digitalWrite(4, HIGH);

  // disable w5100 SPI
  pinMode(10, OUTPUT);
  digitalWrite(10, HIGH);

  //Initialize serial interface.
  Serial.begin(9600);
  Serial.println("Serial interface started");

  //Initialize ethernet interface.
  Ethernet.begin(mac, ip, gateway, subnet);
  Serial.println("Ethernet interface started");

  //Print IP address, subnet mask, gateway:
  Serial.print("My IP address: ");
  Serial.println(ip);
  Serial.print("My Subnet Mask: ");
  Serial.println(subnet);
  Serial.print("My Gateway: ");
  Serial.println(gateway);

  Serial.println("MAX6675 stabilizing...");
  // wait for MAX chip to stabilize
  delay(100);
}

void loop() {
  
  // set the cursor to column 3, line 0
  lcd.setCursor(2, 0); 

  // Read and assign the thermocouple 1 data to a string variable, then truncate to 4 digits (will need to edit to 5 if temp is over 100 degrees).
  TC1S=String(thermocouple1.readFahrenheit());
  TC1S.remove(4);
  
  // Print a message to the LCD
  lcd.print(String("TC 1 ") + String(TC1S)); 

  // set the cursor to column 3, line 1
  lcd.setCursor(2, 1); 

  // Read and assign the thermocouple 2 data to a string variable, then truncate to 4 digits (will need to edit to 5 if temp is over 100 degrees).
  TC2S=String(thermocouple2.readFahrenheit());
  TC2S.remove(4);
  
  // Print a message to the LCD.
  lcd.print(String("TC 2 ") + String(TC2S)); 
  
// assign millis value to currentMillis each loop, millis resets after approx 70 days.
unsigned long currentMillis = millis();

  // checks to see if the time elapsed since last timing loop is greater than interval variable.
  if(currentMillis - previousMillis1 > interval1){
    
  // stop ethernet SPI
  digitalWrite(10, HIGH);

  // read from thermocouple 1
  digitalWrite(44, LOW);
  float tc1 = thermocouple1.readFahrenheit();
  digitalWrite(44, HIGH);
  digitalWrite(42, LOW);

  // read from thermocouple 2
  float tc2 = thermocouple2.readFahrenheit();
  digitalWrite(42, HIGH);
  // write thermocouple readings to serial
  Serial.print("Sensor 1 = ");
  Serial.print(tc1);
  Serial.print("   Sensor 2 = ");
  Serial.println(tc2);
  digitalWrite(10, LOW);

  // connection to webserver localmysqlcon.php file must be in root, or in specified pathway below...
  client.connect(server, 80);

  if ( client.connected() )
  {
    client.print( "GET /mysql/localmysqlcon.php?");
    client.print("temp1=");
    client.print( tc1 );
    client.print("&temp2=");
    client.print( tc2 );    
    client.println( " HTTP/1.1");
    client.println( "Host: 192.168.1.78" );
    client.println( "Content-Type: application/x-www-form-urlencoded" );
    client.println( "Connection: close" );
    client.println();
    client.println();
    client.stop();
    Serial.println("Updating Temperature data sent to sql server.");
    Serial.println("");
  }
 else {
    Serial.println("connection failed");    
  }
  // sets previousMillis variable to currentMillis variable, this happens only each time the interval if loop is activated.  Approx 1 second for update and 10 seconds for insert.
  previousMillis1 = currentMillis;
  }

    // checks to see if the time elapsed since last timing loop is greater than interval variable.
  if(currentMillis - previousMillis2 > interval2){
    
  // stop ethernet SPI
  digitalWrite(10, HIGH);

  // read from thermocouple 1
  digitalWrite(44, LOW);
  float tc1 = thermocouple1.readFahrenheit();
  digitalWrite(44, HIGH);
  digitalWrite(42, LOW);

  // read from thermocouple 2
  float tc2 = thermocouple2.readFahrenheit();
  digitalWrite(42, HIGH);
  // write thermocouple readings to serial
  Serial.print("Sensor 1 = ");
  Serial.print(tc1);
  Serial.print("   Sensor 2 = ");
  Serial.println(tc2);
  digitalWrite(10, LOW);

  // connection to webserver temphistoryupdate.php file must be in root, or in specified pathway below...
  client.connect(server, 80);

  if ( client.connected() )
  {
    client.print( "GET /temphistoryupdate.php?");
    client.print("temp1=");
    client.print( tc1 );
    client.print("&temp2=");
    client.print( tc2 );    
    client.println( " HTTP/1.1");
    client.println( "Host: 192.168.1.78" );
    client.println( "Content-Type: application/x-www-form-urlencoded" );
    client.println( "Connection: close" );
    client.println();
    client.println();
    client.stop();
    Serial.println("Inserting Temperature data sent to sql server.");
    Serial.println("");
  }
 else {
    Serial.println("connection failed");    
  }
  // sets previousMillis variable to currentMillis variable, this happens only each time the interval if loop is activated.  Approx 1 second for update and 10 seconds for insert.
  previousMillis2 = currentMillis;
  }
  
}
