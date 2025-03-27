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