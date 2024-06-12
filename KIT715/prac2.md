# Practical Exam 2 Practice

* Do NOT touch pfSence's IP configuration, leave WAN at 144.6.40.1/25 and LAN at 144.6.40.129/25.
* Everything that is inside ```<...>``` requires you to find proper answer to fill in.

## Question 1 - IP Configuration

#### Linux Network Setup

**For Kali and Metasploitable:**

To assign IP:

```bash
ip a a <IP>/<Prefix> dev <NetworkInterface>
```

If you need to remove an exising IP, or a wrongly-added IP:

```bash
ip a d <IP>/<Prefix> dev <NetworkInterface> 
# Make sure the rest is same as when you "ip addr add ..."
```

To check current IP configuration, use:

```bash
ip a
```

or

```bash
ifconfig
```

and check the ```inet``` parameter of your network interface for IPv4 address. 

* If you are using ```eth1``` interface of Kali, make sure you bring it up with ```ifup eth1```.
* For Metasploitable2 , run the setup command with ```sudo``` with msfadmin.

**For Ubuntu and RoamingWorker:**

* Click the system tray at upper right corner.
* Click the network interface you want to config on, in the expanded menu click "Wired Settings".
* Click the cog icon aside the targeted network interface.
* In the pop-up window, go to "IPv4" tabs, select "Manual" on IPv4 Method.
* In the "Addresses" section, give IP address, subnet mask, and gateway if necessary.
* Click "Apply" to apply the configuration, then in the Network settings page, turn off and on the interface to ensure your configuration is activated.

#### Windows Network Setup:

To setup network on Windows 7 or Windows Server 2016:

* Go to Network and Sharing Center, click on the connection.
* Then select Properties.
* Then highlight the "Internet Protocol Version 4 (TCP/IPv4)", select Properties.
* Assign IP, subnetmask, or gateway if needed accordingly.

For Windows XP:

* Go to Control Panel.
* Select Network Connection.
* Double-click the network.
* Select Properties.
* Then highlight "Internet Protocol [TCP/IP]", select Properties.
* Assign IP, subnetmask, or gateway if needed accordingly.

#### With pfSense

If pfSense is involved, an internal network (LAN) and an external network (WAN) are considered in the infrasturcture:

* The subnet mask is 255.255.255.128 as the network prefix is /25.

* Whichever hosts locate in the **LAN side requires a gateway** to be set as the LAN port of pfSense (144.6.40.129).

  * For Windows 7, make sure you select the network type as "Work" after setting up gateway.

* Whichever hosts locate in the **WAN side requires to set a static route**, transferring all traffic to the internal network (LAN) through the WAN side of pfSense:

  * ```bash
    ip r a <InternalNetworkAddress>/<Prefix> via <pfSenseWAN> dev <NetworkInterface>
    ```

  * By default, pfSense's WAN side is 144.6.40.1.

  * If you are using RoamingWorker the external network interface should be ```ens36```, if Kali then ```eth1```.

  * Verify with:

    * ```bash
      ip r
      ```

    * You should see an entry of your internal network address is being transferred to the pfSense WAN side IP.

## Question 2

#### Ubuntu

In the paper, find:

* What Protocol
* What Port Number
* What Operation to apply: Allow or Block

Then, to configure the firewall (iptables), become root:

```bash
sudo su -
# student's password is "student"
```

then, set up the rule:

```bash
iptables -A INPUT -p <Protocol> --dport <PortNumber> -j <Action>
```

* Action can be "ACCEPT" or "DROP"

It is NOT mentioned in the tutorial, but you can use ```-s``` to apply an iptable rule to a specific host (or even network) address, this rule then will only apply to only the specified host(s) instead of all incoming-requesting hosts:

```bash
iptables -A INPUT -s <SpecificHostIPAddress> -p <Protocol> --dport <PortNumber> -j <Action>
```

#### Windows Server 2016

1. In Server Manger, go to "Tools", open "Windows Firewall and Security".
2. Click "Inbound Rules" in the hierarchy at left side.
3. Click New Rules on the action panel at right side.
4. In the popped-up window, select "Custom Rules".
5. Leave "All Programs".
6. Select the Protocol you want to apply rules on, then in Local Ports, enter the port you want to apply to.
7. In Remote IP section, select to specify and add the IP of target you want to apply rules to.
8. Select the behaviour the paper asked, such as Block.
9. Accept all domains.
10. Give name and description in the paper, apply the rule.

## Question 3

* Config Windows 7 and Kali accordingly with the steps in Question 1, making sure their IPs land in the range of pfSense networks.
* Don't forget Kali needs a static route as it's on the WAN side, and Windows 7 needs gateway as it's on the LAN side. Check Question 1 subsection "With pfSense".

Once the network is configured, Windows 7 will be able to visit pfSense control panel by visiting pfSense's LAN side address (144.6.40.129 by default), login with admin/admin. After logged in:

* Click "Firewall" at the top bar, in the dropdown, click "Rules".
* Click the first "Add" button.

If creating a rule for ping:

* Select Protocol as "ICMP".
* You will be able to select subtypes, for ping, select "Echo request".
* Fill the description if the Question asked you to.
* Click the Save button.
* Then in the new page, click "Apply Changes".

If creating a rule for specific incoming TCP requests:

* Select Protocol as "TCP".
* Select the correct Destination Port or in "other" theme fill the port number in both "from" and "to" for "Destination Port Range".
* Fill the description if the Question asked you to.
* Click the Save button.
* Then in the new page, click "Apply Changes".

## Question 4

* Config RoamingWorker's network in the WAN side of the pfSense if required, remeber as it lays on the WAN side, it will use ```ens36``` network interface, and a static route will be needed.

To set up Wireguard, first get into root:

```bash
sudo su -
# student's password is "student".
```

Then direct to the Wireguard config folder to create Wireguard keypair:

```bash
cd /etc/wireguard

# This removes all permissions on group and other users for default permission upon file creation.
# If the default is 644, minus 077 makes it 600 (no minus).
umask 077 

# wg genkey: creates a private key, then pipe the content to tee.
# tee privatekey: forks the text stream from pipe before, one into file "privatekey", one in stdout which get piped to wg pubkey.
# wg pubkey: takes the privatekey from tee on stdout through pipe, then redirect the public key to file "publickey".
wg genkey | tee privatekey | wg pubkey > publickey
```

If you ```ls``` now, two files ```privatekey``` and ```publickey``` will be presented. Then config the network interface for Wireguard:

```bash
# If current directory is not at /etc/wireguard.
cd /etc/wireguard

# Create the Wireguard network interface (wg0 in tutorial)
ip link add <NetworkInterfaceName> type wireguard

# Assign the private IP used in Wireguard tunnel (10.0.0.x/24 in tutorial)
ip a a <PrivateIP>/<Prefix> dev wg0

# Config the interface with listening port (51820 in tutorial) and private key
wg set <NetworkInterfaceName> listen-port <GivenWireguardPort> privatekey ./privatekey
```
