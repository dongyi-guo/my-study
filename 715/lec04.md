# Assignment 2

It is a **Vulnerability Assessment**, not Pen-Test, which is stage 1,2,3,6 of typical stage of PT.

## Requirements

* Two Documents:
    * Business Details: making up the business (SME).
    * Not assessed, but will receive feedback.
    * April 19th 11:59
* Vulnerabiltiy Assessment Plan:
    * Submit along revised Business Details Document
    * May 2nd 11:59

* Get the business details from Network Lab machines:

```bash
./cyber-param dongyig 662970
```

* Your SME is given and not randomised, but will be different to other students' SME details.
* Be quite specific about what is the system, OS version, network infrastructure, location, anything that could lead to some vulnerability so you can actually discuss in the assignment.

# Malware

## Definition

"Collective name for a number of malicious software viruses, designed to cause extensive damage to data and systems or to gain unauthorised access to a network."

"Any software intentionally designed to cause damage to computer, server, client, or computer network."

* Unauthorised code that runs on a computer to make it do what an attacker wants it to do:
    * Steal info
    * Encrypt or delete files
    * Acting as a relay for attacking other systems - DDoS botnet
    * Mining and Click fraud's botnet
    * Spam email

## Types

* Trojan viruses: Appear to be normal, but have hidden information to give cyber criminals access or control the system.
* Ransomware: Deny access to data on device or network until ransom is paid.
* Keyloggers: Record keystrokes to steal passwords and other sensitive information.
* Viruses: Infect and corrupt software installed on the device then can re-producable.
    * Worm: type of virus, can spread on its own.
* Rootkit: malware that hides its presence, hooking into process and file listing service, and removing themselves from returned results.
* RAT: Remote Access Trojan, malware that provides remote access to a system (Screenshare or CLI)
* Spyware: Gather information about user's activity and share it without user's consent
* Adware: Pop-up ads for revenue
* Scareware: Social engineering the user by shocking them or induce anxiety, to make user do certain things.
* BEC: Business Email Compromise
* APT: Advanced Persistent Threat: a threat actor who gains unauthorised access to a system or network, and remain undetected for a long time.
* IOC: Indicator of Compromise: evidence left after an intrusion that could prove the intrusion took place.

## Attack Vectors

## Attack Types

### Reconnaissance Attacks

* Also called information gathering attacks:
    * Unauthorised discovery or mapping of the system, service and vulnerabilities.
    * Similar to thief door-knocking a neighbourhood and try to sell - but actually spot what to steal.
    * Also called **host profiling** if directed at an endpoint.
* Often comes before a DoS attacks
* Often employ usage from wide range of tools.

#### Techniques

* Perform an information query of a target
    * Looking for initial information
    * Google, whois/IANA/DNS, dig, nslookup...
* Ping sweep of the target network
    * Find live hosts, IP, network topology
* Port scan of active IP addresses
    * Which ports or services?
    * nmap, OpenVAS...

### Access attacks

Exploit vulnerabilities in services to:

* Gain access to systems
* Retrieve data
* Escalate privileges

#### Techniques

* Password attack
    * Discover passwords via phishing, dictionary, brute-force, network sniffing or even social engineering.
* Pass-the-hash
    * Use malware to access machine's stored hashes.
    * Use those hashes to authenticate to other remote servers or devices.
* Trust Exploitation
    * Use trusted host(s) to gain access to network resources.
* Port re-direction attack
    * Compromise an externally visible host that is trusted.
    * Activate port redirection on the external host and requests are redirected to the internal host, bypassing the firewall.
* Man-in-the-Middle (MITM) Attack
    * Threat actor positions between to legitimate entities to read, modify and redirect data exchanging in between them.
* IP, MAC, DHCP spoofing
    * Give false address data.

### Denial of Service attacks

* Overwhelm the target with large volumes of traffic, or malformed packets.
* Typically results in service disruption for users or unresponsive system/device.

#### Distributed Denial of Service

* Threat actors compromise multiple hosts as "bot army" or "botnet" in coordiated attacks

##### Terms
* Zombie: Compromised hosts.
* bot: Zombies, or the code designed to infect a system to communicate and controlled by C&C, also has keystrokes, gathers passwords, capture network traffic...
* botnet: the collection of bots
* C&C server / handler: master command-and-control server controlling group of zombies
* botmaster: the threat actor in control of the botnet and C&C server.

## Malware events:

### Morris Worm

* One of the first internet worms.
* Robert Morris, student from Cornell Uni.
* Nov 2, 1988 at MIT.
* Exploited vulns in sendmail, finger, rsh/rexec and passwords.
* Sun and VAX systems.
* Not malicious intended.
* Led to establishment of CERT/CC by DARPA in 1988.

### Happy99

* I-worm or Ska.
* Install without user's knowledge.
* Affected Windows and spread thru email and usenet.
* Modify Winsock to spread and registry for auto-start.
* Spread far away.

### Conficker

* Nov 2008.
* Attacked wide range of Windows, 2000, XP, Vista, Server 2003 & 2008.
* MS08-067.
* 9-15 million infection.
* Lots of variants.
* Uses hashes and digital signatures to detect if payload has been modified.
* And can download new payloads that contain malware or updates.
* Spent months on updating itself, typical "lying in wait"

### Stuxnet

* Discovered in June 2010, developed since 2005.
* Targeted Windows-connected SCADA and PLC systems.
* Responsible for Iran's nuke system.
* US/Israeli.
* Rootkit.
* Target Windows systems, detects certain software, if condition met starting to make centrifuges to speed up.
* Has:
    * Worm
    * Link file for execution
    * Rootkit to hide itself
    * Safeguards: No longer infect if has more than 3 infected system
* Self-erase on 24 June 2012.
* Transferable via USB drive: **Cross an air gap**

### Mirai

* Discovered in August 2016.
* Turns Linux systems into bots that can be remotely controlled.
* Botnet can be used to conduct DDOS operations.
* Use a table of **common factory default usernams and passwords** to gain access and infect.
* Device infected only has little bit sluggish and bandwidth consumption.
* Resides in memory only.
* Attempts to identify and neutralise other malware, removing it from memory and blocking its remote administration ports.
* 2014, 2016 used in serveral DDOS attack against Rutgers University.
* September 2016, used to attack security researcher Brian Krebs' site Krebs on Security with 620 Gbits/s attack.
* Double the size of anything previously seen by Akami.
* October 2016, attacked Dyn which took Twitter, Netflix and GitHub and other Dyn customers offline.

### WannaCry

* May, 2017.
* Ransomware targeting Windows.
* Encrypted user data to demand a ransom via Bitcoin, 3 days double 7 days gone.
* Utilised EnternalBlue - SMB vuln developed by NSA.
* Used by North Korea.
* Attemps to resolve a "kill switch" domain name.
* If it cannot be resolved, then encrypts all user data and displays message.
* It tries to spread itself to other devices in local networks.
* Deal damages to hospital devices in UK.
* Car manufacturers have to stop for this.

### REvil Kaseya Attack

* REvil was a ransomware-as-a-service operator based in Russia.
* Kaseya is a manged service provider.
* Kaseya produces a remote monitoring and management tool called Virtual System Administrator (VSA), this thing has vulnerability on authentication. It got compromised and distributed malware to millions of systems.
* **Supply-chain** or amplification attack.

### Other stuff

* Melissa
* Code Red
* Nimba
* Mydoom
* CryptoLocker
* Petya
* NotPetya
* Ryuk
