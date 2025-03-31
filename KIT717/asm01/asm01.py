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

# Start location
current_x = 0.0
current_y = 0.0
current_z = 1.0

base_time = time.time() # Set base time
last_time = [base_time, base_time]
flash_interval = 0.3 # Set flash interval for collision state
red = (255,0,0)
red_up = False

test = True
test_int = 2
collision_state = False # Start without collision state
# Check if there is a collision based on xyz
def is_collision(x, y ,z):
    return True if abs(x-current_x) > 0.2 or abs(y-current_y) > 0.2 or abs(z-current_z) > 0.2 else False


while True:
    accele_raw = s.get_accelerometer_raw()
    x = round(accele_raw['x'], 2)
    y = round(accele_raw['y'], 2)
    z = round(accele_raw['z'], 2)
    if test:
        print("X: {}, Y: {}, Z: {}".format(x,y,z))
        test = False
    if is_collision(x,y,z):
        collision_state = True
        # Report Immediately
        
    # Record current location
    current_x = x
    current_y = y
    current_z = z
    curr_time = time.time()
    if (curr_time - last_time[0] > test_int):
        print("X: {}, Y: {}, Z: {}".format(x,y,z))
        last_time[0] = time.time()
    if collision_state:
        if (curr_time - last_time[1] > flash_interval):
            if not red_up:
                s.clear(red)
                red_up = True
            else:
                s.clear()
                red_up = False
            last_time[1] = time.time()
        
    
#             # Record Timestamp, Temperature, Humidity in CSV
#             temp_number = s.get_temperature()
#             humid_number = s.get_humidity()
#             payload_csv = {'temp' : str(temp_number), 'time' : str(curr_time), 'humid' :  str(humid_number)}
#             r = requests.get(log_link, params = payload_csv)
#             print("Logged Time, Temperature, and Humidity.")
#             
#             # Record Pitch, Yaw, and Roll in XML
#             ori = s.get_orientation()
#             pitch = round(ori['pitch'], 2)
#             yaw = round(ori['yaw'], 2)
#             roll = round(ori['roll'], 2)
#             payload_xyzxml = {'pitch' : str(pitch), 'yaw' : str(yaw), 'roll' : str(roll)}
#             r = requests.get(recordorientation_link, params = payload_xyzxml)
#             print("Logged Pitch, Raw, Roll with Time.")
#             base_time = time.time()
#         
    for event in s.stick.get_events():
        
        # Button Press, Set Threshold, 
        if event.action == "pressed":
#             if event.direction == "up":
#                 temp_threshold += 1
#             if event.direction == "down":
#                 temp_threshold -= 1
            if event.direction == "middle":
                collision_state = False
                s.clear()
#                 temp_number = s.get_temperature()
#                 payload_temp = {'temp' : str(temp_number), 'threshold' : str(temp_threshold)}
#                 payload_recordtemp = {'t' : str(temp_number)}
#                 r1 = requests.get(temp_link, params = payload_temp)
#                 r2 = requests.get(recordtemp_link, params = payload_recordtemp)
#                 print('Current Status: ' + r1.text)
#             print('Current Threshold: ' + str(temp_threshold))

