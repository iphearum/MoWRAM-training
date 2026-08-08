# Laravel Portfolio Demo

A teaching project that turns a static portfolio template into reusable Laravel Blade views. It also includes a profile-management example powered by server-side [Yajra DataTables](https://yajrabox.com/docs/laravel-datatables).

## Features

- Shared Blade layout, navigation, and footer partials
- Home, resume, projects, and contact pages
- Responsive Bootstrap-based portfolio design
- Profile management table with AJAX loading, search, sorting, and pagination
- Status badges and example action buttons rendered by Laravel
- SQLite configuration for a lightweight local setup

> [!NOTE]
> The profiles are currently a hard-coded teaching dataset in `routes/web.php`. The Add, View, Edit, and Delete controls are visual placeholders and do not persist data.

## Requirements

- PHP 8.3 or newer
- Composer
- Node.js and npm
- SQLite PHP extension

Internet access is also needed in the browser because Bootstrap, Bootstrap Icons, jQuery, DataTables, and Google Fonts are loaded from CDNs.

## Installation

Clone the repository, enter the project directory, and run:

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install
npm run build
```

On Windows PowerShell, replace the `cp` and `touch` commands with:

```powershell
Copy-Item .env.example .env
New-Item database/database.sqlite -ItemType File
```

Start the application:

```bash
php artisan serve
```

Then open <http://127.0.0.1:8000>.

For the combined development server, queue worker, log viewer, and Vite watcher, use:

```bash
composer run dev
```

## Application routes

| URL | Route name | Purpose |
| --- | --- | --- |
| `/` | `home` | Portfolio landing page |
| `/resume` | `resume` | Experience and education |
| `/projects` | `projects` | Example project cards |
| `/contact` | `contact` | Contact form layout |
| `/manage/profiles` | `manage.profiles` | DataTables management screen |
| `/manage/profiles/data` | `manage.profiles.data` | JSON endpoint used by DataTables |

## Project structure

```text
routes/web.php                         Page routes and sample profile data
resources/views/layouts/app.blade.php Shared HTML layout
resources/views/partials/              Navigation and footer
resources/views/pages/                 Portfolio and management pages
public/css/styles.css                  Portfolio theme styles
public/js/scripts.js                   Theme JavaScript
public/assets/                         Images and favicon
docs/                                  Step-by-step classroom guides
```

## Learning guides

- [Build a static portfolio with Blade](docs/build-static-portfolio-with-blade.md)
- [Add profile management with DataTables](docs/add-profile-management-datatable.md)
- [Printable Blade portfolio guide](docs/build-static-portfolio-with-blade.pdf)

## Useful commands

```bash
# Run the test suite
composer test

# Format PHP code
vendor/bin/pint

# List application routes
php artisan route:list --except-vendor

# Rebuild front-end assets
npm run build
```

## Customizing the demo

- Edit portfolio content in `resources/views/pages`.
- Change the shared header and footer in `resources/views/partials`.
- Update the theme in `public/css/styles.css`.
- Replace `public/assets/profile.png` with a different profile image.
- Replace the sample array in `routes/web.php` with an Eloquent query when introducing database-backed profiles.

## License

This project uses the open-source Laravel framework, which is licensed under the [MIT License](https://opensource.org/licenses/MIT).
