import requests
from sense_emu import SenseHat
import time

s = SenseHat()

test_link = 'http://iotserver.com/test.php'
temp_link = 'http://iotserver.com/temperature.php'
log_link = 'http://iotserver.com/logger.php'

test_number = 52
temp_threshold = 20
print('Default Temperature Threshold is ' + str(temp_threshold))
print('Use Up and Down button to change the threshold.\nUse Middle Button to Get Status')
payload_test = {'num' : str(test_number)}
base_time = time.time()
time_interval = 5

while True:
    curr_time = time.time()
    if (curr_time - base_time > time_interval):
        temp_number2 = s.get_temperature()
        payload_temp2 = {'temp' : str(temp_number2), 'time' : str(curr_time)}
        r = requests.get(log_link, params = payload_temp2)
        print("Logged Temperature")
        base_time = time.time()
        
    for event in s.stick.get_events():
        if event.action == "pressed":
            if event.direction == "up":
                temp_threshold += 1
            if event.direction == "down":
                temp_threshold -= 1
            if event.direction == "middle":
                temp_number = s.get_temperature()
                payload_temp = {'temp' : str(temp_number), 'threshold' : str(temp_threshold)}
                r = requests.get(temp_link, params = payload_temp)
                print('Current Status: ' + r.text)
            print('Current Threshold: ' + str(temp_threshold))

