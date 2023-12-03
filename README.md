## Computational Thinking Test Ranking System - CTT RS
The Computational Thinking Test Ranking System (CTT RS) is an automated solution designed to streamline the process of ranking students based on their academic performance, particularly their 12th-grade marks. This system eliminates the need for manual ranking using Excel spreadsheets and offers real-time access to individual student ranks. Its primary goal is to enhance the accuracy and efficiency of the ranking process while empowering students by providing transparent and timely access to their performance ranks. The CTT RS plays a crucial role in shaping academic and professional opportunities for students, making it an essential tool for educational institutions.

## System Architecture
System architecture is the conceptual structure and organization of a computer-based system. It involves defining the system's components or modules, their relationships, and the principles guiding their design and evolution. System architecture provides a blueprint for the system's construction, ensuring that it meets its functional and non-functional requirements.

 The CTT RS is a three tier architecture system. In three tier architecture, the system is divided into 3 major components/ tiers as listed below:

1. Presentation Tier (User Interface):
Responsible for user interaction and displaying information; it includes interfaces like web browsers, mobile apps, and presentation logic.

2. Application Tier (Logic/Processing):
Implements business logic, processes user requests, and acts as a bridge between the presentation tier and the data tier; it consists of server-side applications and business logic modules.

3. Data Tier (Storage/Database):
Manages data storage, retrieval, and integrity; stores and retrieves data for the application, typically using database systems like MySQL or MongoDB.

## System Description
The Computational Thinking Test Ranking System (CTT RS) is an automated platform designed to facilitate the efficient shortlisting process for GCIT's class 12 passouts applying for the GCIT CTT. The administration (admin) oversees the system, with designated managers responsible for managing the CTT RS process.

Managers are empowered to streamline the process by uploading either CSV or Excel files containing comprehensive information about class 12 passouts, such as index numbers, marks, etc. The system eliminates the need for managers to define eligibility and ranking criteria, as preset values are in place. However, managers can modify these values if necessary. Additionally, the system allows managers to set the registration period for CTT, during which students can register.

The managers play a crucial role in adding CTT placement venues where shortlisted students can make their selections. The system automates the ranking of students upon registration, ensuring that only eligible and interested students appear on the manager's rank dashboard.

Key features for managers include the ability to download uploaded files with additional information, including student’s eligibility and rank. Managers can download result files in CSV format and have the option to archive uploaded files with results.

The system incorporates a robust authentication process for both administrators and managers, requiring login credentials associated with GCIT email addresses. Additionally, a password recovery mechanism is in place to assist in case of forgotten passwords.

Once the manager uploads class 12 passout details, students gain the ability to register for CTT during the registration period set by the manager. Students can select the specific course they wish to apply for, such as SOC or SIDD, or both. The system offers an authentication mechanism for students, allowing them to view their details and CTT information using their class 12 index number and date of birth. Students can check their CTT rank and status, choose a test venue, and update their contact number for communication purposes.

## Live Site
https://cttrs.y4csg3.serv00.net/
