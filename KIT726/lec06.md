# DNS Security

## DNS - Domain Name System

* Designed in 1980s, without any security considerations.
* Phone Book of the internet.
* Maps hierarchical domain names to IP addresses.
* Servers queried in order for each level of the domain.

### Server Types

Resolver / Recursor

* Bottom of nameserver hierarchy
* Services client DNS requests, and returns the result.
* This is most likely your router if home, it will forward requests to your ISP's DNS server.

Root nameserver

* Top of the nameserver hierarchy.
* Proper resolvers know all of them.
* 13 root servers, and hundreds through replication.

TLD nameserver

* Top-level domains: .com .net .au ...
* Provide addresses for its subdomain.
    * apple.com

Authoritative nameserver

* Stores information about hosts on a specific domain that it serves
* store.apple.com

### DNS Resolution

* Clients need to resolve domain names to IP:
    * dongyi-guo.xyz to 69.69.69.69
* Resolver queries (recursively):
    * Root DNS server
        * Responds with address of a top-level domain server (.com).
    * TLD server
        * Responds with the IP address of the domain's nameserver.
    * Domain's nameserver
        * Returns IPs of the host
* Caching is used to speed the entire process up.

### DNS zone files

Zone file is a text file that stores records that:

* Define the authoritative source for the domain, an email contact, and other metadata.
* Map domains and subdomains to IP addresses or other domains.
* Can store text records of any arbitrary information.

### DNS records

* Map host and domain names to IP addresses.
* Commonly used records:
    * A, AAAA
        * Points a domain name or subdomain name to IP addresses.
        * Subdomain can be a @ character, meaning current domain.
        * Subdomain can be a * wildcard means all subdomains resolve to the same IP.
    * CNAME (canonical name)
        * aliases - point a domain or subdomain to another hostname.
    * MX (mail exchanger)
        * used for mail routing, defines a hostname to receive mail for the domain.
        * Can be multiple, and include a priority.
* Other record types
    * SOA (start of authority)
        * First record in zone file.
        * Contains administrative information about the domain.
    * NS - hostname of nameserver for a domain.
    * TXT
        * A record to store arbitrary text notes about the domain.
        * Increasingly used as an extension mechanism for other security features.

### DNS query / response

* Over UDP with nameservers and resolvers on port 53 listening.
* Packet Structure:
    * Header: UID, query type, count, response count...
    * Questions: domain name and record type.
    * Answers: domain name, type of response and data.
    * Authority: Authoritative nameserver
    * Additional

Note there could be multiple questions and responses.

If data are exceeding the UDP package limit, it will go TCP.

Unix Helper:

* nslookup - name server lookup (Bit old)
* dig - domain information groper (Modern) 

## DNS Security Issues

* Typo-squatting: register similar domains for phishing.
* DDoS on DNS servers.
* Lack of privacy.
* Security Weak as UDP.
* No encryption, just like telnet.
* Amplification attacks
    * DNS queries are small, but responses can be large.
    * By spoofing the source address in a DNS query to be a victim's IP address, bots can cause DDoS attacks.
* Cache poisoning
    * Malware can respond to DNS queries with spoofed source addresses, and return fake IP addresses
    * Fake IPs get cached, and returned in response to other queries.

## DNSSEC, DNSCrypt, DOH, ODoH

### DNSSEC

* Introduced in 1997 to address security issues around DNS - RFC 4033
* Provides authenticity for DNS records using Public Key Infrastructure.
* Each zone has a public / private zone-signing key pair.
    * Public key is published in the domain's zone file as a DNSKEY record
* The private key is used to sign the DNS data.
    * If resolver cannot decrypt the signature with the public key, or it decrypts it and responded data doesn't match the signature, an error will be returned to the query.
* Verify the origin and the integrity of the response.
* How do we know the public key is authentic.
* Note that DNS queries and responses aren't signed - just the DNS data itself in the zone file.
* Still confidentiality - just verifying the integrity of the data transferred.

Deployment

* Take-up of DNSSEC is poor.
* In 2017:
    * Only ~1% of .com .net and .org domains had deployed DNSSEC.
    * 31% of domains that support DNSSEC fail to publish all relevant records required for validation.
    * 39% of domains use insufficiently strong key-signing keys.
    * 82% of resolvers in the study request DNSSEC records, only 12% of them actually attempt to validate them.

Basically a failure.

### DNSCrypt

* First work in 2008, complete spec for version 2 released in 2013.
    * Not submitted to IETF, not an official RFC.
* Encrypts DNS traffic between resolver and name servers
    * Provide authentication, protection from Man-in-the-Middle (MitM) attacks, UDP-based amplification attacks, and DNS spoofing.
* Does not change the basic query or response format, just the way it is transported.
* Claims it "is probably the most deployed encrypted DNS protocol to date"

### DOH - DNS over HTTPS

* Modern attempt to provide encrypted transport between the resolver and the server .
* Proposed and public as RFC 8484 in 2018.
* Requires DOH-capable DNS servers and resolvers.
    * Good server support big DNS providers including Cloudflare, Google, OpenDNS and Quad9.
    * Added to Windows 10 around August 2020.
    * Added to iOS 14 and macOS 11 (Big Sur) in 2020.

Usage:

* Since OS support was weak, scenarios:
    * Browser with built-in DOH support.
        * Enabled by default for Firefox in USA, option elsewhere.
        * Disabled by default for Chrome and Opera, options available.
        * Coming to Edge.
    * Local network DOH proxy.
        * Speaks UDP DNS to local clients, but DOH to upstream servers.

### ODoH - Oblivious DNS over HTTP (Experimental)

* Newer than DoH
* DNS proxy between client and DNS server
* Encrypted content, proxy and pass he request and reply, but cannot see the content.
    * DNS server can decrypt the query and encrypt the response, but does not know the client.
* Provides privacy at bot the traffic and service level.
* RFC 9230 in 2022.

## Use DNS for other security roles

As DNS supports arbitrary text in TXT records, it is increasingly being used for roles not related directly to domain name lookup.

Examples:

* DKIM - Domain Keys Identified Mail
    * Authentication technique to determine if an email was sent by the owner of a domain ant is authentic (unmodified)  - RFC 6375
    * Consist a digital signature of the headers of the email, and sent as another header.
    * A domain key in DNS is a TXT record that has v=DKIM1; h=sha256; k=rsa; p=blahblahblah.
    * When mail with DKIM header arrives a mail service, service queries DNS for the domain key TXT record.
    * Extract it, decrypts it and can thus check validity.
* SPF - Sender Policy Framework
    * An email authentication technique to aid in detection of forged sender address.
    * Used often with DMARC.
    * RFC 7208
    * Authroised sending host(s) and IP address(es) for a domain are listed in the domain's DNS records via TXT:
        * v=spf1 ip4:x.x.x.x a -all
    * A mail server receiving email can check that mail claiming to come from a specific domain actually comes form a host that is authorised to send email for that domain.

* DMARC - Domain-based Message Authentication, Reporting & Conformance
    * Built with DKIM and SPF, protects a domain against sneder spoofing.
    * Domain owner publishes a policy in DNS that specifies:
        * Whether domain uses DKIM, SPF or both.
        * How to check sender address.
        * How to deal with failures.
        * TXT are key=value formats.

Advantages:

* Ubiquitous.
* TXT are automatically cached.
