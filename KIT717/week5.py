import requests
from sense_emu import SenseHat
import time

s = SenseHat()

test_link = 'http://iotserver.com/test.php'
temp_link = 'http://iotserver.com/temperature.php'
log_link = 'http://iotserver.com/logger.php'
recordtemp_link = 'http://iotserver.com/recordtemp.php'
recordorientation_link = 'http://iotserver.com/recordorientation.php'

test_number = 52
temp_threshold = 20
print('Default Temperature Threshold is ' + str(temp_threshold))
print('Use Up and Down button to change the threshold.\nUse Middle Button to Get Status')
payload_test = {'num' : str(test_number)}
base_time = time.time()
time_interval = 0.5

while True:
    curr_time = time.time()
    if (curr_time - base_time > time_interval):
        
        # Record Timestamp, Temperature, Humidity in CSV
        temp_number = s.get_temperature()
        humid_number = s.get_humidity()
        payload_csv = {'temp' : str(temp_number), 'time' : str(curr_time), 'humid' :  str(humid_number)}
        r = requests.get(log_link, params = payload_csv)
        print("Logged Time, Temperature, and Humidity.")
        
        # Record Pitch, Yaw, and Roll in XML
        ori = s.get_orientation()
        pitch = round(ori['pitch'], 2)
        yaw = round(ori['yaw'], 2)
        roll = round(ori['roll'], 2)
        payload_xyzxml = {'pitch' : str(pitch), 'yaw' : str(yaw), 'roll' : str(roll)}
        r = requests.get(recordorientation_link, params = payload_xyzxml)
        print("Logged Pitch, Raw, Roll with Time.")
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
                payload_recordtemp = {'t' : str(temp_number)}
                r = requests.get(temp_link, params = payload_temp)
                r = requests.get(recordtemp_link, params = payload_recordtemp)
                print('Current Status: ' + r.text)
            print('Current Threshold: ' + str(temp_threshold))



