import time

ENV_DIFF_THRESHOLD = 0.01
DIFF_THRESHOLD = 1.0
TOTAL_INDEX = 5
TOTAL_THRESHOLD = 50.0
PROTECT_ROUND = 4

protect_index = 0
index_good: int = 0
index_bad: int = 0
good_count: int = 0
bad_count: int = 0
good_values = [0] * TOTAL_INDEX
bad_values = [0] * TOTAL_INDEX
good_total = 0.0
bad_total = 0.0

# dx / dy
dx = -1 # val diff
dy = 5 # time diff: 5 min

# Initialised Reading
# Assure readings cannot be negative, use -1
old_good = -1
new_good = -1
old_bad = -1
new_good = -1

good_array = [18.93, 18.87, 18.81, 18.81, 18.81, 18.75, 18.68, 18.68, 18.68, 18.62, 18.56, 18.56, 18.56, 18.56, 18.56, 18.5, 18.5, 18.5, 18.5, 18.5, 18.43, 18.43, 18.43, 18.43, 18.5, 18.5, 18.5, 18.56, 18.56, 18.56, 18.56, 18.56, 18.62, 18.62, 18.62, 18.62, 18.56, 18.56, 18.62, 18.62, 18.62, 18.62, 18.62, 18.62, 18.68, 18.68, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.87, 18.87, 18.87, 18.81, 18.87, 18.87, 18.87, 18.93, 18.93, 18.93, 18.93, 18.93, 18.93, 18.93, 19, 19, 19, 19, 19, 19, 19, 19, 18.87, 18.87, 18.81, 18.81, 18.81, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75]
bad_array = [18.93, 18.87, 18.81, 18.81, 18.81, 18.75, 18.68, 18.68, 18.68, 18.62, 18.56, 18.56, 18.56, 18.56, 18.56, 0, 0, 0, 0, 18.5, 18.43, 18.43, 18.43, 18.43, 18.5, 18.5, 18.5, 18.56, 18.56, 18.56, 18.56, 18.56, 18.62, 18.62, 18.62, 18.62, 18.56, 18.56, 18.62, 18.62, 18.62, 18.62, 18.62, 18.62, 18.68, 18.68, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.81, 18.87, 18.87, 18.87, 18.81, 18.87, 18.87, 18.87, 18.93, 18.93, 18.93, 18.93, 18.93, 18.93, 18.93, 19, 19, 19, 19, 19, 19, 19, 0, 18.87, 18.87, 18.81, 18.81, 18.81, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75, 18.75]

def get_good_data():
    global index_good
    if index_good >= 99:
       index_good = 0
       return good_array[0]
    else:
        index_good += 1
        return good_array[index_good - 1]
    
def get_bad_data():
    global index_bad
    if index_bad >= 99:
       index_bad = 0
       return bad_array[0]
    else:
        index_bad += 1
        return bad_array[index_bad - 1]
    
while True:
    good_reading = get_good_data()
    bad_reading = get_bad_data()
    
    # Detect totals for good readings
    if good_count < TOTAL_INDEX:
        good_values[good_count] = good_reading
        good_count +=1
    else:
        good_values[0] = good_reading
        good_count = 1 # You added this value
    
    good_total = sum(good_values)
    
    if good_count == TOTAL_INDEX:
        print("-> Good Total: " + str(good_total))
        
    if protect_index > PROTECT_ROUND and good_total < TOTAL_THRESHOLD:
        print("--TOTAL ERROR on good readings: {} for {} values--".format(good_total, TOTAL_INDEX))
        
    # Detect totals for bad readings
    if bad_count < TOTAL_INDEX:
        bad_values[bad_count] = bad_reading
        bad_count +=1
    else:
        bad_values[0] = bad_reading
        bad_count = 1 # You added this value
    
    bad_total = sum(bad_values)
        
    if bad_count == TOTAL_INDEX:
        print("-> Bad Total: " + str(bad_total))
        
    if protect_index > PROTECT_ROUND and bad_total < TOTAL_THRESHOLD:
        print("--TOTAL ERROR on bad readings: {} for {} values--".format(bad_total, TOTAL_INDEX))
        
    # Reset the total values
    good_total = 0
    bad_total = 0
    
    # Detect dx/dy for good readings
    if old_good == -1:
        old_good = good_reading
    else:
        new_good = good_reading
        dx = new_good - old_good
        drv = dx / dy
        if drv > DIFF_THRESHOLD:
            print("--ERROR on good readings: Huge diff: {}--".format(drv))
        elif drv > ENV_DIFF_THRESHOLD:
            print("--Warning on good readings: Environment diff: {}--".format(drv))
        old_good = new_good
        
    # Detect dx/dy for bad readings
    if old_bad == -1:
        old_bad = bad_reading
    else:
        new_bad = bad_reading
        dx = new_bad - old_bad
        drv = dx / dy
        if drv > DIFF_THRESHOLD:
            print("--ERROR on bad readings: Huge diff: {}--".format(drv))
        elif drv > ENV_DIFF_THRESHOLD:
            print("--Warning on bad readings: Environment diff: {}--".format(drv))
        old_bad = new_bad
        
    # Print Results
    print(">>>>>>")
    print("Good reading: {}".format(good_reading))
    print("Bad reading: {}".format(bad_reading))
    print("<<<<<<")
    if protect_index <= PROTECT_ROUND:
        protect_index += 1
    time.sleep(1)

