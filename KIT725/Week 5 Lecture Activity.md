# Vulnerabilities

## Microsoft Exchange Server Hack

What vulnerabilities?

* Server Side Request Forgery (SSRF) vulnerability making crafted HTTP requests being sent by unauthenticated attackers if server accepts untrusted connection over port 443.
* De-serialization of Unified Messaging Service, allow arbitrary code to be run combined with stolen credentials
* 2 Post-authentication arbitrary file write vulnerabilities.

What is the purpose?

1. ACL
2. RCE + DT
3. RCE
4. RCE

* Done by the Chinese, Hafnium, state-sponsored advanced persistent threat group.
    * Use VPS to conceal server.
* Data Theft
* Backdoor
* Further Malware Development

Possible Mitigations

* Web Shells - plug batch files in.
* Patches
* Account guard
