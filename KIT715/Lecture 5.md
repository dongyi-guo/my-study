# How Exploits work?

Exploits: tools that take advantage of code vulnerabilitites.

* A technical approach, but evolved to be well-documented and increasingly easy to reproduce for non-technical users.
* Required for network-based attacks

Vulnerability Types:

* Codeing errors
* Buffer overflows
  * NEVER use gets(), use scans() or fgets().

* Failure to properly check or sanitise input
* Insecure Components Interaction
  * CWE-89,78,79,434,352,601

* Risky Resource Management
  * CWE-120,22,494,829,676,131,134,190

* Porous Defences
  * CWE-306,862,798,311,807,250,863,732,327,307,759


Use GIF to take over iPhone:

* NSO Group: Israeli company produces highly advanced software for spying on targets.
  * Pegasus phone spyware
* ForcedEntry: Exploit for iPhones unearthed by Google's Project Zero Team, provide attackers remote code execution via zero-click message.
  * Sends a PDF pretending to be GIF, Apple's iMessage will try to scan it, render the PDF into images.
* JBIG2: image compression standard for bi-level (two-tone)


# Side-channel Attacks

Bug-free software does not imply they are secure.

* System leak or leading to a leak
* Changes of Input of data
* If side-effects can be detected externally, input can be deduced.
* Hw/Sw implementation
* Side-channels can be used without replying on coding mistakes if data exfirltration is the goal

Examples:

* Keyboard Acoustic Emanations Revisited: Listen to your typing, knows what you are typing.
* POWER-SUPPLaY: Leaking Data from Air-Gapped Systems by Turning the Power-Supplies Into Speakers.

Orthogonal Axes:

* Invasive v.s. Non-Invasive
  * Invasive: Depackaging the chip/component/device to get direct access to its components.
  * Non-Invasive: Exploit eternally available information such as running time, power consumption, etc.
* Active v.s. Passive
  * Active: Also known as fault induction attacks, need addtional inputs, changes the environment or target to create abnormal operations or change the program flow.
  * Passive: Observe attributes modulated by the operation underway.

Different Side-channel attacks:

* Smart Card
  * Power Supply
  * Clock Frequency
  * Temperature, Radiation, Light, Eddy Currents...
* Private Key
* Power Supply
* Clocking Signal
* Time-attacks
  * Cryptographic operations takes subtly different amounts of time to process different input.
    * Bypass operations such as branching or conditional statements
    * RAM cache hits
    * Processor instructions such as multiplicaiton and division
  * Time cost depends on input data, crypto keys and modulo operation
  * Often used to compromise public-key crypto systems such as RSA

Advantages: Attacks can be implemented with:

* Easy-obtainable information
* Inexpensive hardware
* Remote location
* Speed
* no harm on regular operation and device
* no notifications to victim

# Spectre and Meltdown

Real-world examples of side-channel attacks that have caused significant upheavals for CPU manufacturers and cloud service vendors.

They are related, but not the same, both exploited vlunerabilities in modern processors, from January 2018.

## Spectre

Spectre exploits the side effects of speculative execution - modern chips in order to max the performance, tey will do branch preiction and speculative execution.

* Breaks isolation between apps
* Allow attacker to trick error-free apps
* Safety checks may help Spectre intrusion

## Meltdown

Meltdown exploits the side effects of out-of-order execution, a performance feature present in a wide range of modern processors.

* Breaks isolation between apps
* Allow access to memory, then secrets

## Risks from Both

Steal data which is currently processed on the computer, could include private keys, passwords, personal and confidential data.

## Affection

### Specture

* Desktops
* Laptops
* Cloud Servers
* Smartphones

### Meltdown

* Cloud Providers using Intel CPUs and Xen paravirtualisation without patch.
* Dockers
* LXC
* OpenVZ

# Metasploit Framework

* From Rapid7
* Open-source
* Recon, Penetration, Escalation, Anti-forensics, Evasion
* Written in Ruby, modular and extensible
* Use exploit, set payload, then show options to config options.
* Other components: encoders, auxiliaries, NOPS, post