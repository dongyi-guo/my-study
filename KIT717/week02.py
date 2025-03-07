print("Tutorial Week 2")

from sense_emu import SenseHat
import time

s=SenseHat()
my_name="Dongyi"
w = (255,255,255)
b = (0,0,0)

def burning_room(temp):
    return temp > 28

def get_polling(s):
    temp = s.get_temperature()
    press = s.get_pressure()
    humid = s.get_humidity()
    print("Current Temperature:", temp)
    print("Current Air Pressure:", press)
    print("Current Humidity:", humid)
    if burning_room(temp):
        print("SO HOT NOW")
    else:
        print("SO COLD NOW")

while True:
    s.set_pixel(0,0,255,0,0) # Red
    s.set_pixel(1,1,255,0,0) # Red
    s.set_pixel(2,2,255,0,0) # Red
    s.set_pixel(3,3,255,0,0) # Red
    s.set_pixel(4,4,255,0,0) # Red
    s.set_pixel(5,5,255,0,0) # Red
    s.set_pixel(6,6,255,0,0) # Red
    s.set_pixel(7,7,255,0,0) # Red
    get_polling(s)
    temp = s.get_temperature()
    time.sleep(1)
    s.set_pixel(0,0,0,255,0) # Green
    s.set_pixel(1,1,0,255,0) # Green
    s.set_pixel(2,2,0,255,0) # Green
    s.set_pixel(3,3,0,255,0) # Green
    s.set_pixel(4,4,0,255,0) # Green
    s.set_pixel(5,5,0,255,0) # Green
    s.set_pixel(6,6,0,255,0) # Green
    s.set_pixel(7,7,0,255,0) # Green
    get_polling(s)
    time.sleep(1)
    
    s.show_message(my_name,
                   scroll_speed=0.1,
                   text_colour=[127,191,255],
                   back_colour=[127,127,127]
                   )
    s.show_message(str(temp),
                   scroll_speed=0.1,
                   text_colour=[255,127,127],
                   back_colour=[127,127,127]
                   )
    
    # Pixel Images
    empty = [
        b,b,b,b,b,b,b,b,
        b,b,b,b,b,b,b,b,
        b,b,b,b,b,b,b,b,
        b,b,b,b,b,b,b,b,
        b,b,b,b,b,b,b,b,
        b,b,b,b,b,b,b,b,
        b,b,b,b,b,b,b,b,
        b,b,b,b,b,b,b,b,
        ]
    cross = [
        w,b,b,b,b,b,b,w,
        b,w,b,b,b,b,w,b,
        b,b,w,b,b,w,b,b,
        b,b,b,w,w,b,b,b,
        b,b,b,w,w,b,b,b,
        b,b,w,b,b,w,b,b,
        b,w,b,b,b,b,w,b,
        w,b,b,b,b,b,b,w,
        ]
    tick = [
        b,b,b,b,b,b,b,w,
        b,b,b,b,b,b,w,b,
        b,b,b,b,b,w,w,b,
        b,b,b,b,b,w,b,b,
        w,b,b,b,w,b,b,b,
        b,w,b,b,w,b,b,b,
        b,b,w,w,b,b,b,b,
        b,b,b,w,b,b,b,b,
        ]
    if burning_room(temp):
        s.set_pixels(tick)
    else:
        s.set_pixels(cross)
    time.sleep(1)
    s.set_pixels(empty)