# CompTIA Linux+

## VirtualBox Host

In order to use VirtualBox, the user on the host machine must be included in `vboxusers` user group:

```bash
sudo gpasswd -a <user> vboxusers
```

If using SELinux:

```bash
sudo setsebool -P use_virtualbox 1
```

and reboot. Make sure you install Extension Pack later.

## VBox Guest

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

## Man Page

Man pages have different sections for different aspects of the command ( `man-pages` ). However, you will need a search database:

```bash
sudo mandb
```

now we can find the pages for command with:

```bash
man -f <command> # with exact command
man -k <command> # with keywords
```

## File Hierarchy Structure

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

## Files and Directories 

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

## Data Processing

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

## Boot-up

4 Stages (In booting order):

* Firmware (UEFI/BIOS)
* Bootloader (GRUB2/LILO/ISOLINUX/SYSLINUX/PXELINUX)
* Kernel (RAM/ROOT)
* Init (OpenRC/Systemd)
    * Systemd -> targes (Start-up groups)
    

Kernel Panic

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

## Processes and System Services

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

## Network

Components:

* Host address (DHCP)
* Network subnet
* Default gateway
* Hostname
* Name resolution (DNS)

Tools:
* net-tools (legacy)
* iproute2

### NetworkManager
