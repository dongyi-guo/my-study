# IRP

Incident: any malicious or suspicious event that could result in loss of CIA for an information assets.

Incident Response: detect, react to, recover from attacks, employee errors, service outages and small-scale of natural disasters. The plan ot be engaged after an incident has been detected, is called Incident Response Plan (IRP). The event represents possible loss is called Adverse Event(s), the manifestation of an Adverse Event is an Incident.

When a threat becomes a valid adverse event, it is classified as an
Information security incident if:
* It is directed against information assets.
* It has a realistic chance of success.
* It threatens the confidentiality, integrity, or availability of information resources and assets.

It is important to understand that IR is a reactive measure, not a preventive one, although most IR plans include preventive recommendations.

## IRP Process

### Preparation

1. Compile list of IT assets.
2. Prepare the team, centralised Incident Response Teams.
    * Roles: 
        * Team Lead: In charge of team activities, reviews and coordinates the team's actions, and make changes to policy and procedures.
        * Incident Lead: Owns an incident, coordinates comm for this incident, represents the CIRT and may change.
        * Incident Handler: Do the actual work.
        * Associate Member: From various departments throughout the company, specialised in areas incident may damage and delegates the area. 
    * Train to use good tools.
    * Assemble all relevant comm info.
    * Keep emergency info in central offline storage.

### Detection and Analysis

Detection: discovery of events with security tools or notification (whether internal or external) of a suspected incident.

Analysis: involves identifying a baseline or normal activity for the affect systems, correlating related events and seeing if and how they deviate from normal behaviour.

#### Items to take care:

* Attack Vectors
* Signs of incident
* Source of Precursors and Indicators
    * Alerts
    * Logs
    * Publicly available information
    * People

#### Analysis

##### What to analyse:

* Profile Networks and Systems
* Understand Normal Behaviors
* Create a Log Retention Policy
* Perform Event Correlation
* Keep All Host Clocks Synchronized
* Maintain and Use a Knowledge Base of Information
* Use Internet Search Engines for Research

##### Jobs

* Documentation
* Prioritisation
    * Functional Impact of the Incident
    * Information Impact of the Incident
    * Recoverability from the Incident

### Containment, Eradication and Recovery

* Choosing a Containment Strategy
* Evidence Gathering and Handling
* Identifying the Attacking Hosts
    * Validating the Attacking Host’s IP Address
    * Researching the Attacking Host
    * Using Incident Databases
    * Monitoring Possible Attacker Communication Channels

* Phased and prioritized
* Eliminate components of the incident
* Identifying and mitigating all vulnerabilities
* Restore systems to normal operation
* Confirm that the systems are functioning normally
* Remediate vulnerabilities to prevent similar incidents

### Post-incident Activity

* Lessons learned
* Using collected incident data
* Number of incidents handled
* Time per incident
* Objective & subjective assessment
* Evidence Retention:
    * Prosecution
    * Data Retention
    * Cost
