# 🗳️ Blockchain-Based E-Voting System

A secure and transparent Blockchain-Based E-Voting System developed as a Final Year B.Tech Project.

The system provides secure voter authentication using WhatsApp OTP verification, role-based login (Voter, Candidate, Administrator), blockchain-backed vote recording, and real-time election result generation.

---

## 🚀 Features

- Secure Voter Registration
- Administrator Approval System
- Candidate Registration
- WhatsApp OTP Authentication (Twilio API)
- Blockchain-Based Vote Storage
- Real-Time Election Results
- Role-Based Login
  - Voter
  - Candidate
  - Administrator
- Voter Statistics Dashboard
- Candidate Management
- Election Result Analysis

---

## 🛠 Technologies Used

### Frontend

- React.js
- HTML5
- CSS3
- JavaScript

### Backend

- PHP
- Composer
- Twilio PHP SDK

### Database

- MySQL (MariaDB)

### Other

- Blockchain (Custom Implementation)
- WhatsApp OTP (Twilio Sandbox)

---

# Project Structure

```
E_Voting/

│
├── frontend/
│   ├── public/
│   ├── src/
│   ├── package.json
│   └── ...
│
├── backend/
│   ├── vendor/
│   ├── composer.json
│   ├── db.php
│   ├── cors.php
│   ├── twilio.php
│   ├── ...
│
├── database/
│   └── e_voting.sql
│
└── README.md
```

---

# Installation

## 1. Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/E_Voting.git
```

---

## 2. Backend Setup

Move the backend folder inside your web server.

Example (XAMPP):

```
xampp/htdocs/evoting
```

Install Composer dependencies:

```bash
composer install
```

---

## 3. Database Setup

Open phpMyAdmin.

Create a database named:

```
e_voting
```

Import

```
database/e_voting.sql
```

---

## 4. Configuration

Create a file named

```
config.php
```

using

```
config.example.php
```

Update:

- Database Credentials
- Twilio Account SID
- Twilio Auth Token
- Twilio WhatsApp Number

---

## 5. Frontend Setup

Navigate to frontend folder.

Install dependencies

```bash
npm install
```

Start development server

```bash
npm start
```

---

# Default URLs

Frontend

```
http://localhost:3000
```

Backend

```
http://localhost/evoting
```

phpMyAdmin

```
http://localhost/phpmyadmin
```

---

# Twilio Setup

This project uses the Twilio WhatsApp Sandbox.

Before requesting an OTP, the user must send

```
join language-prepare
```

to

```
+1 415 523 8886
```

After joining, OTP messages can be received via WhatsApp.

---

# Security Notes

The following files are intentionally excluded from GitHub:

```
config.php
vendor/
node_modules/
```

Create your own `config.php` using `config.example.php`.

---

# Future Enhancements

- QR Code Based Verification
- Face Authentication
- Email Notifications
- Multi-Factor Authentication
- Digital Signature Integration
- Cloud Deployment
- Production WhatsApp API

---

# Author

**Sounok**

Final Year B.Tech Project

Department of Computer Science & Engineering

---

# License

This project is developed for academic and educational purposes.
