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

Greetings everyone! This is Dongyi from KIT715! In today's video I am going to introduce a recent production system breach from AnyDesk.

I will firstly introduce AnyDesk and their customers as entities involved, give an incident overview, provide possible causes for the incident, then reveal the attacker and the motivation. At last I will introduce what impact is eventually there, and how AnyDesk is responding and mitigating the damage.

AnyDesk is a remote access solution company, they enable users to access computers over networks. It is popular between enterprises demanding remote support or co-located server applications. They have over 170,000 customers and big companies like 7-11, Samsung, MIT, and NVIDIA.

So, on Jan 29th, AnyDesk noticed a indication that their production system could be compromised. Together with CrowdStrike, a cybersecurity solution company, a security audit was conducted and they confirmed there was indeed a breach resulting the source code and private keys that used to sign the code were exposed. Later that day, they released a new version of client with a new certificate, and soon after the client login portal was pulled for a 4-day maintenance. After it was back to service, they made the offical statement and all users were pushed to reset password if they want to proceed using AnyDesk.

AnyDesk does not give details on the factors of this incident besides mentioning there was no ransomware, no session hijacking. However, as this is a production system breach, the top reasons there could definitely be misconfiguration and supply chain attack. There could also be unused and unrevoked account from previous employee in the production system, some unpatched or even zero-day vulnerability, and there could even be imposters.

Now let's introduce the last entity involved, the attackers and why they were doing that. So although AnyDesk didn't give any information about the intruders and they kept saying there is no evidence that any customer data has been exfiltrated. However, not long after, over 18,000 AnyDesk Credentials were put on sale for 15,000 US dollars. So it turns out it's all about money.

So together with the password exposure, the stolen source code and code signing private key, the impact of this incident also includes the 4-day service disruption, and more importantly, reputation. AnyDesk suffers from having users with malicious intent such as scamming, and they themselves does nothing, when this incident came the criticism were not giving them peace.

Although one thing should be given to them is their mitigation measurements were solid, the security audit they did with CrowdStrike was thorough, they replaced the certificates, remediated and replace systems necessary quite fast, and they requested user to update password upon recommendation of Multi Factor Authentication, which is comprehensive enough.

And that's all from me today, some references here, thank you so much!
