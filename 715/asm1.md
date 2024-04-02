# Case Study Video Presentation

Topic: AnyDesk says hackers breached its production servers, reset passwords

* Statement made on February 2nd, 2024.
* Hacker gained access to the company's production systems.
* Source code and private code signing keys were stolen.

AnyDesk is a remote access solution allows users to remotely access computers over networks, 
it is popular between enterprise for remote support or to access co-located servers.
it has 170,000 customers, such as 7-11, Samsung, MIT, NVIDIA and United Nations.

## Process

* Firstly detected indications of incident on production servers on January 26th, 2024.
* After **Security Audit**, they determined their system is compromised, then they started a
response plan with CrowdStrike, a cybersecurity company.
* No ransomware involved.
* Claimed no authentication can be taken by design.
* No indication of session hijacking.
* New certificate from V8.0.8 on January 29th, 2024.
* Born reports AnyDesk had a 4-day outage from January 29th, while they disabled login to the client.
* Status AnyDesk reports major outage on Customer Portal on January 28th, with multiple minor
Customer Portal outage from January 22nd to 24th.
* Either one, AnyDesk confirms this is for this incident.

## Damages

* Stole source code and private code signing keys/certificates.
* A 4-days service disruption, maintenance required.
* User password exposure.

## Responses

* Activate a response plan with CrowdStrike, an cybersecurity firm.
* Revoked security-related certificates, remediated and replaced systems as necessary.
* Assure users safety to use and claim no end-user device affected, ask them to update the latest
version with new code signing certificate.
* Revoke all passwords on web portal and suggests a change on password if used on another site, 
although claimed no authentication token was stolen, and cannot be because of system design.
* No end-user device has been affected.
* No evidence that any customer data has been exfiltrated.


## Links:

### BleepingComputer Original

* https://www.bleepingcomputer.com/news/security/anydesk-says-hackers-breached-its-production-servers-reset-passwords/

### AnyDesk

* https://status.anydesk.com/history
* https://anydesk.com/en/public-statement-2-2-2024
* https://anydesk.com/en/public-statement

### Supply Chain Security

* https://www.securityweek.com/anydesk-revokes-passwords-certificates-in-response-to-hack/

### Medium

* https://medium.com/@0xrave/anydesk-production-servers-compromised-this-is-what-you-need-to-know-feb-2024-cf2998b41b79#:~:text=What%20is%20the%20incident%20about,their%20executables%20and%20scripts%20securely

### Phishing Tackle

* https://phishingtackle.com/articles/anydesk-security-crisis-accounts-for-sale-on-the-dark-web-following-production-server-breach/

### SmarterMSP

* https://smartermsp.com/cybersecurity-threat-advisory-anydesk-production-system-breach/

### Spiceworks

* https://www.spiceworks.com/it-security/data-security/news/anydesk-server-breach/

## Scripts

Greetings everyone! This is Dongyi Guo from KIT715: Cybersecurity and Ethical Hacking! In today's video I am going to introduce a recent security incident from AnyDesk, the remote control software solution company, they had a production server breach at the end of January and early February this year, and I am going to introduce more.

I will firstly introduce AnyDesk and its Customers as the first entities involved, then I will give an overview about the incidents, provide some causes about this incident, then I will reveal the attackers and their motivation. At last I will introduce what kind of impact is eventually there, and how AnyDesk is responding and mitigating the effects of the impact.

So AnyDesk as mentioned before is a remote access solution, it unlocks users to access computers over internet and any other networks. It is really popular between enterprises that have huge demand on remote support or accessing co-located servers. They have over 170,000 customers and large customers like 7-11, Samsung, MIT, and NVIDIA.

So, on Jan 26th, AnyDesk started noticing there is a potential indication that their production system could be compromised. Three days later, together with CrowdStrike, a cybersecurity company they started a security audit, and at that day they confirmed there was a breach, and potentially the source code and private keys that used to sign the code could be exposed, which unfortunately was the case and they made a statement another three days later and confirmed it. At the exact same day, AnyDesk client login portal was pulled out for a so called maintenance, although logged-in users were still able to use everything but no login was allowed across the board. After the login portal was back to service, all users were required to reset password in order to proceed with AnyDesk service.

AnyDesk does not give any many details on the factors of this incident besides mentioning there was no ransomware, no session hijacking. However, as this is a production system breach, the top reasons we can assume are definitely server misconfiguration and supply chain attack, which means some of the software AnyDesk was using led to vulnerabilities. Other possibilities remain as well such as there could be unused and unrevoked account from previous employee in the production system, some unpatched or even zero-day vulnerability, and there could even be imposters.

Now let's introduce the last entity involved, the attackers and why they were doing that. So although AnyDesk didn't give any information about the intruders and they kept saying there is no evidence that any customer data has been exfiltrated. However, not long after, over 18,000 AnyDesk Credentials were put on sale for $15,000, by the user "Jobaaaa" at exploit.in. So it turns out it's all about money.

So together with the password exposure, the stolen source code and code signing private key, the impact of this incident also includes the 4-day service disruption, and more importantly, reputation. AnyDesk already suffers from reputation of having users with malicious intent such as scam, and they themselves does not really care anything else other that making money, when this incident popped up the comments and criticises were not giving them peace.

Although one thing should be given to them is their mitigation measurements were there and solid, the security audit they did with CrowdStrike was very thorough, they replaced the certificates, remediated and replace systems necessary rather fast to avoid further consequences of stolen code signing keys, and they requested user to update password upon recommendation of MFA.

And that's all from me today, some references here, thank you so much!