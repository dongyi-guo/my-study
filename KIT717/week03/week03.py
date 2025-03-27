from sense_emu import SenseHat
import time

s = SenseHat()
# Display Start
s.set_pixel(0,0,255,255,255)

base_time = time.time()
last_time = [base_time,base_time,base_time,base_time]
interval = [1,1.5,1.3,2]
led_status = [False,False,False,False]

current_x = 0
current_y = 0
current_z = 0

class LED():
    def __init__(self,x,y,R,G,B):
        self.x = x
        self.y = y
        self.R = R
        self.G = G
        self.B = B

red = LED(0,0,255,0,0)
green = LED(2,0,0,255,0)
blue = LED(4,0,0,0,255)
orange = LED(6,0,255,255,0)


def is_quick(x, y ,z):
    return True if abs(x-current_x) > 0.1 or abs(y-current_y) > 0.1 or abs(z-current_z) > 0.1 else False
    

while True:
    
    curr_time = time.time()
#     print(round(curr_time * 1000))
#     print(round(last_time * 1000))
    if (curr_time - last_time[0]) > interval[0]:
        if led_status[0] == False:
            s.set_pixel(red.x,red.y,red.R,red.G,red.B)
            led_status[0] = True
        else:
            s.set_pixel(red.x,red.y,0,0,0)
            led_status[0] = False
        last_time[0] = curr_time
        
    if (curr_time - last_time[1]) > interval[1]:
        if led_status[1] == False:
            s.set_pixel(green.x,green.y,green.R,green.G,green.B)
            led_status[1] = True
        else:
            s.set_pixel(green.x,green.y,0,0,0)
            led_status[1] = False
        last_time[1] = curr_time
    
    if (curr_time - last_time[2]) > interval[2]:
        if led_status[2] == False:
            s.set_pixel(blue.x,blue.y,blue.R,blue.G,blue.B)
            led_status[2] = True
        else:
            s.set_pixel(blue.x,blue.y,0,0,0)
            led_status[2] = False
        last_time[2] = curr_time
    
    if (curr_time - last_time[3]) > interval[3]:
        if led_status[3] == False:
            s.set_pixel(orange.x,orange.y,orange.R,orange.G,orange.B)
            led_status[3] = True
        else:
            s.set_pixel(orange.x,orange.y,0,0,0)
            led_status[3] = False
        last_time[3] = curr_time
    
#     print(s.get_compass())
    accele_raw = s.get_accelerometer_raw()
    x = round(accele_raw['x'], 2)
    y = round(accele_raw['y'], 2)
    z = round(accele_raw['z'], 2)
    
#     print("Current XYZ: x={}, y={}, z={})".format(x,y,z))
    if is_quick(x,y,z):
        s.clear(255,0,0) # Turn Red
        time.sleep(0.2)
        s.clear(0,0,0)
        
    current_x = x
    current_y = y
    current_z = z
    
#     for event in s.stick.get_events():
#         print(event.direction, event.action)
#         if event.action == "pressed":
#             if event.direction == "up":
#                 state = 0
#             if event.direction == "middle":
#                 state = 1
#             if event.direction == "down":
#                 state = 2
    
    temp = s.get_temperature()
    humid = s.get_humidity()
    state = -1
    if temp > 30 and humid > 50:
        state = 0
    if temp < 30 and humid > 50:
        state = 1
    if temp < 30 and humid < 50:
        state = 2
        
    if state == 0:
        s.set_pixel(2,2,255,0,0)
        s.set_pixel(2,3,0,0,0)
        s.set_pixel(2,4,0,0,0)
    if state == 1:
        s.set_pixel(2,2,0,0,0)
        s.set_pixel(2,3,0,255,0)
        s.set_pixel(2,4,0,0,0)
    if state == 2:
        s.set_pixel(2,2,0,0,0)
        s.set_pixel(2,3,0,0,0)
        s.set_pixel(2,4,0,0,255)
