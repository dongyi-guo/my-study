# Digital forensic Tools Evaluation

## Tool Selection

* nmap - Network Mapper
  * Tool for network exploration & security auditing.
  * Designed to rapidly scan large networks.
  * Use raw IP packets to profile a host server: services, OS, firewalls, etc.
  * Port scanning.
  * Many systems and network administrators find it useful for routine tasks such as network inventory, managing service upgrade schedules, and monitoring host or service uptime.
  * https://github.com/nmap/nmap
* Volatility: - RAM Extractor
  * Framework on Python for RAM extraction.
  * Has a version 2 and 3, assuming based on Python version?
  * https://github.com/volatilityfoundation/volatility
  * https://www.volatilityfoundation.org/
* Autopsy - GUI of the Sleuth Kit
  * Java-based GUI of the Sleuth Kit (3, 4)
  * https://github.com/sleuthkit/autopsy
  * https://www.sleuthkit.org/autopsy/
* Oxygen Forensic Suite - Data acquisition for mobile devices.
  * Images, SIM data, Messages, Cloud storage.
  * Used by a large number of criminal investigation agencies, Law enforcement agencies, army departments, customs, and other major government sectors to investigate the digital attacks involving Smartphones, IoT devices, Drones, Smart-watches, etc 
    * MTK watches
    * Alexa & Google Home IoTs
    * Cloud services
    * Flight history
    * Drones
    * Data analysis from network carriers.
  * https://oxygenforensics.com/en/
  * https://linuxhint.com/oxygen_forensics_suite_guideline/
* SIFT - Workstation for detailed digital forensic examinations
  * Collection of free and open-source incident response and forensic tools.
  * On Ubuntu and WIndows WSL.
  * https://www.sans.org/tools/sift-workstation/
* Xplico - Network Forensic Analisys Tool (NFAT)
  * For Unix and Unix-like operating systems.
  * On Linux yay~
  * https://github.com/xplico/xplico
  * https://www.xplico.org/
* Memoryze- Live memory image files and paging files acquisition and analysis
  * Free on Windows.
  * https://support.magnetforensics.com/s/article/Acquire-Memory-with-MAGNET-RAM-Capture?language=en_US
* FAW -  First Forensic Browser
  * Capture insane amount of information for insane amount of range of websites.
  * https://en.fawproject.com/
* The Sleuth Kit (TSK) - Disk Image Investigator
  * Library and Collection of CLI tools to investigate disk images.
  * To analyze volume and file system data.
  * And the library part can just be used to create larger tools.
  * https://www.sleuthkit.org/sleuthkit/
* DEFT Zero - Linux distribution for digital evidence acquisition
  * Ubuntu (Lubuntu) - based, Zero means lightweight version.
  * Built-in tools to open encrypted files and recover deleted data.
  * DART – Digital Advanced Response Toolkit – a graphical tool allows you to check the integrity of each tool before its execution.
  * Specifically designed to perform forensic acquisition of digital evidence. Among the biggest features is the support to NVMExpress memory (MacBook 2015), eMMC memories and UEFI.
  * https://archiveos.org/deft/
  * https://distrowatch.com/?newsid=09723
* Hex Editor Neo - Hex data editing and exchanging
  * Edit Your Hex Code, Modify Binary Data and Files.
  * Windows only, but I believe Linux has 69420 alternatives.
  * http://www.new-hex-editor.com/
* Magnet RAM Capture - Imaging tool to capture the physical memory
  * Allows you to recover and analyse artefacts that are often only found in memory.
  * Windows only and need virtualisation support
  * https://support.magnetforensics.com/s/article/Acquire-Memory-with-MAGNET-RAM-Capture?language=en_US
* enCase - Digital Evidence Locator
  * Used by lawsuits and governmental authorities.
  * https://www.opentext.com/products/encase-forensic#resources
* Paladine - Linux Forensic Suite
  * Includes Autopsy and Sleuthkit, the library truly values.
  * Not free.
  * https://sumuri.com/software/paladin/
* Caine - Computer Aided Investigative Environment
  * A Live CD Linux distribution.
  * An inter-operable environment that supports the digital investigator during the four phases of the digital investigation
  * a user-friendly graphical interface with user-friendly tools.
  * Full open source.
  * https://www.caine-live.net/

## Nmap - Network Mapper

### Overview

Network Mapper, also well-known as “nmap”, is an open-source project of a command-line tool for network exploration and security auditing, although having alternatives like Zenmap to provide nmap’s functionality with a graphical user interface. Nmap works with TCP/IP protocols (Transport/Internet Layers of OSI model) by using raw IP packets to quickly find live hosts or targets on a whole network, or simply investigate one specific host or group of hosts, and extract chunks of information from the targets, such as their opening ports, information about services that running on those opening ports such as name or version, the operating system running on the host(s) and what types of defense like firewalls or filters have been applied to the host(s), it can also run pre-written scripts to find much more information about the targets by using Nmap’s Scripting Engine (NSE) where codes are written in Lua, this also enables the potential of automation for nmap. Nmap not only serves the best at the Enumeration/Vulnerability Detection stage, or even sometimes at the Information Gathering/Reconnaissance stage of a digital forensic activity but could also provide some obfuscation by having decoys to trick some Intrusion Detecting System on the target’s firewalls. Combined all above, nmap is one of the most important network tools for not only hackers, penetration testers and network/system administrators but anyone who is in IT. 

### Features

* Find live hosts in a network.
* Find opening ports of target host(s).
* Find information about services running on the opening ports of a target host(s).
* Find information about operating systems about target host(s).
* Find security system configurations such as firewalls applied to target host(s).
* Find much more information about target host(s) with pre-written scripts through nmap’s scripting engine.
* Automate the networking exploration and security auditing process with scripts.

### Use Cases

* For Network/System Administrator, nmap provides the ability to monitor and audit the network and its hosts for usability and security by monitoring assets status like uptime, service status, finding vulnerabilities, visualizing the network mapping, testing firewall functionalities, troubleshooting networks, complying network with security standards and policies, detecting intrusions, and unlocking the potential of automating all the processes above.
* For Penetration Testers/Ethical Hackers/Hackers, nmap reveals the hosts and targets to evaluate/attack on and information that could be helpful such as opening ports, running services, operating systems, firewall configurations and potential vulnerabilities, paving the way to the information gathering or the reconnaissance stage of a penetration test or hacking, and eventually identifying the break-through/vulnerability of the system to achieve the final goal of the digital forensic behaviors. Nmap also goals to achieve all these above in a massive network rapidly and can provide automation on them with scripts.

**Incident**: Unknown Intruder in my network 

**Role**: Network/System Administrator 

**Scenario**: Found a vague device during my network monitoring routine. 

**How to use**: As a Network/System Administrator, I use nmap to monitor and audit network and its hosts for usability and security by monitoring assets status like uptime, service status, visualizing the network mapping, and scripting to automate this process. Today when I am using nmap to traverse one of my networks, I found out a vague machine I have never seen before, nor I assigned this IP address to any machine as I remember, weirdly enough this device only has port 22 for SSH services and no other ports/service running. 

This raised the alarm of me thinking my network is being exposed. I blacklisted the device, used nmap with scripts to find vulnerabilities on my live hosts in this network, tested whether the firewall configurations are working, troubleshooting network service’s functionalities on those hosts until all services remained running and complying with security standards and policies. Then I started my documentation. 

**Incident**: The forgotten device, with much power, with severe leaks 

**Role**: Penetration Tester/Ethical Hacker/Malicious Hacker

**Scenario**: 

* For Penetration Tester/Ethical Hacker, received Client’s request to do penetration testing on certain networks/systems.
* For Malicious Hacker, today is the day, time to hack in these networks/systems for my money and what I am standing for. 

**How to use**: With a simple return of a nmap command, live hosts as targets to evaluate/attack were revealed. What were also revealed are the opening ports, running services, operating systems, firewall configurations and potential vulnerabilities as I used the “vuln” script groups, Actual vulnerabilities with CVE notations was presented to me, and I see no reason to make this as a break-through. 

### With Chuck:

```bash
# Check live hosts on the network1s
nmap -sP <networkaddress>

# Find the ports
sudo nmap -sT -p 80,443 <networkaddress>

# -T means TCP, so using this will enable you using a full 3-way TCP handshake to achieve your goal
# SYN - SYN ACK - ACK
# Might be intrusive, Intrution Detection System on firewall will not be happy.

# -S for stealth, or half-open scan
# After getting SYN ACK, just leave
sudo nmap -sS -p 80,443 <networkaddress>

# Use Wireshark, and scan for single hosts
sudo nmap -sT -p 80,443 <hostaddress>
sudo nmap -sS -p 80,443 <hostaddress>

# Enable system detection - guessing actually
sudo nmap -O <hostaddress>

# -A: aggresive mode
# ssh-hostkey
# Service on port
# OS
# traceout
sudo nmap -A <hostaddress>

# -D: decoy, for obfuscation,
# with a decoy ip address.
# Basically both you and that ip are sending, but makes you less sus.
sudo nmap -sS -D <decoyaddress> <hostaddress>

# Using scripting engine
# This runs all the scripts under vuln categories
sudo nmap --script vuln <hostaddress>

# You can use vulnhub.com
```

### With LLTV:

```bash
# Scan a host
nmap <hostaddress> # or domain name which can be resolved

# -v: verbose
nmap -v <hostaddress>

# Or you can have multiple IP scanned
nmap <hostaddress1> <hostaddress2>
nmap <hostaddress.2-6>
nmap <hostaddress> --exclude <excludedaddress>

# -sV: gives version/permission information as well
nmap -sV <hostaddress>

# -A: Aggressive
nmap -A <hostaddress>

# Scan a subnet
nmap <networkaddress>

# More Condenst Output
nmap -sP <networkaddress>

# Speed up
nmap -T5 <networkaddress>

# T0 - T5 slowest to fastest, with accuracy lost, default is T3
```

## Video Structure

### Overview

* Greet: Dongyi Guo, KIT725 Group 5, Thuan Pin and Ronghua.
* Nmap - Network Mapper
  * CLI tools with massive functions on network exploration and security auditing
  * Works with TCP/IP protocols, Transport and Internet layers on OSI model
  * Use raw IP packets to quick fine live hosts on network - use on one host or hosts
  * Extract Information
    * Opening ports
    * Running services - name and version
    * OS on the hosts
    * Firewall & filter configs
    * Run pre-written scripts with NSE (Nmap Scripting Engine) with Lua
    * Automation
  * Serves at Enumeration and Vulnerability Detection stage of an eforensic activity
  * Also could work on Information Gathering and Reconnaissance stage.
  * Can also achieve obfuscation by tricking Intrusion Detecting System (IDS) firewalls with decoys
  * One of the most important network tools for not only hackers, penetration testers and network/system administrators but anyone who is in IT.

### Practice



## Scripts

Hello everyone, this is Dongyi Guo from KIT725 Group 5 with Thuan Pin Goh and Ronghua Yang. 

So today for our digital forensic tool evaluation assignment, our demostration is going to be focusing on the nmap, or well-known as Network Mapper, a command line tool that provides massive functionalities in terms of network exploration and security auditing. Nmap works with the TCP/IP protocols, so it's on the Transport and Internet Layers of OSI model, it utilises raw IP packets to quickly find live hosts or targets on a whole network, nmap can be used to investigate a specific host or bunch of hosts, and extract chunks of information from the targets, such as their opening ports, information about services that running on those opening ports such as name or version, the operating system running on the host(s) and what types of defense like firewalls or filters have been applied to the host(s), it can also run pre-written scripts to find much more information about the targets by using Nmap’s Scripting Engine (NSE) where codes are written in Lua, this also enables the potential of automation for nmap. Nmap not only serves the best at the Enumeration/Vulnerability Detection stage, or even sometimes at the Information Gathering/Reconnaissance stage of a digital forensic activity but could also provide some obfuscation by having decoys to trick some Intrusion Detecting System on the target’s firewalls. Combined all above, nmap is one of the most important network tools for not only hackers, penetration testers and network/system administrators but anyone who is in IT.