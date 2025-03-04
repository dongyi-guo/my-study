# Business Contingency

> The lecture this week is very important, it has lots of diagrams. Go back for details.

## Disaster

* Any event resulting damages, destruction, loss of life or drastic change to the environment
* Disruption of normal business functions where the expected time for returning to normalcy would seriously impact the organisation's capability to maintain operations, including customer commitments and regulatory compliance.
* The causes can be:
    * Environmental
    * Operational
    * Accidental
    * Willful

## Business Contingency Terminology

* Recovery Point Objective - RPO
* Recovery Time Objective - RTO
* Maximum Tolerable Downtime - MTD
* Work Recovery Time - WRT

Recovery Point Objective (RPO) = Disaster - Last Back-up

RRecovery Time Objective (RTO) = Basic Functionality - ICT Interfere 

Maximum Tolerable Downtime (MTD) = Full Functionality - Disaster

Work Recovery Time (WRT) = Full Functionality - Basic Functionality

Actual Down Time = Reaction Time + Recovery Time (RTO)

Actual Down Time <= Maximum Tolerable Downtime (MTD)

Recovery Time (RTO) <= Maximum Tolerable Downtime (MTD)

Work Recovery Time (WRT) = Maximum Tolerable Downtime (MTD) - Actual Down Time

## Disaster Recovery

### Disaster Recovery Planning (DRP)

* It entails preparation for and recovery from a disaster, whether natural or human-made.
* In general, an incident is a disaster when:
    * The organization is unable to contain or control the impact of an incident, or
    * The level of damage or destruction from an incident is so severe that the organization is unable to quickly recover.
* The key role of a DR plan is defining how to reestablish operations at the location where the organization is usually located (primary site).

### Disaster Recovery Planning Team (DRPT)

* The DRPT in turn organizes and prepares the DR response teams (DRRTs) to actually implement the DR plan in the event of a disaster.
* These teams may have multiple responsibilities in the recovery of the primary site and the reestablishment of operations:
    * Recover information assets.
    * Purchase or otherwise acquire replacement information assets.
    * Reestablish functional information assets at the primary site if possible or at a new primary site, if necessary.

### Disaster Recovery Plans

* Addresses what should be done immediately following a significant incident.
    * Defines who has the authority to declare a disaster.
    * Defines who has the authority to contact external entities.
    * Defines evacuation procedures.
    * Defines emergency communication & notification procedures.
* Upon declaration of a disaster, all DR planning team members should report to a designated command and control center.
* Occupant Emergency Plan (OEP).
    * Describes evacuation and shelter-in-place procedures in the event of a threat or incident to the health and safety of personnel.

## Business Continuity

Why? Because partial or all business activities will be disrupted.

### BC Planning (BCP)

* Ensures critical business functions can continue even in a disaster.
* Managed by the CEO or COO.
* Activated and executed concurrently with DRP.
* BCP re-establishes critical functions at an alternate site, DRP focuses on re-establishment at the primary site.

#### NIST Methodology

1. Form the BC team.
2. Develop the BC planning policy statement.
3. Review the BIA (Business Impact Analysis)
4. Identify preventive controls.
5. Create relocation strategies.
6. Develop the BC plan.
7. Ensure BC plan testing, training, and exercises.
8. Ensure BC plan maintenance.

#### Strategies

Several possible strategies for business continuity, but the determining factor is usually cost.

Exclusive-use options:
* Hot sites
    * Fully operational location with redundant equipment.
    * Data streamed to the site on a real-time basis or close to real-time.
* Warm sites
    * Partially equipped with information systems and telecommunication equipment to support relocated operations.
    * Spare computers there must be configured in the event of a disaster.
    * Restore the data.
* Cold sites
    * Available alternative location.
    * Provide only rudimentary services, with not computer hardware or peripherals.

Shared-use options:
* Timeshare
    * An organisational co-leases facilities with a business parter or sister organisation, unlocking a BC option to save costs.
* Service bureaus
    * A BC strategy in which an organisation contracts with a service agency to provide a facility for a fee.
* Mutual agreements
    * Two organisations sign a contract to assist the other in a disaster by providing BC facilities, resources and services until the organisation in need can recover from the disaster.

## Crisis Management

* Another process that many organizations plan for separately is crisis management (CM), which focuses more on the effects that a disaster has on people than its effects on information assets.
* While some organizations include crisis management as a subset of the DR plan, the protection of human life and the organization’s image is such a high priority that it may deserve its own committee, policy, and plan.

### CM Team

* CM team is responsible for managing this event from an enterprise perspective and performs the following roles: 
    * Supporting personnel and their loved ones during the crisis.
    * Keeping the public informed about the event and the actions being taken to ensure the recovery of personnel and the enterprise.
    * Communicating with major customers, suppliers, partners, regulatory agencies, industry organizations, the media, and other interested parties.

* The crisis management planning team (CMPT) should establish a base of operations or command center near the site of the disaster as soon as possible.
* The CMPT should include individuals from all functional areas of the organization in order to facilitate communications and cooperation.
* The CMPT is charged with three primary responsibilities:
    * Verifying personnel status
    * Activating the alert roster
    * Coordinating with emergency services

## Testing Contingency Plans

Four strategies:

* Desk check
* Structured walk-through
* Simulation
* Full interruption
