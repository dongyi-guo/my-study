from sense_emu import SenseHat
import time, requests

s = SenseHat()
sma = []
window = 5
total = average = 0
temp_link = "http://iotserver.com/recordtemp.php"

while True:
    temp = s.get_temperature()
    sma.append(temp)
    if len(sma) > window:
        del sma[0]
    for i in sma:
        total += i
    average = total / len(sma)
    total = 0
    print("Current temperature: {}".format(temp))
    print("Average temperature: {}".format(average))
    payload = {'ct': str(temp), 'at': str(average)}
    try:
        r = requests.get(temp_link, params = payload)
        if r.status_code == 200:
            print("Report current and average temperatures to the server successfully.")
        else:
            print("Error sending requests")
    except:
        print("Error connecting to the server")
    time.sleep(1)
