# Avipro Travels - Tourism Management System

## ⚠️ Important: Requirement for XAMPP

**⚠️  Sir, we have built this project using XAMPP, we request you to please install XAMPP ⚠️  and run this project.  ⚠️**

### What happens if you don't use XAMPP?
If you try to open the `.php` files directly (e.g., `file:///C:/Users/.../index.php`):
1.  **Code Display Error**: The browser will display the raw PHP code instead of the webpage.
2.  **Database Error**: You will encounter `Fatal error: Uncaught Error: Call to undefined function mysqli_connect()` because there is no database connection.

---

## 🚀 Installation & Setup Guide

### Step 1: Install XAMPP
1.  Download XAMPP from [apachefriends.org](https://www.apachefriends.org/index.html).
2.  Install it and launch the **XAMPP Control Panel**.
3.  Click **Start** next to **Apache** and **MySQL**.

### Step 2: Setup Project Files
1.  Copy the `avipro_travels` folder.
2.  Navigate to your XAMPP installation directory (usually `C:\xampp`).
3.  Open the `htdocs` folder.
4.  Paste the `avipro_travels` folder here.
   - Path should be: `C:\xampp\htdocs\avipro_travels\`

### Step 3: Setup Database
1.  Open your browser and go to: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2.  Click **New** on the left sidebar.
3.  Create a database named: `avipro_travels`
4.  Click on the `avipro_travels` database to select it.
5.  Click the **Import** tab at the top.
6.  Choose the `avipro_travels.sql` file from the project folder and click **Import** at the bottom.
   - *Note: If the SQL file is missing, you can initialize the database by running the setup scripts in Step 4.*

### Step 4: Final Configuration
1.  Open your browser and visit: [http://localhost/avipro_travels/](http://localhost/avipro_travels/)
2.  **Critical**: To ensure all features (like Login, Cancellation) work, please run the following update scripts in your browser once:
    - [http://localhost/avipro_travels/install_data.php](http://localhost/avipro_travels/install_data.php) (Base Data)
    - [http://localhost/avipro_travels/update_schema.php](http://localhost/avipro_travels/update_schema.php) (Customer Tables)
    - [http://localhost/avipro_travels/update_schema_status.php](http://localhost/avipro_travels/update_schema_status.php) (Booking Status)
    - [http://localhost/avipro_travels/update_schema_reset.php](http://localhost/avipro_travels/update_schema_reset.php) (Password Reset)
    - [http://localhost/avipro_travels/update_schema_secret.php](http://localhost/avipro_travels/update_schema_secret.php) (Secret Key)

---

## 🌐 How to Run
- **Website Home**: [http://localhost/avipro_travels/](http://localhost/avipro_travels/)
- **Admin Panel**: [http://localhost/avipro_travels/admin/](http://localhost/avipro_travels/admin/)

### Admin Credentials
- **Username**: `admin`
- **Password**: `password123`

---

## ✨ Features
- **Customer Portal**: Sign up, Login, Profile Management, Booking History.
- **Booking System**: Users can book packages; Admins can view and manage bookings.
- **Cancellation**: Both Admins and Customers can cancel bookings.
- **Password Recovery**: Secret Key based password reset system.
- **Admin Dashboard**: Manage packages, bookings, and site content.
