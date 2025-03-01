# Student_Information_System
PHP Project

# Introduction

This is a PHP project that can be run locally using XAMPP. It requires a database to function properly. This README provides instructions for setting up and running the project.

# Prerequisites

- **XAMPP**: Make sure you have XAMPP installed on your machine. You can download it from [Apache Friends](https://www.apachefriends.org/index.html).
- **PHP**: This project requires PHP to be set up within XAMPP.
- **Database**: A MySQL database is required to store and manage project data.
                You can see the database needed in the folder database/icstitde_mis.sql.

# Installation

1. **Clone the Repository**:
   Open your terminal and run the following command to clone the project:
   ```bash
   git clone https://github.com/marissa-098/Student_Information_System.git

2.**Move Project to XAMPP Directory:**
Move the project folder to the XAMPP htdocs directory. By default, it is located at:
C:\xampp\htdocs\

3. **Set Up the Database:**
    >> Open XAMPP Control Panel and start the Apache and MySQL services.
    >> Open your web browser and navigate to http://localhost/phpmyadmin.
    >> Create a new database for the project. You can name it student_information_system.
**Import the database schema:**
   >> Go to the "Import" tab in phpMyAdmin.
   >> Select the SQL file located in the database folder of your project.
   >> Click "Go" to import the database.
>>
4. **Configuration:
>> Update any configuration files as necessary (e.g., database connection settings).
Ensure that all required dependencies are present.

>> **Running the Project**
Open your web browser and navigate to:
http://localhost/Student_Information_System
Replace Student_Information_System with the folder name if you renamed it.

## Usage
This project is a Student Information System.

**Student Login:**
Once logged in, students can view all their information.
      Login Credentials:
      **Student No:** 20-09363
      **Password:** Marissa

**Admin Login:**
The admin side is located at:
http://localhost/Student_Information_System/admin/

The admin can manage all student records, including schedules, grades, and account inquiries.
      Login Credentials:
      **Username:** admin
      **Password:** admin123








*************************************************************
Contact
For any inquiries, please contact:

Name: Marissa Manrique
Email: marissamanrique098@gmail.com
