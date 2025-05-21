from sense_emu import SenseHat
import requests, time

s = SenseHat()
server_link = "http://iotserver.com/task2/recordtempenc.php"

while True:
    temp = s.get_temperature()
    params = {'t': str(temp)}    
    try:
        r = requests.get(server_link, params = params)
        if r.status_code == 200:
            print("\nConnected to Server Successfully\nSaving...\n")
            if "1" == r.text:
                print("Saving Successful!")
            elif "0" == r.text:
                print("Saving Failed")
            else:
                print("Server Error")
        else:
            print(f"Error while Connecting to the Server: {r.status_code}")
    except:
        print(f"Error while Initialising Connection")
        
    time.sleep(0.5)
