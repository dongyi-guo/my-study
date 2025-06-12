**Ubiquitous Computing**: From Mark Weiser's notion of every device being connected and computers surrounding us.
**Internet of Things (IoT)**: Created in 1999, used to describle RFID chips in devices during production chain.
Definition:
- A network of addressable, connected objects that
	- exchange data
	- serve a defined purpose of:
		- aiding to accomplish tasks
		- improve decision making
	- DO NOT have a general usage (multi-purpose)
	- interact with real-world (has physical form)
Use cases:
- Smart Farms
- Smart Cities
- Smart Homes
Why IoT (Purpose):
- Identification.
- Sensing - detect changes.
- Processing - compute based on sensed data.
- Control - cause changes in the real world.
- Micro and Nano Technology
IoT devices need to collect Good Quality data, and transmit that data.

IoT are more than things:
- Needs Server
- Needs Communication Protocol
- Needs Application
- Needs UI
# IoT Conceptual Models
## 3 layers
1. Perception Layer (Sensors)
2. Network Layer (Routers, Access points)
3. Application Layer (Programs)
## 5 layers
1. Perception Layer (Acquiring Data
2. Transport Layer (Packaging Data)
3. Processing Layer (Analysing Data)
4. Application Layer (Transforming Data)
5. Business Layer (Managing IoT systems)
## 4 layers
- Sensing Layer (Sensing Devices)
- Network Layer (Network Devices and Gateways)
- Services Layer (Servers and Applications)
- Interface Layer (UI and apps to relay data)
# IoT Architecture
Sensor - Raw Data -> Middleware - Metadata and data, structured -> Cloud - Formatted data, Visuals, Patterns, Auth -> Report
# Edge Devices

## Transducers
- Convert one form of energy to another.
- Two classes
	- **Sensor**: Convert real-world quantities to electrical signals.
		- Measure real-world variable
		- Exploit chemical and physical property
		- Reflects on changes of voltage and characteristics to external stimuli
		- PIR Sensor uses heat absorption 
		- Moisture Sensor uses conduction
		- Other variables:
			- Motion
			- Position
			- Environment
			- Mass
			- Biosensors
		- **Analog Sensors**: Fast, cheap, but noisy, need more filtering
		- **Digital Sensors**: Fast, less noisy, need less filtering, reliable, but costly
		- Deployed in **Networks**, while considering
			- Sensor Identification
			- Protocol for Data Exchange
			- Latency
			- Topology / Distribution
			- Churn Rate / Lifecylce
			- Processing Requirements
			- Distribution
	- **Actuators**: Convert electrical signals to real-world changes.
		- Electro-mechanical devices, receive electrical signals and consumes energy (battery).
		- Common Types:
			- Motors
			- Servos
			- Solenoids
			- Pumps
			- Speakers
			- Pneumatics
			- Hydraulics
			- Irrigation
			- Lights
		- Actuator can have **Controls**
# IoT Applications
Why - To transfer unorganised data to organised patterns to help on decision making.
## Factors to Consider
- What Sensors / Actuators
	- What to measure / control
	- How to get data
	- Cost
	- Longevity
	- Scope
	- Environment
- Placement / Deployment
	- Topology
	- Power Consumption / Longevity
	- Density
	- Bandwidth
	- Access
	- Maintenance
	- Privacy
- Data Acquisition
	- Format
	- Quality
	- Frequency
	- Integrity
	- Privacy
- Data Analytics
	- Filtering
	- Modelling Data
	- Machine Learning / AI
	- Data Storage - Archive, Security, Compliance
- Feedback / Response
	- User Presentation
		- UI
		- Dashboards
		- Physical Interfaces
	- Outcome Presentation - Reports, Alarms
	- Safety / Overrides
## Example
- Passive Observer
	- Observe to collect data, then analyse
	- ML progress on the cloud, decision made by people
	- IoT devices have limited roles
	- Low costs
- Passive with Control
	- Same above for data
	- ML used in real-time, decisions are made by people but with AI's input, also actuated by the system.
	- Directly change environments with IoT devices 
	- IoT devices play normal or slightly increased roles.
	- Medium costs
- Active Control
	- Same for data
	- Same for ML, but decisions are made by AI
	- Actuators are not completely controlled by applicaion
	- Roles are similar
	- High costs
# Implications
- Increase wastes
- Resource friendly
## Device Lifecycle
- Design
- Deploy
- Manage
- Decommission
  