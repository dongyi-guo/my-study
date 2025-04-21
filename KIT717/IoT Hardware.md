What is in the "Thing" (End Node)?
- Inputs - Sensing Components
- Outputs - Actuators
- Processing
- Power Supplies (Bat, Solar, Charging, Conversion...)
- Communication
- Storage
- Passive Components
# Design Criteria
- What to monitor?
- How often - frequency
- How much detail - resolution
- How noisy - filter analysis
- How accurate
- What's the cost?
For example, for electronic sensors:
- Sensor packaging
	- Raw
	- Breakout
- PCB placement requirements
- Passive components
- Antenna requirements
## Choosing a Processor
- Sensor Compatibility
	- I/O
	- Analog / Digital? ADC resolution
	- Protocols
- Processing Capability
	- Architecture / Cores
	- Speed
- Power consumption
- RAM and Storage
- Software support / Libraries
## Pins and Packages
- Pins are how processor interfaces with peripherals.
- Capable of
	- GPIO - General Purpose Input / Output
	- Protocol Specific Serial TX/RX, SPI clock / select
	- ADC (Analog Input)
	- PWM / DAC (Analog Output)
## Communication
- Distance
- Protocol
- Environment
- Wired/Wireless
- Footprint
### Wireless
#### LAN
- 802.11
- BLTH
- Zigbee / ZwaveThread / Matter
- NFC / RFID
- RF
#### WAN
- LoRaWAN
- Cellular and MTM
- SigFox
- 6LoWPAN
## Storage
- Code Footprint?
- Logging or Packaging?
- Flash Mem?
- Removable?
- Data Frequency
- Amount of data onboard
## Actuation
- What to change?
- What mechanical requirements?
- Consequences?
- Ensure signal integrity
- How to monitor changes?
- How to mitigate risk and damages?
- Power consumption:
	- How to minimise?
	- How to employ the power?
## Prioritisation
- Accuracy ++
	- Frequency
	- Resolution
	- Direction
- Cost -+
- Size -+
- Power -+
	- Source (Consumption)
	- Charging
# Sensor Characteristics
**Accurate v.s. Precise**
- Accuracy means measurements are close to the accepted value.
- Precision means measurements being consistent across readings.
You can use Validation to enforce these.
## Resolution
- Refers to the smallest change in measure that the device can register
- Higher gives more information, but requires more storage
- It has NOTHING to do with accuracy!
- Depends on the scope you are interested
## Sensor Types Versus

| Analog                    | Digital                    |
| ------------------------- | -------------------------- |
| Raw Voltage               | Discrete Voltage Levels    |
| Very Fast                 | Slower but not significant |
| Noisy                     | Less Noise                 |
| Cheaper                   | More Expensive             |
| Requires ADC Conversation | No Conversation Required   |
| Not Addressed             | Addressable                |

| Scalar                                                 | Vector                                                                            |
| ------------------------------------------------------ | --------------------------------------------------------------------------------- |
| Measures only the magnitude of quality being measured. | Whatever before + direction of change.                                            |
| Data is a single value: Lux on Lights.                 | Data is represented as an array of values: Magnetic Force = strength + direction. |
# Sensing Errors
- Environmental Noise
- Device Error / Noise
- Transmission Noise
- Storage Noise
## Sources of Errors
- Noisy Environments
- Contributes to inaccuracy
- Contributes to poor quality data
- False Triggering of automation
## CANBUS in car
- Signals are time-sensitive
- Noise Source:
	- Vibration
	- EMF
	- Engine Combustion / Electric Motor
	- Alternator / Magnets
	- External Objects
- CANBUS is made for all considerations above
	- Common noise rejection
	- Heavy use of inductors and filtering
## Sensitivity Error
- Happens when slope deviates from the ideal response of the sensor.
- Sensor components may be sensitive to more external stimuli than what you are trying to measure.
- Can be influenced by other variables.
- Subject to change over time.
## Offset Error
 - A consistant diff
 - May not be linear, but always consistent
 - Can use h/w and s/w to correct
 - Can be unavoidable
## Hysteresis Error
- State of sensor may influence its output
- Sensor's state change can take time
- Also known as "response time"
- Example: Temperature cannot instant reflect temperature changes.
## Quantisation Error
- Data collecting frequency is too low, the resolution of data does not map smoothly as real-world changes.
- Can be always caused by Digital Conversion
- CD v.s. Vinyl
# Sensing Strategies
## Polling
- Constantly checking if there is a change.
- Occurs at regular intervals
- Less accurate
- More processor intensive
- Can miss
- Can just use GPIO
## Interrupts
- Hardware level mechanism to issue notifications
- Can happen anytime
- Very accurate
- Less CPU overhead
- Has to use specialised pins
