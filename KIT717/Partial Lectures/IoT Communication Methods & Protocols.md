IoT applications are mainly 3 types:
- Monitor and actuate
- Business process or data analysis
- Information gathering and collaborative consumption
IoT Architecture:
- Interface Layer
- Service Layer
- Network Layer
- Sensing Layer
Service Oriented Architecture: Used to build apps allowing for common interfacing between different services.
- Appropriate level of abstraction
- Standard service contracts
- Interoperability and scalability
- Use protocols like XML
**Application Programming Interface (API)**
- Implement SOA by exposing components so other services can interact with it.
- Needs to have interface for app/service to communicate
- Specifies the way in which services will communicate
	- What is requested
	- What is returned
- Use simpler objects like JSON to transfer data
- REST - Representational State Transfer
	- Each request is independent and must contain all information required to complete the request
# IoT Communication Methods
## Protocol Across Layers
- Application: CoAP, HTTP, Zigbee
- Transport: UDP, TCP, Zigbee
- Network: IPv6, Zigbee
- Physical and Link: NFC, WIFI, BLTH
## Network Topology
### Star
- Nodes are connected to gateway or router
- Nodes are not connected to each other
- Router passes messages between networks
### Mesh
- Nodes are connected to each other directly
- Distance can be way greater
- Higher redundancy - one node failing won't stop the network
- More complex to setup and manage
- Higher costs
- Higher latency
- Can be bottlenecked by one node
## Network Types
- WiFi
	- Wireless (802.11b,g,n,WiFi5,6,7)
	- Local area, low range (~50m)
	- High Bandwidth (up to 5Gbps)
	- Ubiquitous
	- Star Network
	- High power consumption
	- Crowded spectrum
	- Requires an Access Point
- Zigbee
	- Wireless (802.15.4)
	- Local area, low range (10-100m)
	- Low Bandwidth (Up to 30Kb/s)
	- Mesh network
	- Low power consumption
	- Requires a gateway
	- 2.4Ghz, crowded spectrum
- LoRaWAN
	- Long Range radio
	- Wide area, long range (up to 20Km)
	- Low Bandwidth (Up to 5Kb/s)
	- Star network*
	- Low power consumption
	- Higher latency than Zigbee
	- Requires a gateway
	- Sub Ghz radio frequency
- Cellular
	- Wide area, long range (up to 150Km)
	- High Bandwidth (Up to 5Gb/s)
	- Star network
	- Higher power consumption
	- Higher data costs
	- Expensive to deploy (relying on cellular companies)
		- Dead spots
	- Shared bandwidth
	- Device needs a modem
- Satellite
	- Accessible pretty much anywhere outdoors.
	- Can be very high bandwidth*
	- Very resilient data transfer
	- Very high power consumption
	- Device requires a satellite
	- transponder
	- Huge data costs
		- 1Mb of data/month >$50USD...
# Sensor Deployment
Objectives:
- Energy efficiency / improved lifetime
- Target detection
- Load balancing
Factors affecting strategies:
- Type of application
- Uniformity of nodes (single or multi)
- Type of communication
- Uniformity of region of interest (ROI)
- Density of nodes in ROI
## Deployment Strategy
### Random Deployment Strategy
- Realistically this is much preferred
- Cannot ensure balanced behaviour of nodes - energy consumption or connectivity and transmissions
- Problems encountered are coverage holes
- Clustering or hierarchical topology can help
### Deterministic Deployment Strategy
- Fixed and deterministic deployment are uniformed to ensure simple topology maintenance
- Full coverage power conservation and effective connectivity by using static sensors
- Maintaining a completely geometrically determined topology is diﬃcult owing to network disconnections due to node failures, node mobility, irregular terrains or other real-world conditions
### Identity Authentication Management (IAM)
- Identifying objects and setting their access level
- EPC or URI
# Servers, Cloud, and Fog
## Servers
- Collecting, storing, and analysing data from end nodes
- Managing end nodes
- Aggregate data from nodes
- Analyse data and generate information
- Facilitate communication between users and actuators
## Cloud Computing
- On-demand
- Pay-as-you-go
- But latency
## Fog Computing
- Extension of cloud computing, still having the feature of networking, computation, virtualisation and storage.
- Meets requirements of applications that demand low latency, specific QoS requirements, Service Level Agreement (SLA) considerations, or any combo.
### Cloud v.s. Fog

| Feature               | Fog           | Cloud                 |
| --------------------- | ------------- | --------------------- |
| Response Time         | Low           | High                  |
| Availability          | Low           | High                  |
| Security              | Mid to High   | Low to Mid            |
| Service Focus         | Edge          | Core                  |
| Cost per Device       | Low           | High                  |
| Dominant Architecture | Distributed   | Central / Distributed |
| Main Customer         | Smart Devices | Humans                |
Often, they work together
- Cloud Computing as centralised, having apps, hosts, core networks
- Fog computing has access points, LANs, attaching to the Cloud Computing part
- End devices attached to the Fog.
	- Also known as Edge Computing