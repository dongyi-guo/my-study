A computer program emulating the behaviour of a human expert with a particular domain of knowledge. ES are commercially successful and publicly visible until recently in fields like medicine, space, agriculture, mining, education, etc.
**Contains:**
* User Interface
	* Receive Query from user
	* Send Advice to the user
	* Interacts with inference Engine
	* This "User Interface" can be:
		* Developer Interface
		* Explanation Facility
		* User Interface
		* System Interface
* Inference Engine
	* Interacts with User Interface
	* Fetch from Knowledge Base
	* Reasoning step by step
* Knowledge Base
	* Provide to inference Engine
	* Learn knowledge from an expert
	* Store knowledge in a language that can be understood by human and machines
		* With a working memory
	* Experts express knowledge in some patterns (If...then...)
Knowledge Acquisition is the main bottleneck of ES development.
**Applications**
- Prediction / Forecasting
- Diagnosis Systems
- Monitoring
- Process Control
- Design
- Scheduling & Planning
# Knowledge Base (KB)
In AI, knowledge representation is the field of:
- How knowledge and facts can be represented
- How can we reason with that knowledge
Has to be a specific domain.
New facts, derived from existing facts and rules are added temporarily.
New facts and rules can be added permanently during system development.
## Facts and Rules
Facts are statements of what is true (a = 4)
Rules are causal statement with condition (If...then...)
In **IF...THEN** or they called it **Production Rules**
* **IF** part is called **antecedent**
* **THEN** part is called **consequent**
* True(antecedent) -> True(consequent)
* True(consequent) !-> True (antecedent)
Production Rules can represent **procedural** and **declarative** knowledge:
* Procedural means if situation is there, act
* Declarative means if premise is presented, conclude
Reasoning is **chaining** roles, with the conclusion of one rule becoming the premise of another.

# Inference Engine
* A user will provide a system with appropriate facts, the inference engine's job is to match the facts against all the antecedents of the rules stored in the knowledge base.
* A rule matched with a fact will be "**fired**", a fired rule's consequent will be true. This is also called **Law of Modus Ponens**: IF True(A) AND True(A) -> True(B), THEN True(B).
* It structures independently from the knowledge base.
## Two-way reasoning:
You can either
- Check antecedent to find consequent.
- Search antecedent to support or refute the consequent.
## Forward Chaining
For efficiency in reasoning, it is important to determine which rules are to fire at any particular time. Let's say all the facts are obtained in advance, and the matching starts without any stop while a final conclusion has been met (Consequent of rules become antecedent of other rules). This "reasoning forward" from facts to conclusion, is called **Forward Chaining**.
- Best suiting for open-ended problems.
- Also called Data-driven searching.
## Backward Chaining
Forward Chaining can be inefficient if some facts obtained are not needed. A more focused approach is to adopt possible conclusions, called **Backward Chaining**
- Most useful in diagnostic system, while only a small number of well-defined goal states can be possible.
- Also called Goal-driven searching.
## Inference Control
An inference engine is job is to control the reasoning process
- Decide where to start.
- Which rule to fire next.
- Can be visible via **problem space representation**, it's a network with nodes as facts, deductions and conclusions, arcs as rules.
## Reasoning Exercise
1. disease = measles || allergy 
2. No
3. disease = allergy, backward chaining

