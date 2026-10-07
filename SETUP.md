# Puihaha Electric Company CRUD + Login

This project is based on the `ci4_pagination` CodeIgniter 4 project.

## 1. Import the databases

In phpMyAdmin, import:

1. `electric_company (4)-2(1).sql` — customer records and the `customer_accounts` table.
2. `login_session.sql` — the separate `login_session` database and `user_accounts` table.

The project uses the `electric_company` connection for customer CRUD and the `login` connection group for the `login_session` database. If your MySQL username or password is different, edit `app/Config/Database.php` in both connection arrays.

## 2. Run the project

Put the project in the web server folder, make sure `writable/` is writable, and open the project URL. For a normal XAMPP setup, the URL is usually:

`http://localhost/ci4_pagination/public/`

## 3. Test login

- Username: `admin`
- Password: `admin123`

After login, the dashboard displays Puihaha Electric Company customer accounts. Use **Add Customer**, **View**, **Edit**, and **Delete** to test CRUD.

## 4. Important files changed

- `app/Controllers/Auth.php` — login and logout
- `app/Controllers/Home.php` — protected dashboard and CRUD methods
- `app/Models/UserModel.php` — reads users from the separate login database
- `app/Models/CustomerAccountModel.php` — reads customer accounts
- `app/Config/Database.php` — two database connections
- `app/Views/login.php`, `app/Views/home/index.php`, and `app/Views/home/form.php` — interface
