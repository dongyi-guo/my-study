# Quantitative Research

## Week 5

Learning Activity 1 is preparing the data and software.

Learning Activity 2:

1. Go Descriptive Statistics, enable box plot.
    * Based on the questions, you should split with gender and look into height variables. 
    * And yes, male participants are taller, there is a gender bias as more male candidates are observed.
2. Enable scatter plot.
    * Have Density or Histogram for distribution indicator.

Learning Activity 3:

* Try to build Descriptive Statistics.
* With height and age as observing variables, and split with sex and fracture separately.

Learning Activity 4:

So we are comparing the weights to a constant 500:

* 2 variables comparing - t-test
* Comparing to one constant - only one sample

So, we do One-Sample T-Test:

$H_0$: The mean is equal to 500.
$H_1$: The mean is not equal to 500.

* Select One Sample T-test.
* Select Tests to Student.
* Set the Test value to 500.
* Use variable Weight(g).

The p-value is 0.067 > 0.05, so there is no significant sign of rejecting the $H_0$, so we need to say yes the mean of weights are equal to 500.

## Week 6 - Parametric Test

So your null hypothesis is most likely the point you want to prove, and the alternative hypothesis is the other side of it.

Also, when we are pulling up the null hypothesis, we need to pay attention if our problem is one-sided / one-tailed, which means we only care lower or greater from one side of another variable (or constant), or twp-sided / two-tailed, which basically is asking whether they are equal or not, and the hypothesis is going to be whether they are equal or not.

Finally, pay attention if data you are making comparison on have some relationship or not, if you are comparing some features like whether your target can only have or have not, surely they are independent. But if you are comparing something like data from different years, such as sales numbers, of course the previous year's sales number could impact on the latter's, so they are dependent data. Tests are categorised into independent test and dependent test.

### Learning Activity 1

$H_0$: Mean of fracture == Mean of non-fracture

$H_1$: Mean of fracture != Mean of non-fracture

* Go to Independent Samples T-Test
    * Has 2 variables or 2 aspects of a variable. (fracture v.s. non-fracture)
    * You can either by fracture or non-fracture and they don't impact on each other.

You will have p-value at 0.033 < 0.05, which means $H_0$ can be rejected, mean of people who with fracture is not equal to the mean of people who without a fracture. So it is related to the spine bone density because differences are made.

### Learning Activity 2

The data represents time for a pill taken to relieve the pain, for 5 different drugs.

Now we have 5 different variables to look into, so instead of t-test (can only do 2), we go ANOVA. One thing is, it will show you "Hey, there are differences", but you will not know which one is different.

So your first hypothesis:

* $H_0$: The time to take effect for all 5 types of drugs are the same.
* $H_1$: The time will be different.

Then in JASP:

* Go to ANOVA.
* Dependent Variable set with Time.
* Fixed Factors with Drug.

You will find p-value < .001, which indicates strong rejection on $H_0$, so there are significant differences for pain relief depending on the drugs.

Now question is, who are making those differences? As ANOVA won't tell us this.

Using Descriptive Statistics on the ANOVA panel, you can see the mean for each type of drugs on time, E's mean is much smaller comparing to others, B is a bit smaller and A, C, D are quite close to each other. In this case, we compare A, B and E. 

The way to select only A and E is to click on the column names of JASP dataset, then filter only the dataset you want.

#### A v.s. B

* $H_0$: The time taken to relief for A and B are same.
* $H_1$: No they are not same.

The p-value will be 0.314 > 0.05, so we cannot reject null hypothesis, so A and B are the same in terms of time for pain relief.

#### A v.s. E

* $H_0$: The time taken to relief for A and E are same.
* $H_1$: No they are not same.

The p-value will be 0.007 < 0.05, so we reject the null hypothesis, and we can safely say that A and E, in terms of pain relief, has a significant difference on time.

#### B v.s. E

* $H_0$: The time taken to relief for B and E are same.
* $H_1$: No they are not same.

The p-value will be 0.006 < 0.05, so same story, B and E are very different in terms of time on pain relief.

### Learning Activity 3

The thing is, in order to use stuff like t-test or ANOVA, or called "Parametric Test", your data need to be normal distributed so the p-value actually has some meaning as it is a possibility, if not then landing on 95% with non-normal-distributed data doesn't mean anything.

In order to do this, we can:

* Go to Descriptive Statistics.
* In statistics, enable Shapiro-Wilk test.
* Enable Q-Q plots.

#### Shapiro Test

Basically this test assumes:

$H_0$: Your data is normal distributed.
$H_1$: Nope.

So if the p-value of your Shapiro-Wilk is < 0.05, this data set is not normal distributed. And if one set of data is not normal distributed. Then the whole data set is considered as non-normal-distributed.

### What should we do?

1. Pull up research questions.
2. Use box Plot and scatter plot and Descriptives to find data features.
3. Check your data set's normality with Q-Q plot and Shapiro-Wilk test. This will determine whether you are using parametric test or non-parametric test.
4. Give $H_0$ and $H_1$.
5. Retrieve p-value and answer your questions.

## Week 7 - Non-Parametric Test

So after checking the data with descriptive statistics, you always want to look into the data's normality with Q-Q plot and Shapiro-Wilk Test.

### Learning Activity 1

Go to Descriptive Statistics and enable Q-Q plots and Shapiro-Wilk test:

* From Q-Q plot, you can see the dots literally up-curve off the line for A and B.
* For Shapiro-Wilk, A and B have a p-value that is smaller than 0.001 < 0.05, so they are not normal distributed.
* So, we need non-parametric tests.

### Learning Activity 2 - Kruskal-Wallis (non-Parametric of one-way ANOVA)

In JASP, still go to ANOVA:

* Dependent Variable is the Runtime.
* Fixed Factors are the Algorithm ID.

But this is still ANOVA, in order to use Kruskal-Wallis:

* Go to "Non-parametrics".
* Select "Trial" as Fixed Factors.

We have the question whether they all have the equal **median**, which is essentially what non-parametric test is looking forward to:

* $H_0$: The median for all 3 algorithms are the same.
* $H_1$: No they are not.

And p-value is 0.006 < 0.05, so $H_0$ is rejected and we say no, they are not equal.

### Learning Activity 3 - Mann-Whitney (Equivalent of independent T-Test)

Same as ANOVA, Kruskal-Wallis denies they are not all the same, but won't tell much further. In order to find out which is the fastest, apply Mann-Whitney test to each pair of algorithm's run times.

Like t-test, Man-Whitney compares only 2 variables, so to run the test, make the in pairs with the filter, then under Independent Samples T-test:

* Dependent Variable - Runtime.
* Grouping Variable - Algorithm ID.
* Select "Mann-Whitney" for tests.

#### A v.s. B

* $H_0$: The median for algorithm A and B are the same.
* $H_1$: No they are not.

The p-value is 0.022 < 0.05, so we reject the $H_0$ and claim that they are indeed different.

#### A v.s. C

* $H_0$: The median for algorithm A and C are the same.
* $H_1$: No they are not.

The p-value is 0.004 < 0.05, so we reject the $H_0$ and claim that they are indeed different.

#### B v.s. C

* $H_0$: The median for algorithm B and C are the same.
* $H_1$: No they are not.

The p-value is 0.158 > 0.05, so we cannot reject the $H_0$ and claim that they are quite same.

Now we can see B and C are quite same, and A is so different from others, now what we can do is we turn our two-sided test into one sided:

#### One-sided A v.s. B

* $H_0$: The median for algorithm A are smaller.
* $H_1$: The median for algorithm B are smaller.

(The reason why you can eliminate equal is because you did the two-sided before, otherwise you can't do that.)

The p-value is 0.989 > 0.05, so we cannot reject the $H_0$, so A is smaller on time.

#### One-sided A v.s. C

* $H_0$: The median for algorithm A are smaller.
* $H_1$: The median for algorithm C are smaller.

(The reason why you can eliminate equal is because you did the two-sided before, otherwise you can't do that.)

The p-value is 0.998 > 0.05, so we cannot reject the $H_0$, so A is smaller on time.

Hence we can say that A is surely faster than others.

And we can inspect this with box plot and descriptives, A is faster in any ways, B and C are one higher than another on Mean or Medium, B is probably slower in some more cases.
