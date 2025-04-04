**Definition**: A computer program said to learn from **Past Experience E** with respect to:
* some class of **Tasks / Goals T** of the learning knowledge
* **Measured Performance P** of the learned knowledge,
- If the computer program's **performance at T, measured by P, improves with E**, then, it is a ML program. Because it is **Learning Knowledge from Past Experience Data in order to accomplish the specific goal**.
**Supervised Learning**:
- Problems where the available data consists of **labelled** examples.
- Classification and Forecasting
- Regression
**Unsupervised Learning**:
* Learns pattern from **unlabelled** data, exhibiting self organisation that captures patterns.
* Clustering
* Association
**Classification**: A model for class attribute as a function of the values of other (predictor) attributes, such that **previously unseen** records can be assigned a class as accurately as possible.
**Clustering**:
- Cluster is a subset of objects which are similar.
- Objects in a cluster should be closer to those who aren't
# Knowledge Discovery (KD)
* Setting the Goal
* Decision Making with learned knowledge
* Machine Learning will use Past Experience Data (Training Data) to find Knowledge (Pattern)
* Example:
	* Autonomous Car
	* Recommendation System
	* Stock Prediction
	* Face Recognition
	* Speech Recognition
## KD Process
>**Raw Data -- Data Selection -> Target Data -- Data Pre-processing -> Preprocessed Data -- Data Transformation -> Transformed Data -- Data Mining -> Pattern -- Pattern Evaluation -> Knowledge**
1. Data Selection: Only select the useful data
2. Data Pre-processing: 
	1. Cleaning of incorrect data
	2. Treatment of missing data
	3. Creation of new attributes (where necessary)
3. Data Transformation: Consolidate data into forms suitable for data mining, especially format data from different sources into one common format.
	1. Normalisation
	2. Generalisation
	3. Aggregation
4. Data Mining: Use intelligent methods to extract patterns and knowledge.
	1. For Supervised, Classification and Forecasting
	2. For Unsupervised, Clustering
5. Pattern Evaluation: Are patterns and knowledge from previous step useful?
# Data Processing
Big data itself does not have any special values, it is our job to find which data is important so it becomes useful.
- Data Observation
- Survey
Then, we need to ensure the data quality, to determine if the data is quality, measures can be:
- Accuracy
- Completeness
- Consistency
- Timeliness
- Believably
- Interpret-ability 
To achieve this, we need clean the data, essentially avoid:
- Incomplete Data
- Inconsistent Data
- Noisy Data
Often you want to avoid filling the missing data, just ignore them, or use mean / median or deduced value. Then the data needs to be transferred into forms suitable for the algorithms.
Finally, after that, ML happens.
# Evaluation
## Model Selection
- Parameters: Change during the learning process to improve the model.
- Hyper-parameters: What need to be provided in advance so the model can be set up.
## Train-Test Partition
- Hold-out: two independent data set split in a percentage.
	- Can be biased
- Resampling: Randomly resampling, need to test with multiple tests.
	- More confident, less biased and random
	- Expensive
	- Won't work if data is extremely unbalanced
- Train-validation-test: one more set for model selection.
	- A balance between quality and cost
	- Use different hyper-parameters for different models on the training set
	- Select the best performed one on validation set as result
	- Less expensive, can select models
	- Bit biased if partition is bad
- K-fold cross-validation: Randomly divide into K sets, use K-1 as training data and 1 testing data, repeat K times.
	- Avoid overlapping
	- Evaluate comprehensively as all data are evaluated
	- Very costly
