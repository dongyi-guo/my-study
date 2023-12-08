# Incident Response Analysis

## Topic data leaks:

* An API Vulnerability: 5.4 Millions of Twitter account exposed.

## Take-away Points

* The API is used to collect non-public data leave the data vulnerable.

* Not surprising and could be happening for long.

* Potentially the damages could be even larger.

    * 1.3 million phone number leak in France, deductively 17 million globally.

* The vulnerability was introduced by Twitter in a June 2021 patch.

* In July, threat Actor is selling 5.4 million Twitter user's phones and emails for $30K.

    * Including celebrities, politicians, organizations and government authorities.

    * Since November 24, completely free.
    * Newest data of this were based on cache from December 2021.

* Data of 1.4 million suspended users are also exposed for sale.

* Even larger data dump has been prepared - tens of millions of twitter records.

* What are the leaked accounts used for? - Scams and Phishing.

    * Apple promotes cryptocurrency.

* Celebrities are normally the the target to spoof, and normal users are the target to spear phishing on.

* Twitter: FAKE NEWS, then admitted in August 2021.

## References

* TechHQ: https://techhq.com/2023/01/twitter-api-vulnerability-leaves-millions-exposed/ 
* BleepingComputers: https://www.bleepingcomputer.com/news/security/54-million-twitter-users-stolen-data-leaked-online-more-shared-privately/
* BleepingComputers: https://www.bleepingcomputer.com/news/security/hacker-selling-twitter-account-data-of-54-million-users-for-30k/
* Engadget / Yahoo News: https://www.yahoo.com/news/twitter-data-for-54-million-users-leaked-online-095040426.html?ncid=twitter_yahoonewst_sjwumo1bpf4
* VentureBeat: https://venturebeat.com/security/twitter-breach-api-attack/
* VentureBeat: https://venturebeat.com/business/cyberattack-response-time-averages-2-days-report-finds/

* Wired: https://www.wired.com/story/twitter-leak-200-million-user-email-addresses/
* FireWallTimes: https://firewalltimes.com/twitter-data-breach-timeline/
* Forbes: https://www.forbes.com/sites/daveywinder/2022/11/29/zero-day-twitter-hack-confirmed-impact-could-exceed-20-million-users-report/?sh=2e95efd356c5
* The Verge: https://www.theverge.com/2023/1/6/23542038/twitter-hack-200-million-email-addresses-usernames-affected
* SpiceWorks: https://www.spiceworks.com/it-security/data-security/news/twitter-api-vulnerability-data-breach/
* ZDNET: https://www.zdnet.com/article/hacked-my-twitter-user-data-is-out-on-the-dark-web-now-what/

## Scripts:

Thank you so much George! And hello everyone this is Dongyi, now I will carry on the dissection to the last bit of it: the impact brought by this incident, which basically is the loss of assets for Twitter because of this vulnerability.

Of course, the most measurable impact for a commercial company is going to be loss on money - Twitter was fined 150 million US dollars from the  Federal Trade Commission because their lapses in upholding user privacy in May 2022, and that is not over, a fine is lodged although the amount is yet to determine, but it is there for X, the Twitter after it's taken over by Elon Musk from EU because of the violation of GDPR, as the entity failed to protect user's privacy again. Moreover, the most direct loss of Twitter, the 5.4 million users information, including their names, email address or phone numbers, their location information and account metadata such as following and follower information, their favorites extra extra which are not meant to be public, and 1.4 million suspended user information from another API suffering from the similar vulnerability. If we add them up, that's 7 million profiles of private information leaked because of one vulnerability. And what's more, there are also other data leaks claimed from this API vulnerability, including 1.3 million phone number exposed, which is confirmed by a threat reporter, who posted this on Twitter, and gets banned very quickly. It is also estimated that if the 1.3 million number leak is true, globally there could be 17 million number leaked, because of the same API vulnerability.

Now we finished dissemble the incident, let's see what is in its future, what is the action there at the post-incident era?

And sadly, we headed from a not-that-good of a start, as when the news of the 5.4 million was put on sale in July 2021, which is one month after the vulnerability was introduced by Twitter through a patch in June 2021, Twitter went full mode of denial, they refused to admit on the data breach, nor allowing anyone to talk about it, if you posted related news for this data breaches, you would be judged as fake news and got banned pretty soon. They did full admission on it in August 2021, and the full vulnerability was reported on January 1st, 2022 and Twitter followed up by a fix 13 days later.

So how could there be more defensive and preventive measures to either stop the vulnerability or stop the loss? First thing first, for a 0-day vulnerability, Twitter could act faster, as averagely it takes 20.9 hours for a company to respond to a 0-day vulnerability and Twitter used 13 days, which means there is a 13-day window, everyone could easily know what this vulnerability is and how to exploit it. Next, even Twitter could have enough reason to deny the exploitation, it is no harm to impose a little bit warning to the user, and that is Twitter can always do, encouraging information security to the user, always check the legitimacy of the person you are talking to, be protective about your private information, and enable 2FA, don't use SMS verification, use the app or hardware keys which Twitter or X is providing now and always be caution with links.

So, although the vulnerability was fixed and Twitter claimed that there is quote-on-quote, "no exploitation", the data leaked did involve a great deal of celebrities, organizations and authorities, which makes spoofing as them for threat actor considerably easier. Also for accounts that have be exposed, spear phishing on them can be tremendously easier as well, since their contact, account activity and other metadata was in public site. This also unlocks the potential of social engineering attacks if these users are in favor of other target entities for threat actors, the data leaked here could be their key.

So there you have it, I hope this presentation here gives you a decent provision of this incident of Twitter caused by an API vulnerability and hope you have some insights from it, Thank you very much.
