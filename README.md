# Interactive PHP & MySQL Login System

A modern, responsive Login and Signup interface featuring a sliding overlay animation. This project uses PHP for backend logic and MySQL for user data management.

## 🚀 Features
* **Sliding Animation:** Seamless transition between Login and Signup forms using CSS3 and JavaScript.
* **Secure Authentication:** Passwords are encrypted using `password_hash()` and verified via `password_verify()`.
* **Database Integration:** Connects to a MySQL database to store and retrieve user credentials.
* **Session Management:** Restricts access to the dashboard (`home.php`) unless the user is logged in.

## 🛠️ Technologies Used
* **Frontend:** HTML5, CSS3 (Montserrat Font), JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Icons:** Font Awesome

## 📋 Prerequisites
Before running this project, ensure you have:
1. **XAMPP** or **WAMP** installed.
2. A database named `daraz`.
3. A table named `signup` with the following structure:

| Column   | Type         | Extra          |
|----------|--------------|----------------|
| UID      | INT          | Primary Key, AI|
| username | VARCHAR(50)  |                |
| email    | VARCHAR(100) | Unique         |
| password | VARCHAR(255) |                |

## 🔧 Installation
1. Clone the repository to your `htdocs` folder.
2. Import the database structure.
3. Update `db.php` with your local database credentials (username, password).
4. Open `localhost/your-project-folder/index.php` in your browser.

---
Designed with ❤️ by [Rafay x Rage]
