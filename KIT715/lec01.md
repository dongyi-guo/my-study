# The Cybersecurity Landscape

## Context

4 dimension:

* People
* Technology
* Professional Skills
* Technical Skills

## What is Cyber Security?

* Protecting assets for individual, organisational, or business,
  * From theft, damage or disruption.
  * Computer, Network, IT Security

* Exists in multiple areas:
  * Development of Policy Implementation.
  * Testing, Control and Defense Implementation.
  * Vulnerability Research and Responsible Reporting.
  * Dev of tools and methods


Last two are most technical.

## Assets

Components of entity with actual or perceived value:

* Physical Dev
* Software
* Data
* Intellectual Property and Know-How
* Reputation
* Personal Data

## Vulnerabilities

* Weaknesses in a system that can be exploited.

### Types

* Technical: Coding Bugs, Lack of Input Validation
* Configurational: Unnecessary Open Ports, Default Passwords
* Adminstrative: Wrong Access Permissions, Failure to close rogue accounts when employees leave.\

### Find Vulnerabilities

* Automated Scanning
* Fuzzing
* Source Code Review

### Track Vulnerabilities

* Vulnerability repositories: CVE, BugTraq
* Vulnerability Ratings - CVSS
    * High (Critical): Auto-exploitation possible, consequences are catastrophic.
    * Moderate: Exploit mitigated by configuration.
    * Low: Exploit extremely difficult, low gain.

## CIA & A

### Confidentiality

* Goal: Prevent unauthorised access to data
* Potential Scenarios: Discovery of confidential information / authentication credentials
* Solutions: Symmetric or Asymmetric Cryptography

### Integrity

* Goal: Prevent data tampering
* Potential Scenarios: Fraudulent modification of data
  * Modify value of online transaction
  * Injection of malicious code in dowloaded software
  * Evading detection by modding a compromised operating system
* Solutions: Integrity checking using cryptographic hash functions, digital signatures

### Availability

* Goal: 100% uptime for all users
* Potential Scenarios: Disrupt normal operations to starve a site income. Natural pohenomena - Flood, Earthquake etc.
* Solutions: DDoS Mitigation Services, Redudant Distributed Servers, Router and Firewall Reconfiguration, Virtualisation

### Authentication

Goal: Verfication of an identity of a person or computer - Someone / Something is authentic

**Risk: Identity Theft**

How do you prove that someone is who they claim to be?

Authentication is any process that a system tries to verify the identity of an user who wished to access it.

* Something I know - Username / ID and Password 
* Something I have - Key, Smart ID, Secure Tokens 
* Something I am - Voiceprint, Fingerprint, Retinal scan, Face scan

## Why, Who, and How of Hacking

### Define Hacking

* Attempt to circumvent or bypass the security mechanisms of an information system or network.
* Art of exploring various security breaches
* Come with consequences
* Can be done ethically - with consent, care and good intent

### Motivation

* **Financial Gain**: Cash, Bank Accounts, Personal Data to Ransom
* **Trade Secrets, Global Politics**: Country Cyber War, Inter-Nation Conflicts, Espionage, International Trade
* **To Prevent Attacks / Improve Security**: Security Consultants, Pen-Testers

### Hackers

* **White Hats**: Securtity Analysts, Work for Defensive
* **Blue Hats**: Hired to Attack, with good intent
* **Grey Hats**: Works both offensively and defensively, but not always in good intent
* **Black Hats**: Bad Actors with Malicious Intent

### Malware - Malicous Software

* Carriage of Malicious Hacking, Can be sent via Email, Botnets, Worms, Works 24/7
* Example:
  * Botnets, Worms, Viruses, Trojans: Deploy a Payload, or Deny of Service
  * Ransomware: Payload that locks up data for money
  * Key Loggers: Monitor and Gather inputs without consent
  * Backdoors: Retain access in the future

### What to Lose

* PII - Personally Identifiable Information
  * Any information that can be used to positively identify an individual: Name, TFN, SSN, Birthdate, Credit Card Number, Bank Account Number, Gov-ID, Address, Email, Phone
  * PHI - Personal Health Information
    * My Health Record and associated legislation in Aussie
    * HIPPA (Health Insurrance Protability and Accountabiltiy Act) in US
* Sold on Dark site
  * Fake accounts for credit cards and loans
  * Withdraw to cash
* Competitive Advantage
* Reputation
* Political and National Security
* Commercial and Financial Activities
