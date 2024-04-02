# KIT726 考试准备 

## 第二模块 Windows系统管理

* 在任何需要使用PowerShell的时候，都建议直接使用ISE的命令行部分，在输入的时候会有命令补全提示，可以通过上下键选择和Tab来进行补全。

### 第一题（在Windows Server 2016 和 Windows 7/10 上操作）

对于Windows, 去到Network and Sharing Centre, 然后点Properties, 然后选中IPV4, 然后点Properties, 根据题目设置IP地址.

### 第二题（在 Windows Server 2016 上操作）

在试卷中找到 "Organizational Unit Name", 在ISE中输入命令，并替换括号内的部分根据问题内容:

```powershell
New-ADOrganizationalUnit -Name (Organizational Unit Name) -Path "dc=networks,dc=local"
```

### 第三题（在 Windows Server 2016 上操作）

在试卷中找到 "ADGroup Name", 在ISE中输入命令，并替换括号内的部分根据问题内容:

```powershell
New-ADGroup -Name (ADGroup Name) -Path "ou=(Organizational Unit Name),dc=networks,dc=local" -GroupScope Global
```

### 第四题（在 Windows Server 2016 上操作）

我们先需要找到本题中要使用的CSV文件，CSV文件的路径会在试卷中给予，例如： ```C:\a\b\c\d\users.csv```    

* ```C:\a\b\c\d\``` 可以为任何路径，在此举例。
* CSV文件名可以为任何名称，在这里使用 ```users.csv```

通过cd命令去到包含这个CSV文件的上层文件夹：

```powershell
cd C:\a\b\c\d
```

使用ISE打开CSV文件， 文件会打开在命令行的上方：

```powershell
ise users.csv
```

**仍然在命令行中**，使用以下命令创建ps1脚本文件，脚本文件可以为任意名称，在此举例```script.ps1``` ：

```powershell
New-Item script.ps1
```

使用ISE打开该脚本文件：

```powershell
ise script.ps1
```

在打开的脚本文件中，编写以下代码:

* 对于 ```$user``` 变量中可用的属性值，需要通过查看CSV文件的表头来确定调用什么样的值。
* 根据试卷提示，对应的分配组号和组名。
* ```elseif``` 没有空格。

```powershell
Import-Module ActiveDirectory

# 使用卷子中提供过的路径
$users = Import-Csv "C:\a\b\users.csv" 

foreach ($user in $users){
	# 此命令添加用户，注意调用$user变量的时候可用的属性值
	New-ADUser -Name $user.Name -Path "OU=department,dc=networks,dc=local" -UserPrincipalName $user.UPN -GivenName $user.FirstName -Surname $user.SurName -AccountPassword (ConvertTo-SecureString -AsPlainText $user.Password -Force) -Enabled 1
    
    # 使用if条件句分组
    if ($user.Group -eq 1) { # 组号对应更改
        Add-ADGroupMember -Identity student -Members $user.Name # 组名对应更改，此处为student
    } elseif ($user.Group -eq 2) { # 组号对应更改
        Add-ADGroupMember -Identity teacher -Members $user.Name # 组名对应更改，此处为teacher
    }
    # 如果还有其他组要分，使用更多的elseif，或else如果没有冗余组号。
}
```

在命令行中，执行以下命令来运行该脚本：

```powershell
.\script.ps1
```

### 第五题（在 Windows Server 2016 上操作）

如果被问及在特定文件路径下创建这个新的分享文件夹：

```powershell
cd (文件路径)
```

创建该文件夹：

```powershell
mkdir (文件夹名称)
```

创建一个SMB分享（SMB share）给予一个分享名称或使用试卷中给的分享名称，在分享文件夹的路径上，并通过使用不同的选项来给予试卷中要求的用户组（ ADGroup）对应权限：

* FullAccess：读写权限
* ReadAccess：读权限
* ChangeAccess：写权限

```powershell
New-SMBShare -Name (分享名称) -Path (文件夹路径) -FullAccess (或者ReadAccess以及ChangeAccess) (用户组名称)
```

### 第六题（在 Windows 7 或 Windows 10 上操作）

1. 在开始菜单中，搜索 "System", 打开那个名字里只有一个 "System" 单词的控制面板选项。
2. 点击 "Change Settings"
3. 点击 "Change..."
4. 在新对话框的下半部分会有一块叫做 "Member of"，选择其选项至 "Domain" 然后输入Windows Server 2016 的域名（Domain Name）如果没有特殊设置则为 ```networks.local``` 
5. 输入Windows Server 2016中的一对管理员用户名和密码，Administrator及ToorToor1足以。
6. 设备会欢迎并要求重启，重启即可。

### 第七题（在 Windows 7 或 Windows 10 上操作）

1. 完成Question 6并重启后，在锁定屏幕选择 "Log in as Other User" 以其他用户登录。
2. 使用一个Windows Server 2016 上有的用户进行登录：
   1. 如果 Question 4 成功了，在CSV中选择一个用户，或者选择试卷指定的已经经过特殊配置的用户来登录。
   2. 如果失败，可以继续使用Administrator和ToorToor1来继续。

3. 打开文件管理器，在地址栏输入 ```\\CorpDC1```
4. 然后选择那个在 Question 5 中创建的SMB分享，根据之前的分享名称：
   1. 如果使用了Administrator和ToorToor1，该用户可能看不到这个分享，可以 **回到Windows Server2016**，把 Question 5 的第三个命令的 用户组换成Administrator 并再次执行该命令。

5. 可以正常打开分享即可得分，如果无法打开尝试登出并重新登入。
