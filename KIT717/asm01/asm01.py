import requests, time, math
from sense_emu import SenseHat

s = SenseHat() # EMU
BLINK_INTERVAL = 0.3 # LED blinking interval
REPORT_INTERVAL = 60 # Regular report interval
RED = (255,0,0) # Color red
WHITE = (255,255,255) # Color white

COLLISION_STATUS = False # Default no collision
RED_LIGHT_ON = False
BROWNOUT = False
SURGE = False
SETUP = False
LIGHT_LVL_THRESHOLD = -1

# Set start xyz
last_x = 0.0
last_y = 0.0
last_z = 1.0

# Get movement distance
def get_distance(x, y ,z):
    x_dist = x - last_x
    y_dist = y - last_y
    z_dist = z - last_z
    return math.sqrt(x_dist**2 + y_dist**2 + z_dist**2)

last_blink_time = 0
last_report_time = 0

stub1_link = 'http://iotserver.com/stub1.php'
temp_link = 'http://iotserver.com/temperature.php'
log_link = 'http://iotserver.com/logger.php'
recordtemp_link = 'http://iotserver.com/recordtemp.php'
recordorientation_link = 'http://iotserver.com/recordorientation.php'

test_number = 52
temp_threshold = 20
print('Default Temperature Threshold is ' + str(temp_threshold))
print('Use Up and Down button to change the threshold.\nUse Middle Button to Get Status')
payload_test = {'num' : str(test_number)}

# The Main Loop
while True:
    
    # Get current location (xyz)
    accele_raw = s.get_accelerometer_raw()
    x = round(accele_raw['x'], 2)
    y = round(accele_raw['y'], 2)
    z = round(accele_raw['z'], 2)
    
    if 0.2 < get_distance(x,y,z):
        COLLISION_STATUS = True
        
    # Update last location
    last_x = x
    last_y = y
    last_z = z
    
    # Light Level
    light_lvl = s.get_humidity()
    if LIGHT_LVL_THRESHOLD < light_lvl:
        s.clear(WHITE)
    else:
        s.clear()
    
    # Power Level
    power_lvl = s.get_temperature()
    if 0 > power_lvl:
        BROWNOUT = True
        SURGE = False
        s.clear()
    else if 100 < power_lvl:
        SURGE = True
        BROWNOUT = False
        s.clear()
    else:
        BROWNOUT = False
        SURGE = False
        
    # Get current time
    curr_time = time.time()
    
    # Collision state blinking
    if collision_state:
        if curr_time - last_blink_time > BLINK_INTERVAL:
            if RED_LIGHT_ON:
                s.clear()
                RED_LIGHT_ON = False
            else:
                s.clear(RED)
                RED_LIGHT_ON = True
            last_blink_time = time.time()
    
    # Timed Report
    if curr_time - last_report_time > REPORT_INTERVAL:
        payload_report = {'ts' : str(curr_time),
                        'll' : str(light_lvl),
                        'pl' : str(power_lvl),
                        'cs' : str(COLLISION_STATUS)
                        }
        try:
            r = requests.get(stub1_link, params = payload_report)
            if 200 != r.status_code:
                print(f"Error while Connecting to the Server: {r.status_code}")
            else:
                print("Report to the Server Successfully!")
        except requests.exceptions.ConnectionError:
            print("Server Offline")
        except requests.exceptions.Timeout:
            print("Request timed out")
        except requests.exceptions.RequestException as e:
            print(f"Unexpected error: {e}")
        last_report_time = time.time()
    
    # Button Actions
    for event in s.stick.get_events():
        if event.action == "pressed":
            if event.direction == "up":
                temp_threshold += 1
            if event.direction == "down":
                temp_threshold -= 1
            if event.direction == "middle":
                if True == COLLISION_STATUS:
                    COLLISION_STATUS = False
                    s.clear()
                else:
                    SETUP = True
                    print("Entering Set-up Mode...")
                    print("Use Up and Down to adjust Light Level")
