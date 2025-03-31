# Reflection
In this week's workshop, we look into another essential part of Assignment 2 - Risk Management, I did the cybersecurity pathway for my MITS degree, so seeing this back again makes me feel like home, but I also recall that risk management is a huge task with massive focuses on details. Then we started looking into Risk Categorisations, Key Performance Parameters (KPP), Risk Breakdown Structure, and Risk Register, I think we definitely need them in our assignment. Finally we dived into the most assignment-related tasks, which allowed us to play roles as Risk Manager, Project Manager, and Technical Lead, I am very interested with this task, this is the first time I know at the manager level, tasks can be categorised and distributed into such specific roles, before I think PM is the one responsible for everything! I also learned what jobs are in these roles of course, and also not in their capability (such as a decision can only be made from the whole business). It's a wonderful journey of learning truly.
# Task 1: Paper
## Objectives
1. Explore the synergies between citizen science (CS) and machine learning (ML), focusing on how ML can enhance CS projects.
2. Analyse the impacts of ML on three key CS tasks:
	1. Engagement (recruiting/sustaining volunteers).
	2. Data collection (automating tasks like species identification).
	3. Data validation (improving quality control).
3. Identify benefits and risks of integrating ML into CS.
4. Propose future directions for leveraging ML in CS
## Research Questions
1. What are some examples of successful citizen science projects where ML is integrated? 
2. What ML techniques have been used in these projects? 
3. What citizen science tasks have been affected by ML in such projects? 
4. What are the benefits and risks of integrating ML in citizen science for practitioners and citizen scientists? 
5. What are the possible future challenges that might arrive as a result of the combination of ML and citizen science? 
6. What are the gaps and limitations of including ML in citizen science?
## Methodology
- **Literature Review**: Synthesises existing research on ML applications in CS.
- **Case Studies**: Examines real-world projects (e.g., iNaturalist, eBird, Galaxy Zoo) to categorise ML techniques and their impacts.
- **Taxonomy Development**: Proposes a framework (Figure 2) mapping ML’s role in CS tasks.
## Findings
### Citizen Science (CS) and Machine Learning (ML)
1. Environmental Science:
    - Camera traps (e.g., MammalWeb): ML automates species identification in images.
    - Species identification (e.g., iNaturalist): Combines human labels with ML (CNNs) to improve accuracy.
    - Marine life studies: ML validates annotations made by volunteers.
2. Astronomy:
    - Galaxy Zoo: Uses ML to classify galaxy images initially labeled by volunteers.
3. Neuroscience:
    - Braindr: Volunteers label MRI images; ML amplifies expert-validated datasets.
### Benefits of ML in CS
- Engagement:
    - Automated feedback (e.g., BeeWatch’s real-time species ID feedback) improves learning and retention.
    - ML can target potential volunteers via social media analysis.
- Data Collection: Automates repetitive tasks (e.g., counting wildlife in aerial images).
- Data Quality: Flags errors (e.g., eBird’s probabilistic models filter outliers).
### Risks of ML in CS
- Engagement: Over-automation may demotivate volunteers (e.g., replacing "easy" tasks).
- Data Quality: Biased training data leads to flawed validations (e.g., misidentifying rare species).
- Ethics: Lack of transparency in how ML uses volunteer data.
### Challenges
1. Rare species identification: Few-shot learning to address limited training data.
2. Gamifibcation: AI-driven incentives to sustain participation.
3. Ethical AI: Ensure transparency and avoid exploitative data use.
# Task 2: Risk Management Plan
## Risk Manager
##### What are the key risks that could potentially impact the success of the project? How would you assess the likelihood and impact of each risk?
* Outdated infrastructure causing delays
	* High - High
* Data security breaches (health data)
	* High - Critical
* Scope creep (feature additions)
	* High - Medium
* Budget Overruns
	* Medium - High
* Team Collaboration: Skill Gaps, Mis-interrupted Communications
	* Low to Medium - High
##### What strategies would you recommend to mitigate the identified risks?
- Technical Risks:
    - Upgrade infrastructure _before_ development begins, or employ cloud infrastructures.
    - Implement encryption, regular security audits, and compliance checks.
- Project Risks:    
    - Freeze scope after sign-off; Set Change Control Processes for new requests.
    - Track expenses weekly; reserve more budget for contingencies.
- Operational Risks:
    - Hire better contractors for skill gaps.
    - Hire team players
##### How would you monitor and control risks throughout the project life cycle?
- Tools: Risk register (updated weekly), Jira for tracking technical issues.
- Meetings: Bi-weekly risk review with the project team.
- Triggers: Automatic alerts for budget/scope deviations.

> Let's see the team's training is depending on a Residual Manager Bob, Bob has all the qualifications of training the stuff and leading the team and project to a big success. However, somehow, he quitted. You are wondering negotiating with Bob and fulfilling his requirements, and find the reason of his quitting asa mitigation method...
>
> Can you?
>
> **NO YOU CAN'T**, IT’S NOT YOUR JOB AS A PROJECT MANAGER. It depends on the business and how they want to deal with them, you are responsible for the team, not the whole business.
## Project Manager
##### How would you incorporate the risk management plan into the overall project plan? 
- Embed risk milestones in the project timeline (like security audit done at week 6).
- Allocate some schedule/budget to risk contingencies.
##### How would you communicate the risks and mitigation strategies to stakeholders? 
- Dashboard: Share a simplified risk matrix (likelihood/impact) in monthly stakeholder meetings.
- Escalation Path: Critical risks (e.g., data breaches) reported immediately to executives.
##### How would you ensure the project stays on track despite potential risks? 
- Buffer Time: Add 2-week buffers before key deliverables.
- Prioritisation: Use MoSCoW method (Must-have, Should-have, Could-have) to manage scope.
##### How would you measure the effectiveness of the risk management plan?
- Scheduled-On: Milestones and deliverables are met at satisfying level at the time planned.
- KPIs: Number of risks materialised vs. mitigated, adherence to budget/timeline.
- Retrospectives: Post-mortem analysis to refine future risk plans.
## Technical Lead
##### How would you ensure the technical aspects of the project are not impacted by potential risks? 
- Prototyping: Build a minimum viable product (MVP) early to validate tech stack.
- Documentation: Maintain API contracts and architecture diagrams to reduce knowledge silos.
##### What technical risks could impact the development of the application? 
- Performance Issues: App crashes under stress testing.
- Compatibility: iOS/Android fragmentation.
- Development Environment Failure: Environment Set-up issues
- Data Sync: Offline functionality failures.
##### How would you work with the risk manager and project manager to develop strategies to mitigate these risks? 
* To mitigate technical risks, testing is the only way imo.
- Work with Risk Manager to:
    - Stress Testing.
    - Use cross-platform frameworks (e.g., Flutter) to reduce compatibility risks.
- Advise Project Manager on realistic timelines for technical debt resolution.
##### How would you ensure the technical team is prepared to respond to potential risks?
- Plan-ahead: Pre-defined responses for critical failures (e.g., server downtime).
- Training: Workshops on security best practices (e.g., OWASP).
# Task 3: WBS and RBS
##### Why do we say WBS (Work Breakdown Structures) and RBS (Risk Breakdown Structures) are complementary in nature when identifying and managing risk?
Because they made each other complete in a way.
WBS and RBS categorises in a very similar way, the subtasks of WBS and the risk categories of RBS are exactly in the same genre: Technical, Non-technicals but more detailed like External, Operational, etc., so:
- **WBS** ensures you know **what to do**.
- **RBS** ensures you know **what could be disrupting it**.  
Together, they create a comprehensive and holistic view of project execution and risk preparedness.
To be more specific, their complementary is imposed by applicable tasks could be done in the project below:
1. Targeted Risk Identification: RBS risks are mapped to specific WBS components, avoiding generic or overlooked risks.
2. Efficient Mitigation Planning: Mitigation strategies are tied to concrete tasks (e.g., "Upgrade servers" for the "Outdated Infrastructure" risk).
3. Resource Allocation: High-risk WBS tasks (e.g., "Data Encryption") receive more budget/time buffers.
4. Monitoring & Control: Risks are tracked at the task level (e.g., "API Integration" delays trigger contingency plans).
# Task 4: WBS, RBS, and Risk Register
The artist part of me died out from my body, so I will just use a table to present WBS and RBS.
## WBS
| Level 1              | Level 2               | Level 3 Tasks            |
| -------------------- | --------------------- | ------------------------ |
| Business Integration | Stable Business Model | Revenue model validation |
|                      |                       | Legal compliance         |
|                      | Stakeholder Comm      | Monthly progress reports |
|                      |                       | Risk review meetings     |
| Frontend Dev         | UI/UX Design          | Lo-Fi Prototype          |
|                      |                       | Hi-Fi Prototype          |
|                      |                       | Accessibility Assessment |
|                      | User Features         | Workout tracking         |
|                      |                       | Dark mode/offline        |
| Backend & Database   | Data Security         | Encryption               |
|                      |                       | Penetration testing      |
|                      | API Development       | Payment Integration      |
|                      |                       | Fitness API              |
| Testing              | Functional Tests      | Unit tests               |
|                      |                       | Integration tests        |
|                      | User Validation       | Usability tests          |
|                      |                       | Beta testing             |
| Launch & Marketing   | Advertisement         | Social media             |
|                      |                       | Influencers              |
|                      | Customer Engagement   | Feedback surveys         |
|                      |                       | Loyalty program          |
## RBS
| Risk Category | Specific Risk     | Linked WBS Item     |
| ------------- | ----------------- | ------------------- |
| Technical     | Data breaches     | Data Security       |
|               | API downtime      | API Development     |
|               | Poor offline sync | User Features       |
| Project       | Scope creep       | Stakeholder Comm    |
|               | Legal delays      | Legal compliance    |
| Operational   | Low user adoption | Customer Engagement |
|               | Negative reviews  | User Validation     |
| External      | API cost overruns | Fitness API         |
## Risk Register

| ID     | Risk Description              | WBS Link          | Likelihood | Impact | Mitigation Strategy               | Owner           |
| ------ | ----------------------------- | ----------------- | ---------- | ------ | --------------------------------- | --------------- |
| TEC-1  | Outdated servers delay work   | 1.3 Backend Dev   | High       | High   | Allocate $20K for cloud migration | Tech Lead       |
| TEC-2  | Fitness API downtime          | 1.5.1 API Integ   | Medium     | High   | Develop mock API endpoints        | Dev Team        |
| PROJ-1 | Scope creep from stakeholders | 1.1.2 Scope Final | High       | Medium | Implement change control process  | Project Manager |
| OPS-1  | Poor UX reduces adoption      | 1.2 UI/UX Design  | Medium     | High   | Conduct 3 usability test cycles   | UX Designer     |