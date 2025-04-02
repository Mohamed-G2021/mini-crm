# Mini CRM Management System

## 🛠 Prerequisites
- PHP
- Laravel
- Composer
- MySQL
- Node.js & npm

## 🚀 Installation Steps

1. Clone the Repository
```bash
git clone git@github.com:Mohamed-G2021/mini-crm.git
cd mini-crm
```

2. Install PHP Dependencies
```bash
composer install
```

3. Install Node.js Dependencies
```bash
npm install
npm run build
```

4. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Setup Database
- Create a MySQL database
- Update `.env` with your database credentials (if needed)
```bash
php artisan migrate
php artisan db:seed
```

6. Start Development Server
```bash
php artisan serve
```

## 🔐 Default Credentials

### Admin
- Email: `admin@gmail.com`
- Password: `admin123`

## 📦 Features
- Employee Management
- Customer Management
- Role-based Access (Admin & Employee)
- Customer Action Logs (Call, Visit, Follow-up)