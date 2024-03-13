# Penetration Testing

Commonly organised as teams:

* **Red Team**: Actual Pen-Testers, attacking side, trying to break through defences by exploiting vulnerabilities, often external to client
* **Blue Team**: Internal Security Team, hardening system and networks even there is no attack, and active as well during attacks
* **Purple Team**: New, do both attacking and defencing, work along both sides as well, can be outsiders, can fulfil Red Team or Blue Team if one is not present
* All teams still work together to produce audit of each test and success of failure

Where test is happening:

* Local System
  * Firewall Config
  * Weak Passwords
  * Unpatched Applications, Services, OS
  * Insecure Device Attachment
  * Running Services, Open Ports
  * Unapproved Network Sharing
  * Local Admin Accounts
* Network Infrastructure
  * Accessible Network Ports
  * Weak / Known Vulnerable Protocols
  * Boundary Firewall
  * IPS / IDS
  * DMZ services
  * Weak Passwords / Protocols on Wireless Networks
  * Router Accessibility, UPNP
  * Rogue Wireless Hotspots
* Network Services
  * Old / Insecure version of protocols
  * DNS
  * VPN
  * Source Address Spoofing on Outgoing Traffic
* Servers
  * Web Server
  * Database Server
    * Insecure Permissions
    * Remote Access
  * File and Print Server
  * Enterprise Systems
    * Admin
    * Finance
    * HR
    * Student
  * VPN
* Web Applications
  * Patches for known vulnerabilities
  * XSS
  * SQL Injection
  * User Data Upload
* Staff / Users, via Social Engineering
  * 90% of cyberattacks start with a phishing campaign
  * Gullible Staff
  * Remote and Local
  * Impersonation
    * Physical, Phone, Email
  
* Physical
  * Access to Servers, USB and network ports, cables, switches, racks, infrastructure
  * Dumpster Diving
  * Eavesdropping 
  * Shoulder Surfing

## Tools

### whois

* Queries records of registered owners, IP or domain names
* Passive recon tool
* Human-readable format
* Built-in on Unix systems
* Available as websites 

### Maltego

* Gather public and local information
* Uses transforms to change focus / scope
* Included in Kali Linux and available separately
* Multiple editions
* Needs free account

### Nmap

* An open source tool for network exploration and security auditing
* Find active hosts on network
* Find open ports / services on a host
* Find information about host like OS
* Find vulnerability on a host
* Has Zenmap (GUI version)
* Has components like ncat, ndiff, nping

### Password Crackers

* THC-hydra
  * Multiple protocol (SSH, SMB, HTTP, FTP, Telnet...) modularised parallelised login cracker
* John the Ripper
  * Offline hash cracker
* Hashcat
  * Offline GPU-support cracker, with 300+ hash types supported

### Metasploit Framework

* Command-line tool with extensive library of vulnerabilities, exploits and payloads to attack machines under test

### Vega

* Vulnerability Scanner / Testing platform to test security on web app:
  * SQL Injection
  * XSS
  * Inadvertent information disclosure
* Modular, extensions can be can be coded in JavaScript
* Java GUI based

### OpenVAS

* Vulnerability Scanner 
  * Over 130000 vulnerability tests, daily updates
  * Scriptable
  * Scanning large networks
  * Authenticated and Unauthenticated Testing

### Kali Linux

* Debian-based Security focused Linux Distribution maintained by Offensive Security

### Parrot OS

* Same as Kali, but more a day-to-day system

# Identity and Authentication

"How a system determine who and what is authorised?"

* Use **Authenticated Identity** to determine authorisation
* A **Logical Access Control**

Steps: Identification -> Authentication -> Authorisation

## Identification

* The process of claiming an identity to an ICT system
* Work in a closed system
* Anyone can claim, but only establish the one that system recognises - **verify as next step**
* Users are "introduced" into the system (Account Allocation), otherwise no access (Unless account stolen), done by system admins
* One individual may have different identities - if system considers them as different people

## Authentication

* The process of validating the claimed identity
* Requires a second piece of unique information
* System will try to match the evidence with stored records to establish trust.

## Authentication Factors

* Three factors:
* What a user
  * **Knows**: Remembers or Reads
  * **Has**: Read from or Inserted into system
  * **Is**: Physical characteristics or behaviour
* What are the trade-offs? What are the overall security goals?
* Increasingly they are used in combo: 2FA

#### Knows - Passwords

* Can be unlimited, limited, or one-time
* How do you know they are disclosed to the user?
* Attack vectors: 
  * User Behaviour
  * Construction Rules can be countered by Automated Attacks
  * Stolen from OS

#### Has - Tokens & Challenge / Response

* Usually used with a PIN / Password
* Time-based Code
* Could be hardware
* RFID tags + Person
* Attack vectors:
  * Theft
  * Forgery
* It belongs to user, but not directly used by user
* Shared Keys authenticate - cannot prove who originated
* Asymmetric keys prove cipher text created with matching private key - cannot prove ownership

#### Is - Biometrics

* Two types: Physical, Behavioural
* Issues: 
  * False Positive and False Negative rates
  * Cost
  * Key decay - the more you use the harder it is protected
  * Can be faked
  * Stolen in digital version
* Combined with what user has: Passport

### Passive Access Control

* System responds to identity, user initialises the authentication
*  1 to 1

### Active Access Control

* Computer detects presence, user does not start it.
* Usually sensors are the carriers to start the authentication from system's perspective, then a database search for matching
* One to Many
* Does not have to be biometric based, any items can identify you can be used



