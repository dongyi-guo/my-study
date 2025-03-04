## Module 2

* Anytime you are asked to use a PowerShell, just use ISE instead.
* This sheet will consider ISE is open before everything.

### Question 1

For all Windows, go to Network and Sharing Centre, then Properties, then IPV4, then Properties, and change accordingly.

### Question 2 (Windows Server 2016)

Find the "Organizational Unit Name" in paper, then enter in ISE:

```powershell
New-ADOrganizationalUnit -Name (Organizational Unit Name) -Path "dc=networks,dc=local"
```

### Question 3 (Windows Server 2016)

Find the "ADGroup Name" in paper, then enter in ISE:

```powershell
New-ADGroup -Name (ADGroup Name) -Path "ou=(Organizational Unit Name),dc=networks,dc=local" -GroupScope Global
```

### Question 4 (Windows Server 2016)

So first, we need to find that CSV file, the Path to CSV will be provided to you, like ```C:\a\b\c\d\users.csv```    

* The CSV file can be called different, here we use ```users.csv```

So go to the folder containing it:

```powershell
cd C:\a\b\c\d
```

Then open the CSV file:

```powershell
ise users.csv
```

Then create your script file here, name might be given or up your choice, here we use ```script.csv```

```powershell
New-Item script.ps1
```

Then open the script file:

```powershell
ise script.ps1
```

Then, you will need to write your script in the open window for script file:

* For ```$user``` , check the CSV file for column headings
* For group you need to make this user into, change Group Name accordingly

```powershell
Import-Module ActiveDirectory

# Change the CSV based the path given to you
$users = Import-Csv "C:\a\b\users.csv" 

foreach ($user in $users){
	# Add Users
	New-ADUser -Name $user.Name -Path "OU=department,dc=networks,dc=local" -UserPrincipalName $user.UPN -GivenName $user.FirstName -Surname $user.SurName -AccountPassword (ConvertTo-SecureString -AsPlainText $user.Password -Force) -Enabled 1
    
    # Divide into Groups
    if ($user.Group -eq 1) {
        Add-ADGroupMember -Identity student -Members $user.Name
    } elseif ($user.Group -eq 2) {
        Add-ADGroupMember -Identity teacher -Members $user.Name
    }
    # If there are more numbers of groups you need to divide, use another elseif.
}
```

Then execute the script by going back to the command line part:

```powershell
.\script.ps1
```

### Question 5 (Windows Server 2016)

If you are asked to create this folder in certain Directory Path

```powershell
cd (Directory Path)
```

Creating new directory with a Directory Name;

```powershell
mkdir (Directory Name)
```

Creating SMB share with a SMB Name for the newly created Directory Path and for a certain ADGroup Name with different access flag (-FullAccess, -ReadAccess, -ChangeAccess)

```power
New-SMBShare -Name (SMB Name) -Path (Directory Path) (-FullAccess) (ADGroup Name)
```

### Question 6 (Windows 7 or 10)

1. In Start Menu, search "System", open the control panel exactly called "System"
2. Click "Change Settings"
3. Click "Change..."
4. Select "Domain" under "Member of", then enter Windows Server 2016's Domain there
5. Enter Credentials of one of the Administrators on Windows Server 2016
6. After being welcomed, reboot

### Question 7 (Windows 7 or 10)

1. After the reboot of Question 6, after seeing the lock screen, go to option of "Log in as Other User"
2. Login with a newly created user's credential, if Question 4 is smooth, pick on in the CSV file.
3. Open File Explorer, in the address bar, enter ```\\CorpDC1```
4. Then click on the folder with the SMB Name you created in Question 5
5. Open it with no error will land the mark.



