import requests
import hashlib

student_id = input("Enther Your Student ID: ")
passwd = input("Enter Your Password: ")
hashed_passwd = hashlib.md5(passwd.encode('utf-8')).hexdigest()
server_link = "http://iotserver.com/task1/readuserhash.php"
params = {'uname': str(student_id), 'pin': str(hashed_passwd)}

try:
    r = requests.get(server_link, params = params)
    if r.status_code == 200:
        print("\nConnected to Server Successfully\nAuthencating...\n")
        if "1" == r.text:
            print("Authentication Successful!")
        elif "0" == r.text:
            print("Auth Failed")
        else:
            print("Server Error")
    else:
        print(f"Error while Connecting to the Server: {r.status_code}")
except:
    print(f"Error while Initialising Connection")
