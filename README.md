# 🌊 Access_pulse: RFID Smart Lock System

Welcome to Access_pulse, a modern solution for keyless entry. This project leverages RFID technology to create a secure and intelligent smart lock system, moving beyond traditional metal keys. By scanning an authorized RFID tag, you can gain instant access, while all entry attempts are logged to a remote server for monitoring.

This system is perfect for securing doors, lockers, or any space where you need controlled and monitored access.

## ✨ Key Features

-   **🔑 Keyless Entry:** Gain access with a simple tap of an RFID card or tag.
-   **🔒 Enhanced Security:** Denies access to unauthorized users, eliminating the risk of key duplication.
-   **📡 Remote Logging:** Every access attempt (granted or denied) is sent to a remote web server and logged in a database with a timestamp.
-   ** solenoid Lock Control:** Interfaces with a solenoid lock for a reliable and secure physical locking mechanism.
-   **📶 WiFi Connectivity:** Utilizes the ESP8266 to connect to your local WiFi network for data transmission.

## 🛠️ Components & Tech Stack

### Hardware
-   **Microcontroller:** ESP8266
-   **RFID Reader:** MFRC522 RFID Module
-   **Locking Mechanism:** Solenoid Lock
-   **Switching:** 5V Relay Module
-   **RFID Tags/Cards**

### Software & Technologies
-   **Firmware:** C++ on Arduino IDE
-   **Backend:** PHP
--   **Database:** MySQL
-   **Libraries:**
    -   `MFRC522`
    -   `ESP8266WiFi`
    -   `ESP8266HTTPClient`

## 🚀 Getting Started

To build your own Access_pulse system, follow these setup instructions.

### 1. Backend Setup

You'll need a web hosting service that supports PHP and MySQL (like 000webhost, which was used in development).

1.  **Database Setup:**
    -   Create a MySQL database.
    -   Create a table named `users` with the following structure:
        ```sql
        CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            card_uid VARCHAR(30) NOT NULL,
            name VARCHAR(30) NOT NULL,
            logged_in TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );
        ```

2.  **Upload PHP Scripts:**
    -   Upload `server_addData.php` and `server_readData.php` to your web server.
    -   Update the database credentials (`$servername`, `$username`, `$password`, `$database`) in both PHP files to match your setup.

### 2. Hardware Assembly

Connect the components to your ESP8266 as follows:

-   **MFRC522 RFID Reader:**
    -   `SDA (SS)` -> `D8`
    -   `SCK` -> `D5`
    -   `MOSI` -> `D7`
    -   `MISO` -> `D6`
    -   `RST` -> `D4`
    -   `GND` -> `GND`
    -   `3.3V` -> `3.3V`

-   **Relay Module & Solenoid Lock:**
    -   Relay `VCC` -> `5V` (from an external power source if needed)
    -   Relay `GND` -> `GND`
    -   Relay `IN` -> `D0` on ESP8266
    -   Connect the Solenoid Lock through the `NO` (Normally Open) and `COM` terminals of the relay.

### 3. Firmware Setup

1.  **Configure Arduino IDE:**
    -   Install the ESP8266 board manager in your Arduino IDE.
    -   Install the required libraries: `MFRC522`, `ESP8266WiFi`, and `ESP8266HTTPClient`.

2.  **Update the Code:**
    -   Open the `final_rfid_1.ino` file.
    -   Change the WiFi credentials to your network's SSID and password:
        ```cpp
        #define ssid "YOUR_WIFI_SSID"
        #define password "YOUR_WIFI_PASSWORD"
        ```
    -   Update the `URL` to point to your `add_rfid_data.php` script on your server:
        ```cpp
        String URL = "[http://your-domain.com/server_addData.php](http://your-domain.com/server_addData.php)";
        ```
    -   Modify the `if(tag=="2222274829")` line to include the UID of your authorized RFID tag. You can find the UID by scanning your tag with the `rfid.c` test script.

3.  **Upload to ESP8266:**
    -   Connect your ESP8266 to your computer, select the correct board and port in the Arduino IDE, and upload the sketch.

## ⚙️ How It Works

1.  A user taps their RFID tag on the MFRC522 reader.
2.  The ESP8266 reads the tag's unique ID (UID).
3.  The firmware checks if the UID matches the hardcoded authorized UID.
4.  **If Authorized:**
    -   The ESP8266 sends a signal to the relay module, which activates the solenoid lock, granting access.
    -   It then makes an HTTP GET request to the `server_addData.php` script with the card UID and user's name.
    -   The PHP script logs the entry in the MySQL database.
5.  **If Unauthorized:**
    -   Access is denied, and the lock remains closed.

---

<p align="center">
  Made with ❤️ and a passion for secure, smart solutions.
  <br>
  <em>Unlock the future, one pulse at a time.</em>
</p>
