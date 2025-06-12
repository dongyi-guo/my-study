# IoT Structure: Cloud, Fog, Edge
- Data aggregated in data centres (Cloud)
- Services running on middleware (Fog)
- Processing happening on end nodes (Edge)
## Cloud Computing
- Data aggregated from end nodes
- Powerful processing capability and scalability
- Public clouds are pay-as-you-go
- High latency
- Massive power consumption, maintenance requirements
## Fog Computing
- Data aggregated across a distributed network of middleware devices (gateways and routers)
- Needs more power than end node
- You need to have some your own hardware
- Less latency
- Best for authentication
## Edge Computing
- Standalone or P2P client
- Data and codes are local
- No latency
- Recording and processing very quickly
- Small scale only
- Low power consumption
- Maintenance requirements can be difficult
- Rolling updates can be risky
## Web Servers
### Client Pull
- Client initiates the connection with information requests
- Server provides information and closes the connection.
- Connections are not persistent
- Has latency
- Cannot reflect rapid changes
### Server Push
- Connection established by the server
- Connection persists
- Whenever there is a change, server pushes it to the client
- Much less latency and allow real-time updates
- But more resource intensive
- Harder to scale
- Need maintenance
# IoT Programming Languages
## Embedded Laugauges 