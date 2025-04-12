**Firmware**: Provides low-level access to the hardware.
**Software**: Provides functions user desired.
**Bootloader**: Responsible for initialising the processor and peripherals
- Allow new code to be transferred and run
Real-time OS
- For time-sensitive tasks, provide reliable response to particular conditions
- Under limited resources
- FreeRTOS, Mbed, Zephyr
# IoT Device Class

| Class | RAM              | Flash            |
| ----- | ---------------- | ---------------- |
| C0    | Less than 10 KiB | Less than 100KiB |
| C1    | Around 10 KiB    | Around 100 KiB   |
| C2    | Around 50 KiB    | Around 250 KiB   |
# General Logic
Languages:
- Machine Code
- Assembly
- C / C++
- Python / Micropython
Logic:
- Setup
	- Setup and initialise
	- Turn on actuator
	- Maintain time-based actuation
- Loop
	- Same
	- Same
	- Get sensor input
	- Actuate based on time and sensor input
	- Notify
## Sensor S/W Phases
### Setup
- Allocate memory, and initialise:
	- Variables
	- Hardware
	- Communication
- Happens once
- Can block any other progress
- Before loop phase
#### Pin Modes
- Different pins have different functionality
	- Digital / Analog I/O
	- Special Protocol: SPI, I2C, PWM
	- Interrupts
- Needs declaration before usage
- Bad set-up on pin mode will damage hardware.
## Loop
- Execute programs
	- Read from sensor
	- Process readings
	- Package data for communication
	- Engage actuators
	- Make auto decisions
- Work till turned off
- Can block
- After setup
# Interrupts v.s. Polling
Polling is you regular checking, interrupts are you being notified.
## Interrupt Service Routines (ISR)
- This allows us to interrupt a program for time-critical tasks
- Useful for events unscheduled
- Need to handle
- Have a priority
- Limited on pins
- When used, enter a certain mode
- Don't block time management
- Don't use slow connection methods.
## Polling
- Waiting for input
- You can miss event if it goes quickly
- Can be CPU-intensive if you are polling frequently
- Can be worse if blocking time management
# Time Management
## Blocking
- Halt the whole process
- `time.sleep(1000)`
## Non-Blocking
- Does not halt the program
- `time.time()`
- But cannot be exact on times
## Time Synchronisation
- For logging local event and communication time
- Especially if decisions are made locally
- Use RTC, NTP, or GPS
# State Management
- Use states to describe modes.
- In diff states, behaviours for a program will vary
- Carefully craft conditions
- Change via triggers:
	- Time trigger
	- Event trigger
	- State trigger