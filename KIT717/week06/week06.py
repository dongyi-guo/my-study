import requests
from sense_emu import SenseHat
import time

s = SenseHat()

link_to_json = 'http://iotserver.com/to_json.php'

last_time = time.time()
server_interval = 2

while True:
    curr_time = time.time()
    if (curr_time - last_time > server_interval):
        temp = s.get_temperature()
        humid = s.get_humidity()
        print("Temperature: " + str(temp) + " Humidity: " + str(humid))
        payload = {'t' : str(temp), 'h' : str(humid)}
        r = requests.get(link_to_json, params = payload)
        if 200 == r.status_code:
            print("GET request sent successfully")
        last_time = time.time()
        
        

