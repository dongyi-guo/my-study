## Qualitative Risk Assessment

* Defines subjectively, using High or Low
* Defines heavily on expertise, experience, judgment of those conducting the assessment.
* Prefers likelihood and impact still.

### Impact

Consider two elements in determining impact:

* Assets: Gives the inventory itemised with an assigned value.
* Threat: How a threat can reduce the value of an asset.

Then, for each asset, determine the impact to the business, in terms of cost or lost value, of a threat action occurring.

**Check Impact Value, FIPS 199 and NIST SP 800-100 and Impact Examples in lecture**

### Likelihood

Consider three elements in determining likelihood:

* Threat: determine which threats are relevant and needed consideration.
* Vulnerability: determine the level of vulnerability to the threat.
* Controls: determine what security controls are currently in place to reduce the risk.

Then, determine how likely it is that a threat action will cause harm, based on the likelihood of a threat action and the effectiveness of the corresponding controls that are in place.

Likelihood is:

* the estimation of the probability that a threat will succeed in achieving an undesirable event.
* is the overall rating - often a numerical value on a defined scale (such as 0.1 - 1.0) - of the probability that a specific vulnerability will be exploited.

### Risk Level

* Compared the results of risk analysis with risk evaluation criteria
* ISO makes a distinction between risk evaluation criteria and risk acceptance criteria
* Check in lecture for NIST SP 800-100

#### Risk Level Matrix

* The final determination of mission risk is derived by multiplying the ratings assigned for threat likelihood and threat impact.
* The matrix is 3 x 3, 3 level of threat likelihood and threat impact. It may be 4 x 4 or 5 x 5 if there are "Very Low" "Very High", latter may stop the whole system.
* Check some of the matrix in the lecture.

## Quantitative Risk Assessment

Risk can be measured in terms of direct and indirect costs, based on:

1. the costs of potential losses (== asset value)
2. Probability that a vulnerability is exploited to threats (== likelihood)
3. the costs of mitigating actions that could be taken (== controls)

### Extended Whitman's Risk Formula

```
R = P*V - CC[%] + UK[%]
  = (P*V) - CC*(P*V) + UK*(P*V)
  = P*V[1-CC+UK]
```

* P = probability that a vulnerability is exploited to threats
* V = value of asset (or WV: weighted value)
* CC = fraction of risk mitigated by current control,
* UK = fraction of risk not fully known (uncertainty of knowledge)

In human words, risk is:
* The likelihood of the occurrence of a vulnerability
* Multiplied by the value of then information asset
* Minus the percentage of risk mitigated by current controls
* Plus the uncertainty of current knowledge 

## Summary

* Goals of the risk management process:
    * To identify information assets and their vulnerabilities.
    * To rank them according to the need for protection.
* In preparing this list, a wealth of factual information about the assets and the threats they face is collected.
* Information about the controls that are already in place is also collected.
* The final summarized document is the ranked vulnerability risk worksheet.
