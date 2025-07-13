# 💳 Digital Wallet System

The **Digital Wallet System** is a secure, web-based financial application that enables users to perform digital transactions such as adding funds, making payments, and viewing transaction history. Built using **PHP**, **MySQL**, **HTML**, and **CSS**, it is designed to promote a cashless economy with real-time balance tracking and secure authentication.

---

## 🚀 Features

- ✅ User Registration & Secure Login
- 💼 Dashboard showing wallet balance
- ➕ Add Funds to wallet
- 💸 Make Payments
- 📜 View Transaction History
- 🔐 Session-based Authentication
- 🎨 Responsive UI with Light Pink, Hot Pink & Maroon theme

---

## 🧱 Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript  
- **Backend**: PHP  
- **Database**: MySQL  
- **Server**: XAMPP (Apache + MySQL)

---

## 📁 Folder Structure

digitalwallet/
├── register.php
├── login.php
├── dashboard.php
├── add_funds.php
├── make_payment.php
├── transactions.php
├── logout.php
├── index.php (optional homepage)
├── db_connect.php
├── css/
│ └── style.css
└── sql/
└── digitalwallet.sql

markdown
Copy
Edit

---

## ⚙️ Installation & Setup

1. Install [XAMPP](https://www.apachefriends.org/index.html) and run **Apache** and **MySQL**.
2. Place the `digitalwallet` folder in `C:\xampp\htdocs\`.
3. Open **phpMyAdmin**: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
4. Create a database:  
   ```sql
   CREATE DATABASE digitalwallet;
Import or run SQL to create tables users and transactions.

Visit the project in browser:
👉 http://localhost/digitalwallet/login.php

🛠️ SQL Table Structure
Users Table
sql
Copy
Edit
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  balance DECIMAL(10,2) DEFAULT 0.00
);
Transactions Table
sql
Copy
Edit
CREATE TABLE transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  type ENUM('credit', 'debit'),
  amount DECIMAL(10,2),
  method VARCHAR(50),
  timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
📌 Important URLs
🔐 Login: http://localhost/digitalwallet/login.php

📝 Register: http://localhost/digitalwallet/register.php

🏠 Dashboard: http://localhost/digitalwallet/dashboard.php

💰 Add Funds: http://localhost/digitalwallet/add_funds.php

💳 Make Payment: http://localhost/digitalwallet/make_payment.php

📂 Transactions: http://localhost/digitalwallet/transactions.php

