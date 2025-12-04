## Employee Management System

This is a simple web application that helps companies manage employees and job applications. It was built using Laravel (backend), Vue.js (frontend), and Inertia.js to connect them.

### What Can You Do?

1. **Apply for a Job** - Anyone can visit `/apply` and submit their name, email, phone number, and CV
2. **Login & Register** - Create an account or login to access protected features
3. **Manage Employees** - Add, edit, or delete employees (only logged-in users can do this)
4. **Review Applications** - Admin can see all job applications and approve or reject them
5. **Send Rejection Emails** - When an application is rejected, an automatic email is sent to the applicant

### How to Install & Run

#### Step 1: Install Required Software
You need:
- PHP 8.2 or higher
- Composer (for PHP packages)
- Node.js & npm (for JavaScript packages)

#### Step 2: Setup the Project
Open PowerShell and run these commands one by one:

```powershell
# Go to your project folder
cd "c:/Users/Siam/Desktop/Employee Management/employee-management"

# Install all PHP packages
composer install

# Copy the example environment file
cp .env.example .env

# Generate a security key
php artisan key:generate

# Install all JavaScript packages
npm install
```

#### Step 3: Setup the Database
```powershell
# Create the database file (SQLite - no MySQL needed!)
php artisan migrate

# Link the storage folder (for file uploads)
php artisan storage:link
```

#### Step 4: Run the Application
Open two separate PowerShell windows:

**Window 1 - Start the Web Server:**
```powershell
cd "c:/Users/Siam/Desktop/Employee Management/employee-management"
php artisan serve --host=127.0.0.1 --port=8000
```

**Window 2 - Start the Asset Server (Vite):**
```powershell
cd "c:/Users/Siam/Desktop/Employee Management/employee-management"
npm run dev
```

#### Step 5: Open in Your Browser
Visit: **http://127.0.0.1:8000**

### How to Test It

1. **Submit an application:** Go to `http://127.0.0.1:8000/apply` (no login needed)
2. **Create an account:** Click "Register" at the top
3. **Login:** Use your email and password
4. **View employees:** Click on "Employees" menu (if visible)
5. **Review applications:** Go to `http://127.0.0.1:8000/admin/applications` to see submitted applications
6. **Approve or Reject:** Click on an application and choose Approve or Reject

### Default Test Account
If you run the seeder, you can login with:
- **Email:** `test@example.com`
- **Password:** `password`

### Where Are My Files?

- **Uploaded CVs** → `storage/app/public/cvs/` folder
- **Database** → `database/database.sqlite` file
- **Application code** → `app/` folder
- **Web pages** → `resources/js/Pages/` folder

