# Messaging
- Messages means data carried between IoT devices
- They are not codes, not executable
- They can represent states or conditions
- They are for all levels of IoT communication
	- Things to middleware
	- Middleware to cloud
	- Cloud to user output
	- Cloud back to things
Messages are loaded in **Carrier Languages** (CL):
- Identity of devices
- Sensor / Actuator data
	- Sensing input
	- Decision
- Metadata
	- Time
	- Geo location
	- App details
A practical CL is
- Small
- Descriptive
- Mappable
# Storage
## On-Device
- Short-term (Pre-packing) or Long-term (Logging)
- Cost Power
## Middleware
- The devices are all about communication
	- Communication Settings
	- Routing Information
	- Device's identities
- Storage is volatile, data will be quickly deleted once forwarded.
## Cloud Server
- Databases
	- Relational
	- Non-relational
- Across multiple instances
- Need security implementations
	- Encryptions
	- Logging
	- Vulnerability Assessment
# Text-based Communication
Common Data Structure:
- CSV
	- Minimal Structure
	- Less Metadata
	- Easy for Devices
	- Hard for Humans
- XML
	- Highly Structured
	- Lots of Metadata
	- Easy for Devices, but needs more storage
	- Easy for Humans
- JSON
	- Some Structure
	- Mid Metadata
	- Mid File Size
	- Easy for Devices
	- Easy for Humans
# Applications and Data
## Application Logic
- Archived by a program tells the IoT device what to do
- Or it accepts inputs from device to decide what to do
	- Authentication: send username, password...
	- Send Records and Control outputs: temp
	- Receive Records and Settings: fan speed
## IoT Data Generation 