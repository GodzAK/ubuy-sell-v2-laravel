# UBuy & Sell

UBuy & Sell is a Laravel-powered marketplace for buying and selling items within
the University of Baguio community. It gives students and other approved users a
moderated place to publish second-hand items, discover available listings, and
contact sellers through Facebook.

## Purpose

The application is intended to make peer-to-peer campus transactions easier and
safer by:

- keeping listings in one searchable marketplace;
- requiring administrator approval for user accounts and item listings;
- showing useful item details such as category, price, condition/status, image,
  and seller contact information; and
- giving administrators a history of approved and rejected users and items.

## Features

### Marketplace

- Browse approved listings with pagination.
- Search by item name or description.
- Filter listings by category:
  `Clothes`, `Footwear`, `School Supplies`, `Books`, and `Others`.
- View item images, descriptions, prices, availability, and seller details.

### Accounts and sellers

- Register with a username, email address, password, and optional Facebook
  username/link.
- Log in with either username or email address.
- Require administrator approval before a regular user can access the
  marketplace.
- Add, edit, and delete personal listings.
- Mark a listing as `Available` or `Sold`.
- Update an account password.
- Receive a local notification when another user wants to contact you.

### Listing moderation

- New listings start as `Pending` and do not appear in the marketplace until
  approved.
- Administrators can approve or reject user registrations and item listings.
- Administrators can view the approval history for both users and items.
- Approved users can contact a seller through the seller's Facebook profile.

## Technology stack

- **Backend:** PHP 8.3+ and Laravel 13
- **Frontend:** Blade templates, Vite, Tailwind CSS, and the existing application
  CSS
- **Database:** MySQL by default, with SQLite also supported by Laravel
- **Storage:** Laravel's public filesystem disk for uploaded item images
- **Testing:** PHPUnit through Laravel's test runner

## Requirements

Install the following before setting up the project:

- PHP 8.3 or later
- Composer
- Node.js and npm
- MySQL/MariaDB, or SQLite for a local lightweight setup
- Git (optional, for cloning the repository)

## Installation

### 1. Get the project

```bash
git clone <repository-url>
cd ubuy-sell
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Create the environment file

On macOS/Linux:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the database

The included `.env.example` is configured for MySQL. Create a database named
`ubuy_sell`, then set the database values in `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ubuy_sell
DB_USERNAME=root
DB_PASSWORD=
```

For SQLite, create the database file and use this configuration instead:

```powershell
New-Item database\database.sqlite -ItemType File
```

```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

When using SQLite, remove or comment out the MySQL-specific `DB_HOST`,
`DB_PORT`, `DB_USERNAME`, and `DB_PASSWORD` values if they are not needed.

### 5. Run migrations and seed demo data

```bash
php artisan migrate --seed
```

The seeder creates a demo administrator, an approved seller, one approved item,
and one pending item. The demo credentials are:

| Account | Email | Password |
| --- | --- | --- |
| Administrator | `admin@ub.edu.ph` | `password` |
| Approved seller | `juan@ub.edu.ph` | `password` |

Change or remove these demo credentials before using the application in a
shared or production environment.

### 6. Configure public image storage

Item images are saved to the `public` disk. Create Laravel's storage link:

```bash
php artisan storage:link
```

### 7. Install and build frontend assets

```bash
npm install
npm run build
```

### 8. Start the application

In one terminal:

```bash
php artisan serve
```

Open <http://127.0.0.1:8000> in your browser.

For development with Vite hot reloading, use:

```bash
npm run dev
```

## Configuration

Important environment variables are listed in `.env.example`:

| Variable | Purpose |
| --- | --- |
| `APP_NAME` | Application name shown by Laravel and the UI |
| `APP_URL` | Base URL used for links and public image URLs |
| `APP_TIMEZONE` | Application timezone; the default is `Asia/Manila` |
| `APP_ENV` | Runtime environment, such as `local` or `production` |
| `APP_DEBUG` | Enables detailed errors during local development; disable in production |
| `DB_*` | Database connection settings |
| `FILESYSTEM_DISK` | Storage disk for uploaded item images; use `public` |
| `SESSION_DRIVER` | Session storage; the default uses the database |
| `CACHE_STORE` | Cache storage; the default uses the database |
| `QUEUE_CONNECTION` | Queue backend; the default uses the database |
| `MAIL_MAILER` | Mail transport; `log` is suitable for local development |

After changing configuration, clear cached values when necessary:

```bash
php artisan config:clear
php artisan cache:clear
```

## User workflow

1. A visitor registers an account.
2. An administrator approves or rejects the registration.
3. An approved user signs in and accesses the marketplace.
4. A seller creates an item listing with an image and item details.
5. An administrator approves or rejects the listing.
6. Approved listings become searchable in the marketplace.
7. An interested buyer opens the listing and contacts the seller through
   Facebook. The seller also receives an in-app notification.

Administrators can use the `/admin` area to manage pending users, pending items,
and approval history.

## Useful commands

```bash
# Run the application
php artisan serve

# List registered routes
php artisan route:list

# Run the test suite
php artisan test

# Format PHP files with Laravel Pint
vendor/bin/pint

# Rebuild frontend assets
npm run build
```

## Project structure

```text
app/
  Http/Controllers/       Application and admin request handlers
  Http/Requests/          Form validation rules
  Http/Middleware/        Authentication, approval, and admin gates
  Models/                 User, item, and notification models
  Policies/               Authorization rules for item actions
database/
  migrations/             Users, items, sessions, jobs, and notifications
  seeders/                Development/demo data
resources/views/          Blade pages for public, user, item, and admin screens
routes/web.php            Web routes and middleware groups
public/assets/            Application images, CSS, and JavaScript
storage/app/public/       Uploaded item images
```

## Testing

Run the existing PHPUnit suite with:

```bash
php artisan test
```

When adding or changing features, include coverage for authentication,
approval gates, item authorization, and marketplace filtering where applicable.

## Security notes

- Keep `.env` out of version control and use strong production credentials.
- Set `APP_DEBUG=false` in production.
- Use HTTPS in production.
- Replace the seeded demo passwords before deployment.
- Restrict administrator access to trusted accounts.
- Review uploaded image handling and filesystem permissions before exposing the
  application publicly.

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
