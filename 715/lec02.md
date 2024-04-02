# Assignment 1

A 3-min case study video with given incident, worth 20%, with **maximum 7- page slides** and a **word document** with all the references. Slides must have **title page** and **reference page**.

* Introduce yourself, and provide an overview of what you are discussing
* Incident's causes: Lack of Safeguards, Phishing
* Who the attackers may be, what businesses were involved, who the customers are
* Attacker's motivations, like financial gain
* System / People Affected, like a data breach of PII
* Effects: System Damage, Identity Theft...
* Mitigations: Organisation's Response, More Safeguards, Reduced Harm for People Involved.

# Security Management

* Protect an organisation's assets against risk, includes:
  * Asset Inventory
  * Vulnerability Analysis
  * Threat Analysis
  * Risk Analysis
  * Infrastructure Design
  * Policy Definition
* **Threats**: Action by adversaries to exploit vulnerabilities: Malware, Ransomware, DDoS, Malicious Insiders, Identity Theft, Phishing, Email Scams
  * Active Threats: Masquerading, Replay, Modification of data, DoS
  * Passive Threats: Release of data, Traffic Analysis
  * Can use attack trees to define complex attack scenarios

## Risk Analysis

* Risk: function of assets, vulnerabilities and threats (assets * vulnerabilities * threats)
* Quantitative Analysis:
  * Value from a mathematical domain: Price, Probability
  * Outcome is a mathematical characterisation: Expected Loss
* Qualitative Analysis:
  * Value from a domain without math
  * Outcome is ad-hoc usually

## Security Assurance & Iteration

* CIA & A: Confidentiality, Integrity, Availability, Authentication / Authorisation
* Security is not a state, it's an ongoing process, managing security is a balance of things:
  * Usability, Security, Functionality, User-Friendliness, User Buy-in...
* Main Problem: Uncertainty on Costs - Does it worth?
  * Asset Costs
  * Threat and Risk Analysis
  * Human Factors
* Design Principles:
  * **Defense in Depth**
  * **Layered Protection**
    * Complementary Security Layers
    * Defence in Multiple Places
    * Diversification: Use of Complementary Products

### The Onion Model

From outer to inner:

* Applications -> Services -> OS -> Kernel -> Hardware
* Network -> Host -> OS -> Application -> Data

# Vulnerability Assessment

* A systematic review of security weaknesses in an information system. It evaluates if the system is susceptible to any known vulnerabilities, assigns severity levels to those vulnerabilities, and recommends remediation or mitigation, if and whenever needed.
* A Passive Process, with little to no risk to infrastructure
  * Much Preferred by businesses as it doesn't interfere normal business running

* Assessing could be involved:
  * Application, Server, Firmware versions -> Vulnerabilities
  * Code -> Sanitised Input and Robust Memory Management
  * Security Boundaries -> Keep resources Private
  * Permissions -> FS, Application, Database
  * Data Management, to ensure data from outsiders is not trusted in scenarios where embedded malware could be executed
  * Policies and Procedures, to ensure appropriate control and best practices

* Inform Threat-and-Risk Analysis, or Patching / Maintenance Task

# Penetration Testing

* The practice of conducting an authorised attack against a system, using the same approach that a malicious source would use, in a manner designed to evaluate the security of a system or network.
* An Active Analysis, may attack systems to find vulnerability, or evaluate possible attack vendors
* Reveals feasibility of an attack and the impact on the business
* Identifies vulnerabilities but also strengths
* Could be part of risk assessment, or stand-alone
* Find flaws in:
  * Policies
  * Specifications
  * Architecture
  * Implementation
  * Software
  * Hardware
* We are always vulnerable even if we are 99.99% safe and secure
* There are ethical and legal considerations
* Permission must be obtained, and it should be a **sanctioned process**:
  * Must be approved, Must have written permission, Must perform in the discussed 
* There should be protection measures implemented in the event of access to sensitive data
* And try to test without interruption to the customer's business or production

### Approaches

#### Black box (Zero-knowledge) Testing

* Tester needs to acquire the knowledge and penetrate with their own tools and techniques
* No information inside the system are provided explicitly
* Provides insights into the robustness of security in place when under attack using easily accessible frameworks 

#### White box (Inside-Knowledge) Testing

* Tester is given full information about the target system or network: Overview, Data Flow, Code Snippets...
* Reveals more vulnerabilities and may be faster
* Intended to replicate an attack from a criminal hacker that knows the company infrastructure very well

#### Grey box Testing

* Tester simulates an employee
* Tester is given some degree of internal access, like a standard access account in the system or network, then they will try to work from what they have

#### Structure

There is not fixed structure, it is all about the goal, if it's a full system test, then there could be 4 stages laid out (or even 5, 7, 9...). **Typically, Stages are:**

1. Scope / Goal Definition
   1. What attacker is it? What knowledge could be there?
   2. Which system or networks?
   3. How Long?
   4. Permissions
2. Information Gathering ("Foot-printing")
   1. What can be found?
3. Vulnerability Detection ("Scanning", "Enumeration")
   1. Manual Detection
   2. Automated Detection (nmap or OpenVAS)
4. Information Analysis and Planning
   1. Collating the Information
   2. Preparing the high level attack plan
5. Attack & Penetration / Privilege Escalation / Maintaining Access
   1. Actual exploit
   2. Get access as high as possible
   3. Maintain future easy access
6. Results Analysis & Reporting
   1. Organise data to form a report
   2. Make recommendations
7. Clean-up
   1. Tide up the mess
   2. Normally client will do this

#### Open Problems and Issues

* Analysis Phase
  * Difficult and Time Consuming to consolidate information gathered and produce high level conclusions
  * Hard to keep an up-to-date overview
  * No-specific tools, Need experiences
  * No formal processes or tools to help estimate time and effort
* Penetration Stage
  * Requires high skill levels
  * Public information / exploits are unreliable and require customisation and testing
  * In-house exploits are not reusable
  * Exploitation is harder than knowing the vulnerability
* Response to Incidents
  * Needs to be factored in Pen-Test
  * Pen-testers should be involved in the process, especially policies
* Clean-up
  * Can be difficult
  * Things might not work or traces will be left

