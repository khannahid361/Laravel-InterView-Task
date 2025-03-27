<p align="center"><a href="#" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Laravel Employee Management System

## 📌 Project Overview
This is a Laravel-based Employee Management System with advanced features such as salary tracking, event-driven architecture, and PDF report generation.

---

## 🚀 Features
- Organization CRUD operations
- Team CRUD operations
- Employee CRUD operations
- Salary updates with event-driven logging
- PDF report generation for employee data
- API authentication & security
- Optimized database queries with Eloquent
- Job queue for background tasks (email, reports)
- **Gmail SMTP Integration for Email Notifications**

---

## 📦 Installation Guide

### **Step 1: Clone the Repository**
```sh
git clone https://github.com/khannahid361/Laravel-InterView-Task.git
cd Laravel-InterView-Task
```
### **Step 2: Install Dependencies**
```sh
composer install
```
### **Step 3: Configure Environment**
Copy the .env.example file and rename it to .env:
```sh
cp .env.example .env
```
Now, generate the application key:
```sh
php artisan key:generate
```
### **Step 4: Set Up the Database**
Update the .env file with your database credentials:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_db
DB_USERNAME=root
DB_PASSWORD=
```
### **Step 5: Configure Gmail SMTP for Email Notifications**
Open your .env file and add/update the following Gmail SMTP settings:
```sh
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Employee Management System"
```
Important: You need to generate an App Password for Gmail.
- Go to Google Account → Security
- Enable 2-Step Verification
- Generate an App Password and use it in MAIL_PASSWORD

## **Unit and Feature Testing**
### 1. Setup for Testing
Run migrations for the test database:
```sh
php artisan migrate --env=testing
```
### **Feature Test**
Organization and Team based Report:
```sh 
php artisan test --filter ReportTest
```

### **Unit Test** 
1. Organization 
```sh
php artisan test --filter OrganizationTest
```
2. Team
```sh
php artisan test --filter TeamTest
```
3. Employee
```sh
php artisan test --filter EmployeeTest
```
4. Salary Update
- Update an Employee with changing the salary
- Check Laravel.log file

## **How to upload Employee json data ?**

### Step 1: Configure Queue Driver
- In your .env file, update:
```sh
QUEUE_CONNECTION=database
```
- Start the queue worker in another terminal:
```sh 
php artisan queue:work
```

### Step 2: Upload From Postman
- Body Part select form-data
- In key write file and select file
- Select the Employee json file from the project
If you want to create your own file please follow this structure
```sh 
[
    {
        "team_id": 1,
        "name": "John Doe",
        "start_date": "2021-01-01",
        "salary": 60000
    },
    {
        "team_id": 1,
        "name": "Jane Smith",
        "start_date": "2021-02-01",
        "salary": 65000
    },
    {
        "team_id": 1,
        "name": "Alice Brown",
        "start_date": "2021-03-01",
        "salary": 70000
    },
    {
        "team_id": 1,
        "name": "Bob Johnson",
        "start_date": "2021-04-01",
        "salary": 75000
    }
]
```
## ** API EndPoints**
🔑 Authentication
---
 <table>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
            <th>Middleware</th>
        </tr>
        <tr><td>POST</td><td>/auth/login</td><td>Login a user</td><td>None</td></tr>
        <tr><td>POST</td><td>/auth/logout</td><td>Logout authenticated user</td><td>None</td></tr>
    </table>

📊 Reports
---
<table>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
            <th>Middleware</th>
        </tr>
        <tr><td>GET</td><td>/report</td><td>Generate and view reports</td><td>None</td></tr>
        <tr><td>GET</td><td>/employee-report</td><td>Download employee report as PDF</td><td>None</td></tr>
    </table>

### 🔒 Protected Endpoints (auth:sanctum) <br>
All routes inside <b>/v1</b> require authentication.

👤 User 
---
<table>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
            <th>Middleware</th>
        </tr>
        <tr><td>GET</td><td>/v1/user</td><td>Get authenticated user details</td><td>auth:sanctum</td></tr>
    </table>

🏢 Organization Management
---
 <table>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
            <th>Middleware</th>
        </tr>
        <tr><td>GET</td><td>/v1/organization/</td><td>Get list of organizations</td><td>auth:sanctum</td></tr>
        <tr><td>POST</td><td>/v1/organization/store</td><td>Create a new organization</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/organization/update</td><td>Update organization details</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/organization/delete</td><td>Delete an organization</td><td>auth:sanctum, permission</td></tr>
    </table>

👥 Team Management
--- 
<table>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
            <th>Middleware</th>
        </tr>
        <tr><td>GET</td><td>/v1/team/</td><td>Get list of teams</td><td>auth:sanctum</td></tr>
        <tr><td>POST</td><td>/v1/team/store</td><td>Create a new team</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/team/update</td><td>Update team details</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/team/delete</td><td>Delete a team</td><td>auth:sanctum, permission</td></tr>
    </table>

🧑 Employee Management
---
<table>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
            <th>Middleware</th>
        </tr>
        <tr><td>GET</td><td>/v1/employee/</td><td>Get list of employees</td><td>auth:sanctum</td></tr>
        <tr><td>POST</td><td>/v1/employee/store</td><td>Create a new employee</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/employee/update</td><td>Update employee details</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/employee/delete</td><td>Delete an employee</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/employee/import</td><td>Import employees from JSON</td><td>auth:sanctum, permission</td></tr>
        <tr><td>POST</td><td>/v1/employee/filter</td><td>Filterig employees based on their starting date</td><td>auth:sanctum, permission</td></tr>
    </table>

🔄 Employee Import
---
<table>
        <tr>
            <th>Method</th>
            <th>Endpoint</th>
            <th>Description</th>
            <th>Middleware</th>
        </tr>
        <tr><td>POST</td><td>/v1/employee/import</td><td>Upload & import employees from JSON file</td><td>auth:sanctum, permission</td></tr>
    </table>

## Perfomance Report
Perfomance Report Is Added as a Readme file **PerfomanceReport.md**

## **Telescope** 
Visit http://127.0.0.1:8000/telescope/queries for checking queries
