# 💰 OneStack Expense Tracker

> A robust, full-featured Expense Tracker application built with **CodeIgniter 3** and **Bootstrap 5**.

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-v3-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-DB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

---

## 📋 Project Overview

It is a complete web application designed to help users track their daily expenses efficiently. It follows the strict **MVC (Model-View-Controller)** architecture and includes advanced features like data visualization, authentication, and reporting.

### ✨ Key Features

- **🔐 User Authentication**: Secure Signup & Login system using Bcrypt password hashing.
- **📊 Interactive Dashboard**: Real-time summary cards and a dynamic **Doughnut Chart** (Chart.js) visualizing spending by category.
- **📝 CRUD Operations**: Create, Read, Update, and Delete expenses seamlessly.
- **📅 Smart Filtering**: Filter expenses by **Today**, **This Month**, or **This Year** with a single click.
- **📂 CSV Export**: Built-in functionality to download expense reports as CSV files.
- **🎨 Modern UI**: Fully responsive interface built with **Bootstrap 5** and **FontAwesome** icons.

---

## 🛠️ Tech Stack

| Component     | Technology                        |
| :------------ | :-------------------------------- |
| **Framework** | CodeIgniter 3 (PHP MVC)           |
| **Database**  | MySQL                             |
| **Frontend**  | HTML5, CSS3, Bootstrap 5          |
| **Scripting** | JavaScript, Chart.js, SweetAlert2 |
| **Server**    | XAMPP (Apache)                    |

---

## 🚀 Installation & Setup

Follow these steps to run the project locally.

### 1. Prerequisite

Ensure you have **XAMPP** (or WAMP/MAMP) installed with PHP and MySQL running.

### 2. File Setup

1.  Download or Clone this repository.
2.  Move the `expense_tracker` folder into your XAMPP `htdocs` directory:
    ```
    C:\xampp\htdocs\expense_tracker\
    ```

### 3. Database Setup

1.  Open **phpMyAdmin** (usually `http://localhost/phpmyadmin`).
2.  Create a new database named: `expense_tracker`.
3.  Click **Import** and select the file `database_dump.sql` located in the root of this project.

### 4. Configuration

The database configuration is located in `application/config/database.php`.

- **Hostname:** `localhost:3307` (Update this if your MySQL runs on port 3306)
- **Username:** `root`
- **Password:** _(Empty by default)_
- **Database:** `expense_tracker`

> **Note:** If you are using PHP 8.2+, this project includes a specific fix in `index.php` to suppress Deprecation Warnings common with CodeIgniter 3.

---

## 🔑 Test Credentials

You can use the following credentials to log in and test the application immediately:

| Role     | Email             | Password     |
| :------- | :---------------- | :----------- |
| **User** | `testing@csv.com` | ` test@1234` |

_(Alternatively, you can create a new account via the Registration page)._

---

## 📂 Project Structure (MVC)

```text
expense_tracker/
├── application/
│   ├── config/              # Database & Routes configuration
│   ├── controllers/
│   │   ├── Auth.php         # Handles Login/Signup
│   │   └── Expenses.php     # Handles CRUD & Charts
│   ├── models/
│   │   ├── User_model.php   # Database logic for Users
│   │   └── Expense_model.php# Database logic for Expenses
│   └── views/
│       ├── auth/            # Login & Register HTML
│       └── expenses/        # Dashboard, Add, Edit HTML
├── database_dump.sql        # SQL Import File
└── index.php                # Entry point
```
