# With Grant McWilliams

## 1. VirtualBox Setup

### Host

In order to use VirtualBox, the user on the host machine must be included in `vboxusers` user group:

```bash
sudo gpasswd -a <user> vboxusers
```

If using SELinux:

```bash
sudo setsebool -P use_virtualbox 1
```

and reboot. Make sure you install Extension Pack later.

### Guest

In order to install VBox Guest ISO as Kernel Module, for Red Hat:

```bash
sudo dnf group install -y "Development Tools"
sudo dnf install -y kernel-devel # You may not need this
```

For Debian/Ubuntu:

```bash
sudo apt install build-essential linux-headers-$(uname -r)
```

This will give you the enough stuff to compile a kernel module, then we can install VBox Guest Edition from CD.

Also, hostname can be set at:

```bash
sudo hostnamectl set-hostname <hostname>.localnet.com
```

Locale can be checked and set with `localectl` .

Time and date can be checked and set with `timedatectl` .

## 2. Prior to Know

### Man Page

Man pages have different sections for different aspects of the command ( `man-pages` ). However, you will need a search database:

```bash
sudo mandb
```

now we can find the pages for command with:

```bash
man -f <command> # with exact command
man -k <command> # with keywords
```

### File Hierarchy Structure

* `/bin` : Basic binaries for system use.
* `/sbin` : Binaries essential for system booting, recovery or repairing.
* `/boot` : Everything needed to boot the system.
* `/dev` : Interface to system's hardware thru a driver. 
* `/etc` : Static configs.
* `/home` : User's home directories (NOT root user)
* `/lib` : Shared lib images needed to boot the system and run commands in FS.
    * There might be `/lib64` .
* `/media` : Mount points for removable media.
* `/mnt` : Mount points for temp FS.
* `/root` : Home directory for root user.
* `/opt` : Reserved for add-on softwares 
* `/proc` : Virtual FS for process information, kernel and memory information and others.
* `/srv` : Site-specific data.
* `/sys` : Kernel and system information VFS.
* `/tmp` : Global temp files.
* `/run` : Describe system since booted.
* `/usr` : Essential user command binaries, READ ONLY.
    * `/usr/bin` : Primary executable. In some system, `/bin` will be linked here.
    * `/usr/local` : Locally installed software.
    * `/usr/sbin` : Non-essential binaries used by system administrator. In some system `/sbin` will be linked here.
    * `/usr/share` : All READ-ONLY data.
    * `/usr/src` : Source codes to compile the tools.
* `/var` : Variable data files.
    * `/var/cache` : App cache data.
    * `/var/log` : App log data.
    * `/var/spool` : Data for later processing.
    * `/var/mail` : User Mailbox files.
    * `/var/lib` : Holds state information pretaining to an app or the system.

## 3. Files and Directories 

`tree` command better with `-f` to show full path and `-i` to negate the branch. 

`cd -` brings you to your last wd, it bounces, very powerful.

`mkdir` needs `-p` to create nested hierachy and {} for multiple dirs:

```bash
mkdir -p foo/bar
mkdir {dir1, dir2, dir3}
```

Use `cat >> <file>` will make you append `stdin` inside file.

Use `file` to tell the filetype, not fooled by suffix.

Use `stat` to show bunch of information of metadata

Use `cp -R` to copy stuff recursively while copying directories. `-a` for keeping metadata and `-u` for only copying this user's stuff.

`mv` from one FS to another FS, the data block of file actually moves, but if SAME FS, it will only update the file location, no data is actually moved.

You can always use globs to quickly perform:

```bash
mkdir dir[12]
touch file{a,b,c,d}
```

When `rm` , try to use `-i` to negate remove things you don't want to, or use `-R` to step-by-step traverse.

`ln` without any flag creates hard link: 

* Same chunk of data.
* Same inode number.
* Took no more spaces.
* Doesn't break if source deleted.
* Only works on files.
* Remove all inodes to delete the data chunk.

`ln` with `-s` creates a soft link:

* Can go thru file systems.
* Can do directories.
* Has own its own size.
* Break if source deleted.
* When deleteing directories, negate tailing `/` or everything gets removed.

### Pipe

Unnamed Pipe: It's the one with `|` .

Named Pipe: It's an actual pipe file located in the system:

* with a leading `p` at file description.
* halt if piping mission does not finish.

### Redirect

`STDOUT` and `STDERR` output can be combined redirected out:

```bash
find > output.txt 2> error.txt
# Same file
find &> output.all
```

To redirect a output to both a file and `STDOUT` or `STDERR` , we use `tee` :

```bash
find > output.txt
# Goes to
find | tee output.txt
# Now the output is on the terminal and the file.
# -a to append
```

Piping default only cares `STDOUT`, to get `STDERR`:

```bash
find 2>&1 | grep something
# 2 means STDERR goes and merges to STDOUT, and piped.

#OR nowdays:
find |& grep something
# Pipe both STDERR and STDOUT.
```

Or if `STDERR` only:

```bash
find 2&>1 > /dev/null | grep something
# The original STDOUT gets sent out.
```

Use `locate` command to find all the files for a command, can be combined with regular expressions.

* It does a fairly loose search and bases on databases.
* Database is updated by system services per 24 hours.
* `sudo updatedb` to do this manually.

### Data Processing

When using multiple commands in one line, we can use parentheses `( )` and curly braces `{ }` to group them.

The difference is, in parenthese things are run in subshell:

```bash
a=0 ; (a=10 ; echo "In=$a" ;) ; echo "Out=$a" ;
# This will give:
# In=10
# Out=0

# But if:
a=0 ; {a=10 ; echo "In=$a" ;} ; echo "Out=$a" ;
# This will give:
# In=10
# Out=10
# As everything is running on the same shell, a was finally assigned to 10 thruout.
```

### Sed - Stream Editor, with BRE and ERE

Modes:

* Print: `/pattern/p`
* Delete: `/pattern/d`
* Substitute: `s/find/replace/g`

Line support: `5 ,10s/...`

Delimiter is normally `/` , but if filepath is envolved things can get dirty, so we can use `#` .

For `sed` you cannot redirect back to the same file in printing mode which will empty the whole thing.

```bash
sed -E 's/:([0-9][0-9]{0,2}):/:uid:/' /etc/passwd
# This will match all the :0: to :999:
# and replace it with :uid:
```

## 4. Boot-up

4 Stages of Kernel Booting (In Order):

* Firmware (UEFI/BIOS)
* Bootloader (GRUB2/LILO/ISOLINUX/SYSLINUX/PXELINUX)
* Kernel (RAM/ROOT)
* Init (OpenRC/Systemd)
    * Systemd -> targes (Start-up groups)
    
Cause of Kernel Panic:

* Missing drivers
* Bad drivers
* Use old Kernel

```bash
sudo grub-set-default 1
```

* Use other systemd target
    * Needs root access.
    * Does not:
        * Load Drivers
        * Start Services
        * GUI
        * Mount/Read/Write

```bash
# On GRUB2 kernel selection, get in with "e", and added after the
# linux line.
systemd.unit=emergency.target

# Check journal in shell after logged in:
journalctl -xb

dmesg # Similarly
dmidecode # Check BIOS information
```

The root `/` at this moment will be mounted as read-only, you will need to remount it so you can write changes:

```bash
mount -o remount rw /
```

After everything, loggout the session will continue the system booting.

Password Recovery:

```bash
# At GRUB2, find linux entry and append:
init=/bin/sh
```

At this point you will have shell avaiable, and you remount as before. Then you change your password.

After this, we need to make SELinux relabel all the files with the new security contents. To do this, create a file in `/`:

```bash
touch /.autorelabel

# Then reboot with full path:
/usr/sbin/reboot -f
```

## 5. Processes and System Services

SysVinit Runlevels:
* System services start at 3.
* Range to 5.
* one at a time.
* Can hold each other.
* Slow.
* No development.
* Restart desruptive.

Upstart:
* Asynchronously.
* Monitor running processes.
* Backward compatible with SysVinit.
* Can be extended to interact with other event systems.

systemd
* Suite of software.
* Unify.
* init included.
* Manages so many things.

### systemd

systemd Unit: object that has a config on disk as a unit file.

```bash
systemctl list-units 
systemctl list-unit-files -t <type> -a --state <state>
systemctl status <unit>
systemctl enable/disable/mask/unmask/cat/start/stop/restart/is-enabled/is-active <unit>
```

### Job Scheduling

5 types:
* One-time **AT** jobs.
    * By User.
    * Run one time.
    * atd.
* One-time **BATCH** jobs. (System loadout below 0.8)
    * Similar to AT jobs
    * But only run when system has enough resources.
    * atd.
* Recurring **USER** jobs.
    * By User.
    * Run repeatedly.
    * crond.
* Recurring **SYSTEM** jobs.
    * By the system admin (root).
    * Run repeatedly.
    * crond.
* systemd timers.
    * Logged in to the journal.
    * Event driven.

#### AT

```bash
at <time>
# 4:25am, 16:45, midnight, noon, teatime(4pm)
# now +2 hours
# now +2 days
# 4pm +3 days
# 3am tomorrow
# January 15 2022
# 011522, 01/15/22, 01.15.22
# 12:30 011522
# -t 202201151230.30

atq # The queue
at -c <job_id>
atrm <job_id>
```

#### BATCH (System load average below 0.8)

Will be executed if system resources allow, with command `batch`.

#### CRON (cronjob)

User cronjobs:

* Specific to each user.
* Managed by users.
* Stored in /var/spool/cron/$USERNAME.

System cronjobs:

* System-wide.
* Managed by root.
* Run by the operating system.
* Stored in /etc/cron.d

Log of cronjobs can be found at /var/log/cron.

##### Crontab Format:

Separated by space:

* Minute [0-59] 
* Hour [0-23] 
* Day [1-31] 
* Month [1-12 or jan-dec]
* DOW [0-7 or sun-sat] 
    * 0 and 7 both means sun.
* User to run (if system cronjob)
* command

Special use case:

* "*" means every unit.
* Use "," to separate multiple values.
* Use "-" to indicate range.
* Use "*/" to indicate every unit after it.

#### systemd timer Units

Types:

* Real-Time Timers
    * Activated on Calendar events.
    * Act similar to cron jobs.
    * Start based on a date and time value.
* Monotonic Timers
    * Activated after a time span relative to a starting point.
    * Five minutes after boot.
    * 30 seconds after login.

Advantages of systemd timer units:

* Logged in systemd journal.
* Jobs can be started independently to a timer.
* Jobs can run in their own environments.
* Jobs can be attached to their own container groups.
* Jobs can have dependencies.

Advantages of cronjob:

* Easier to create.
* Support for emailing on job failure.

Format:

* unit.timer
* unit.service
* unit.sh (not required)

## 6. Network

Components:

* Host address (DHCP)
* Network subnet
* Default gateway
* Hostname
* Name resolution (DNS)

Tools: (They are repleacement to each other in order for net-tools and iproute2)

* net-tools (legacy)
    * ```arp```
    * ```ifconfig```
    * For set up/down an interface: ```ifconfig <Interface> up/down```
    * Host setting: ```ifconfig <Interface> <IP> netmask <SubnetMask>```
        * This sets the address, adding more IPs need alias.
    * ```iptunnel```
    * ```mii-tool```
    * ```netstat```
        * -neopa
    * ```route```
    * For adding a route: ```route add -net <NetworkIP> netmask <SubnetMask> dev <Interface>```
    * For setting a default gateway: ```route add default gw <IP>```
* iproute2
    * ```ip neighbor```
    * ```ip address```
    * For set up/down an interface: ```ip link set dev <Interface> up/down```
    * Host setting: ```ip address add <IP>/<Prefix> dev <Inferface>```
        * This adds the address, you can just keep adding.
    * ```ip tunnel```
    * ```ethtool```
    * ```ss```
        * -neopa
    * ```ip route```
    * For adding a route: ```ip route add <NetworkIP>/<Prefix> dev <Inferface>```
    * For setting a default gateway: ```ip route add default via <IP>```

Legacy Network Interface Naming:

* Ethernet: eth0, eth1...
* Wireless: wlan0, wlan1...

Consistent Network Interface Naming:

* enp0s3: Ethernet, PCI bus 0, slot 3
* wlp3s0: Wireless, PCI bus 3, slot 0

### Config File

* Debian: /etc/network/interfaces
* SUSE: /etc/sysconfig/network/ifcfg-*
* Red Hat: /etc/sysconfig/network-scripts/ifcfg-*
* NetworkManager: ```NetworkManager --print -config```
    * First looking: Key file
        * ```/etc/NetworkManager/system-connections/```

Format:

```
NAME="Wired Connection"
UUID=blabla123
DEVICE=enp0s3
BOOTPROTO=dhcp # OR "none"
ONBOOT=yes
IPADDR0=192.168.1.1
PREFIX0=24 # OR NETMASK=255.255.255.0
GATEWAY0=172.16.25.1
DNS1=4.2.2.2
PEERDNS="no"
```

### Keyfile

Format:
```
[connection]
id=Wired Connection 1
uuid=ijfijdifjd

type=ethernet
autoconnect-priority=-999
interface-name=enp0s3
timestamp=932840932840928940

[ethernet]

[ipv4]
method=auto (or manual)
address1=192.168.1.1/24,192.168.1.255 (Gateway after comma)
dns=4.2.2.2
ignore-auto-dns=true
```

After configuring the network config file, you may wanna reload the network to make it effect and config hostname, best practice with ```hsotnamectl```:

```bash
nmcli con reload
sudo hostnamectl set-hostname <hostname>.localnet.com
```

And focus ```on /etc/hosts``` and ```/etc/resolv.conf```


### NetworkManager

* nmcli
* nmtui
* control-center
* nm-connection-editor

#### nmcli sub commands

```bash
nmcli general status
nmcli networking connectivity
nmcil radio wifi on
nmcli monitor

# connection
nmcli connection monitor # nmcli c m
nmcli connection show # nmcli c s

# device
nmcli device monitor
nmcli device wifi list
nmcli device wifi rescan
nmcli device wifi hotspot
```

connection:

* Show connection stats
* Activate / Deactivate interface
* Add / Delete interface
* Modify a connection
* Edit connection interactivity
* Clone a connection
* Monitor connections
* Reload all connections
* Load an ifcfg file
* Import / Export VPN connections

### DNS

The resolution order is defined in ```/etc/nsswitch```

Besides ```hosts``` and ```resolv.conf```, in your network config file, you can also put DNS entry there.

To find the DNS resolution to certain domain, go with:

```bash
dig @<DNSIP> <DomainName>
```
### Network Troubleshooting

Dynamic Rules:

* Routing
* Network saturation
* Packet drops
* Timeouts
* Name resolution
* Network adapers
* Network interface configurations

Routing Issue Tools:

* route
* netstat -r
* ip route

Packet Hops

* nmap
* traceroute
* tracepath
* mtr

ARP:

* arp

(There is no harm to delete ARP table and let the system to regenerate.)

Network Saturation:

* iftop 
* ipperf

Packet Drops / Timeouts

* ping
* tcpdump
* Wireshark
* netcat

DNS:

* nslookup
* dig
* host

Network Adapters

* ethtool
* nmcli
* ip
* ifconfig

## 7. Users & Groups

User Type:

* Non-login users: used to run system services
* Login users:
  * Super user (root)
  * Regular user

Groups:

* Access Control for lots of users
* User must have a group and primary group
  * Resource created will take user and the primary group

User and Group must have an ID, for normal user, it starts from 1000 and increase from that.
  * Can be configed at ```/etc/login.defs```

All names are case-sensitive .

### Users

Stays at ```/etc/passwd``` - Plain Sight!

Format is (delimited by : )

* Username
* Encoded Password (x for shadowed)
* User ID
* Group ID (Primary)
* GECOS comment (Description)
* Home Directory (useradd -d)
* Default Shell (useradd -s/-D)
  * ```cat /etc/shells```

Password stays at ```/etc/shadow```

* Only root can access
* Contains Password and Aging information
* 9 columns
  * Username
  * Password Field 
    * !! for password not set
    * \$6\$ is hash type
      * Change by ```sudo authconfig -passalgo sha512```
      * Change at ```/etc/pamd.d/password-auth```
    * Then salt
    * Then encoded password
  * Date since password changed
    * Offset 1970/1/1
  * Number of days that password can be changed
    * 0 means anytime
  * Number of days that password must be changed
  * Days to warn user expiring
  * Grace period - After expiration, how long can user still login
  * Account expiration date
    * Offset 1970/1/1
  * Reserved

#### File / Command that change account defaults

* /etc/login.def
* authconfig
* chage

### Groups

Lists at ```/etc/groups```

Format:

* Group Name
* Group Passowrd
  * Stores at ```/etc/gshadow```
* Group ID
* List of users (delimited by , without spaces)

Passowrd information is at ```/etc/gshadow```

Format

* Group Name
* Group Password
  * Same as users
  * If set, any user can use ```newgrp <GroupName>``` to switch to this group when password input correctly.
    * ```newgrp``` actually creates a new level of shell with the new group alignment.
      * Verify with ```echo SHLVL```
  * If none, then only members of the group can switch to it directly.
  * If !, then only members of the group can switch to it after passowrd input.
  * This group will become Primary Group.
* Group Admins
* Group Users

### Commands

#### useradd - create an user

* -d: Home Directory
* -u: User ID 
* -g: Primary Group ID
* -G: Supplementary Groups
* -s: Default Shell
* -e: Expiration
* -f: Inactive Period
* -r: System Account
* -p: Normal Encrypted Password
* -M: No Home Directory
* -N: No Primary Group
* -k: Specify Skeleton Directory

#### usermod - modify an user

* -s: Change Shell
* -l: Change Username
* -u: Change UID
* -d: Change Home Directory
* -g: Change Primary GID
* -G: Set supplementary groups
* -a: Append (Group with -aG)
* -m: Move Home Directory
* -L: Locks account
* -U: Unlocks user account
* -e: Set account expiration
* -f: Account inactive periodt

#### userdel - delete a user

* -r: Remove the home directory as well

#### ```groups (+<Username)```

Gives groups user is belonging to.

#### ```id (+<Username)```

Gives lots of information about the user.

#### ```getent group (+<GroupName>)```

Gives group(s) information.

#### Other commands

* ```groupadd``` - add a group
* ```groupmod``` - modify a group
* ```groupdel``` - delete a group

#### gpasswd - admin groups

* -a: add user to group
* -d: remove user from group

(Group change applies after re-loggin)

### Privilege Escalation

#### su - switch user

* -c: specify user
* -g: specify group
* -r / -l : login shell
* -s: specify shell

#### PAM - Pluggable Authentication Module

Stays at ```/etc/pam.d/su```

```whoami``` gives you switched, while ```logname``` gives you your logged in name.

#### sudo

To config, use ```visudo```

##### sudo Alias

* User_Alias: Groups users
* Runas_Alias: Groups run-as users
* Cmnd_Alias: Groups commands
* Host_Alias: Groups hosts

## 8. Storage

Types:

* File Storage
  * Hierachy
  * Data
  * Metadata
  * Local FS
  * Network FS
* Block Storage
  * Expose blocks in binary data
  * Unique Identifiers
  * Reassembles blocks 
  * ISCSI
* Object Storage
  * Manages data
  * Links data to metadata
  * Data stored in discrete objects
  * Single Repository
  * Red Hat Ceph

### Partitions

In order to get all the partition status: 

* ```cat /proc/partitions```
  * Up to date, as getting what kernel recognizes
* ```lsblk```
* ```blkid```
* ```fdisk -l```
  * Read the partition type
  * use ```partprobe``` to update table (Kernel Re-read)

Then you just use ```fdisk```:

* Use g to create a new empty GPT partition table
* Use n to createa new partition
* Use m for help
* Use p to print partition table
* Use w to save and quit

Then use ```udevadm settle``` to fully register your changes (Make kernel recognize).

Also, ```parted``` is helpful:

* help <subcommand>
* print all/devices/free
* select /dev/sdX
* mktable gpt/ms-dos
* mkpart primary 1MiB 500MiB
* rm

### LVM - Logical Volume Management

Partition cannot change, and cannot be uncontinuious.

LVM allows:

* Resizing
* Combining
* Moving
* Adding addtional drives
* Hot replacing underlying drives (without FS even knowing)

LVM works on a partition, create one by

```bash
pvcreate /dev/sdb?
```

where ? is the partition number, verfiy with ```pvs``` command listing the LVMs, or ```pvdisplay``` to have more details.

Your can also create groups of LVMs, by using:

```bash
vgcreate <GroupName> <Partition>
```

and verfiy with ```vgs``` or ```vgdisplay```

To create a volume in this group:

```bash
lvcreate --name <VolumeName> --size <SizeLike495M> <GroupName>
```

Make sure if you are creating volume inside a group, make it a bit smaller so it will actually fit.

Similary, there are ```lvs``` and ```lvdisplay```

Normally, the LVM Volume pathnames are 

* ```/dev/VolumeGroupName/LogicalVolumeName```
* ```/dev/mapper/VolumeGroupName-LogicalVolumeName```
* ```/dev/mapper/vg--data-lv-data```

Format Tools:

* mkfs
  * -t for type
* mke2fs
  * More options on journal types and optimizations

Verify with ```df -Th```

Setup login mounting with ```vim /etc/fstab```


#### Expanding LVM volume

When increasing volume size, you can either unmount or not.

Expanding can be done by including more volume in the VG. To include more volumes:

```bash
vgextend <GroupName> <DevLabelOfTheLVM>
```

To change the size:

```bash
lvresize -l 100%VG> <LVMVolumePath>
```

After this, you can find the difference with ```lvs```, but not ```df -h```, that is because th FS hasn't be operated (formatted) to adapt this change.

To do this, use ```resize2fs```:

```bash
resize2fs <VolumeDevPath>
```

#### Reducing LVM volumes

When decreasing volume size, you HAVE TO unmount.
* FS like XFS cannot be resized down.

```bash
umount <DevPathOfVolume>
```

Check FS with ```e2fsck```

```bash
e2fsck -ff <DevPathOfVolume>
```

If all checks passed then proceed with ```resize2fs```

```bash
resize2fs <VolumeDevPath> <TargetSize>
```

Then, do with ```lvresize```

```bash
lvresize -L <TargetSizeLike500M> <LVMVolumePath>
# Then comfirm with yes
```

You can verify with ```lvs``` then, or remount then check with ```df -h```.

You can also do the whole process with one command actually:

```bash
lvresize -r -L <TargetSize> <DevPathOfVolume>
```

### File System's Format

To see possible format:

```bash
ls /sbin/mk*
```

You need to unmount before format.

You format with ```mkfs -t <Type>```, which will call proper function in the folder shown above such as ```mkfs.ext4```

To convert ext2 to ext3:

```bash
tun2fs -j /dev/vgdata/lvdata 
# -j creates journal, which is essentially the only difference between ext2 and ext3
```

To convert ext2/ext3 to ext4:

```bash
tun2fs -O extent,uninit_bg,dir_index /dev/vgdata/lvdata 
# extent means using extent trees (ext4).
# uninit_bg speeds up file check after the first one is completed.
# dir_index uses hashed b-trees to speed up lookouts.
```

Then check with ```e2fsck```:

```bash
e2fsck -fD  /dev/vgdata/lvdata
```

Then mount the new storage to verify with ```df -Th```

fsck - check and repair the FS:

* -A: all FS
* -AR: all but root
* -f: even clean FS
* -a: fixes safe problems automatically
* -y: Yes all questions
* -n: Pretend to repair

Issue here is: you need to unmount the FS in order to check, for some FS like root FS, it is not practical to do with ```fsck``` , and you will need to make the check while rebooting.

Old OS let you do that by creating ```/forcefsck``` , nowdays you can't do that. You can use 

```bash
tune2s -c 1 <DevPath>
# set -1 to disable
```

will make the check. You can use ```tune2s -l <DevPath>``` for checking the Maximum Mount Count setting, if -1 disabled, 1 enabled.

For XFS, use ```xfs _repair``` , other XFS commands are:

* ```xfs_admin``` : Change file system parameters
* ```xfsdump``` : File system backup tool
* ```xfs_freeze``` : Suspends access to a file system
* ```xfs_quota``` : Handles XFS file system quotas
* ```xfs_growfs``` :  Resizes XFS file system larger

### RAID - MDRAID

DevPath: ```/dev/mdX```

Levels:

* 0: Striping; fast, no redundancy, 2 drives minimum.
* 1: Mirroring; Mirror 2 drives in pairs.
* 4: Striping with parity; requires three drives minimum.
* 5: Striping with striped parity; requires three drives minimum.
* 6: Striping with two levels of redundancy; 4 drives minimum.
* 10: Striping and Mirroring; 4 drives.
* Linear
* Multipath

Also - DMRAID

* Uses device mapper
* ```/dev/volumegroup/logicalvolume```
* Admin with LVM
* Supports all the same, instead of mirrors rather than Multipath

Unmount any drives before making RAID, use ```vgremove <GroupName>``` you can remove a volume group. If you do so, make sure any ```/etc/fstab``` entries about the volumes you removed is cleaned as well.

To create a RAID, first create the volume group.

```bash
vgvreate <VGName> <Dev1> <Dev2> <Dev3>
# VGName: /dev/vgraid
# Dev1..3 /dev/sdb1, sdc1 ...
```

This group so far has nothing special yet, to apply RAID on it:

```bash
lvcreate --type raid5 -i 2 100%VG -n <RAIDName> <VGName>
# RAIDName: /dev/lvraid
# VGName: /dev/vgraid
# -i: index, start from 0, 2 means 3 drives
# -n: name
```

Then verify with ```lvs``` and format with ```mkfs```, then mount to a mount point:

```bash
sudo mkfs -t ext4 <DevRAID>
# DevRAID: /dev/vgraid/lvraid
sudo mkdir /media/lvraid
sudo mount /dev/vgraid/lvraid /media/lvraid
```

Then verify ```df -h``` and use ```fio``` command to test speed.

### RAID with mdadm

For software RAIDs with mdadm, partitions are not necessary, but having partitions make it possible to mount on boot.

To start, change the drive types to RAID with ```fdisk```, option 't', and use type 'Linux RAID'.

#### mdadm Modes

* Assemble: Assembles preexisting array.
* Incremental assembly: Adds single device to array.
* Create: Creates a new array.
* Build: Builds an array from drives without RAID metadata.
* Monitor: Monitors RAID devices and acts on state change.
* Grow: Grows, shrinks or changes an array, this is how you change your RAID levels.
* Manage: Adding new spare drives without interpreting others.
* Misc: For miscellaneous items.

#### Create

```bash
sudo mdadm --create <Name> <Dev1> <Dev2> <Dev3> --level=5 --raid-device=4 -- bitmap-=internal
# Name: /dev/md/mdraid
# Dev1..3: /dev/sdb1, sdc1 ...
```
This can be inspected with ```lsblk``` , you will find there are RAID partitions on each drive/partition called ```md<SomeNumber>``` where ```SomeNumber``` will start from 127 and decremental for each new RAID. ```/dev/md/mdraid``` is actually a link to this device.

Get RAID stat: ```cat /proc/mdstat``` or ```sudo mdadm --detail /dev/md/mdraid``` .

To have ```mdmonitor``` keeping eyes on RAIDS, start the systemd service:

```bash
sudo systemctl enable mdmonitor
sudo systemctl start mdmonitor
```

Then you can create FS on RAID with ```mkfs```, mount it to a mount point, then verify with ```df``` or ```lsblk``` .

#### Remove

```bash
# First, unmount
sudo umount <MountPoint>
sudo mdadm --stop <RAIDName> # /dev/md/mdraid
sudo mdadm --zero-superblock <Dev1..>
# Such as /dev/sdb1, do this to every drive/partition invovled.
sudo systemctl stop mdmonitor
sudo systemctl disable mdmonitor
```

Then use ```fdisk``` to change all your partitions back to linux format.

#### Other useful flags

* --query: Gives summary
* --detail: Gives details
* --fail: Marks device faulty, so you can replace
* --remove: Remvoes a device or array (After being stopped)
* --add: Adds a device
* --stop: Stop the array
* --zero-superblock: Removes RAID superblock so the system won't try to reassemble the array

### Mount on boot

```/etc/fstab``` is the goat.

A fstab entry contains 6 fields:

1. Description: Can be UUID, DevPath or Labels of the device.
  * Use ```e2labels``` to create Labels.
  * If use UUID, then use UUID=****
  * If use label, then use LABEL=****
2. MountPoint: Where is the mount point.
3. FS type: File System type like ext4.
4. Mount Options: What is the feature of this mount?
  * defaults: rw, suid, dev, exec, auto, nouser, async.
5. Dumped: Whether the system should be dumped a backup, 0 to not dump if not present.
6. System Check Order: The order of this FS, compared to other FS, to be checked on boot.
  * root is better to be 1, others should be higher.
  * If not then 0.

If config successfully, ```sudo mount -a``` should mount any unmounted drives in the ```/etc/fstab``` .

### LUKS - Encryption

Before encrypting, make sure ```/etc/fstab``` does not have any entries about the drive. Then encrypt:

```bash
sudo cryptsetup -y -v luksFormat <Dev>
# Dev: Such as /dev/sde1
```

Then you will need to enter a strong password. After creation, make the decrypted device avaiable for use:

```bash
sudo cryptsetup -v luksOpen <Dev> <Name>
# Dev: /dev/sde1
# Name: Name for decrypted device, like decryptedvolume
```
Check with ```ls -l /dev/mapper``` .

To close it (lock it)

```bash
sudo cryptsetup -v luksClose <VolumeDevPath>
# VolumeDevPath: /dev/mapper/decryptedvolume
```

### Storage Troubleshooting

1. Space check:
  * ```df -hT```
  * ```du -h <Dir>```
2. IO check:
  * ```sudo iostat -d(x) -t <Interval_Sec> <Times>```
    * Shows CPU
  * ```sudo iotop```
    * Shows Application
3. IO Schedulers:
  * CFQ
  * Deadline
  * NOOP (FIFO)
4. Drive Check
  * ```fstrim```
  * ```fsck```
  * ```xfs_check```
  * ```xfs_repair```
  * ```btrs check```

## 9. Backup, Restore and Compression


