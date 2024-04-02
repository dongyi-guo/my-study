# Virtualisation

## Module 3

* Web Server - Apache / IIS
* Database - MariaDB / SQL Server
* Container - Docker

On both Unix and Windows.

## General Virtualisation

* Security is a process, there is no end point.
* Virtualising contributes to security.
* Techniques
    * OS security
    * Cryptography
    * Firewalls
    * Intrusion detection / prevention
* Defence in depth - having a mixture of technologies to protect us.
    * Like a castle
* Separates Physical and from the logical
    * Servers
    * Networks
* Since 1960s.
* Current tools have their roots in the late 1990s.

Benefits:

* Cost - one hardware for multiple logical uses.
    * Money
    * Electricity
    * Spaces (less hardware)
* Abstraction by separate s/w and h/w
    * Easier to replace.
    * Reduce dependence on certain vendor.
        * Cost reduction
* Testing/Developing environments to production.
* Maintain the uptime - create an environment anytime you want.
* Keep legacy applications

## Virtual Networks - VLAN - Virtual Local Area Networks

* Divide network into separate broadcast domains - subnetting.
* Router / Switch
* Use 
* Introduce artificial VLANs

Benefits:

* Segregation.
* Maintain the network over time.

Risks:

* Doesn't have to make us secure.
* Creates boundaries between segments of the network.
    * May overly complicate the network.c:w
    * May be vulnerable in other fields.


## Virtual Computers - VM - Virtual Machines

* Flexibility to a network administrator.
* Cost and energy savings.

Hypervisors - Layer

Type 1 - bare metal:

* Itself is a OS
* ESXi, Hyper-V, Citrix Xen, KVM

Type 2 - application and service

* VMWare, VirtualBox , Paralles, KVM

Security benefits - create application-specific hosts.

