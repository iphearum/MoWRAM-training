# Build a Static Portfolio Layout in Laravel Blade

## Goal

Build a Laravel demo app from the existing `staticWeb` portfolio template. Students will learn how to split a static HTML website into:

1. one main Blade layout
2. shared partials for navigation and footer
3. separate pages for Home, Resume, Projects, and Contact
4. public CSS, JavaScript, and image assets

## What students will build

Routes:

- `/`
- `/resume`
- `/projects`
- `/contact`

Blade files:

- `resources/views/layouts/app.blade.php`
- `resources/views/partials/nav.blade.php`
- `resources/views/partials/footer.blade.php`
- `resources/views/pages/home.blade.php`
- `resources/views/pages/resume.blade.php`
- `resources/views/pages/projects.blade.php`
- `resources/views/pages/contact.blade.php`

## Prerequisites

Students need:

- PHP installed
- Composer installed
- Node.js and npm installed
- a fresh Laravel project

## Step 1: Create or open a Laravel project

Run this only if you do not already have a Laravel project.

```bash
composer create-project laravel/laravel portfolio-demo
cd portfolio-demo
```

If your teacher already gave you a project, open that project folder instead.

## Step 2: Copy the static assets

The original static site keeps assets in:

- `staticWeb/css/styles.css`
- `staticWeb/js/scripts.js`
- `staticWeb/assets/favicon.ico`
- `staticWeb/assets/profile.png`

In Laravel, browser-accessible files go inside `public`.

Create these folders:

```bash
mkdir -p public/css public/js public/assets
```

Copy the files:

```bash
cp ../staticWeb/css/styles.css public/css/styles.css
cp ../staticWeb/js/scripts.js public/js/scripts.js
cp ../staticWeb/assets/favicon.ico public/assets/favicon.ico
cp ../staticWeb/assets/profile.png public/assets/profile.png
```

Checkpoint:

- `public/css/styles.css` exists
- `public/js/scripts.js` exists
- `public/assets/profile.png` exists

## Step 3: Create the main layout

The layout contains the HTML document structure used by every page.

File: `resources/views/layouts/app.blade.php`
Action: Create this file.

```blade
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="@yield('description', 'Personal portfolio demo built with Laravel Blade')" />
        <meta name="author" content="@yield('author', 'Laravel Student')" />
        <title>@yield('title', 'Personal Portfolio')</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100 @yield('body_class')">
        <main class="flex-shrink-0">
            @include('partials.nav')
            @yield('content')
        </main>

        @include('partials.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        @stack('scripts')
    </body>
</html>
```

Important Blade syntax:

- `@yield('content')` means each page can insert its own content.
- `@include('partials.nav')` loads a shared file.
- `asset('css/styles.css')` creates the correct URL for files inside `public`.

## Step 4: Create the navigation partial

File: `resources/views/partials/nav.blade.php`
Action: Create this file.

```blade
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container px-5">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="fw-bolder text-primary">Start Bootstrap</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('resume') }}">Resume</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('projects') }}">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
```

The static template used links like `index.html`. In Laravel, use route names like `route('home')`.

## Step 5: Create the footer partial

File: `resources/views/partials/footer.blade.php`
Action: Create this file.

```blade
<footer class="bg-white py-4 mt-auto">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <div class="small m-0">Copyright &copy; Your Website 2023</div>
            </div>
            <div class="col-auto">
                <a class="small" href="#!">Privacy</a>
                <span class="mx-1">&middot;</span>
                <a class="small" href="#!">Terms</a>
                <span class="mx-1">&middot;</span>
                <a class="small" href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </div>
</footer>
```

## Step 6: Create the Home page

File: `resources/views/pages/home.blade.php`
Action: Create this file.

```blade
@extends('layouts.app')

@section('title', 'Home | Personal Portfolio')

@section('content')
    <header class="py-5">
        <div class="container px-5 pb-5">
            <div class="row gx-5 align-items-center">
                <div class="col-xxl-5">
                    <div class="text-center text-xxl-start">
                        <div class="badge bg-gradient-primary-to-secondary text-white mb-4">
                            <div class="text-uppercase">Design &middot; Development &middot; Marketing</div>
                        </div>
                        <div class="fs-3 fw-light text-muted">I can help your business to</div>
                        <h1 class="display-3 fw-bolder mb-5">
                            <span class="text-gradient d-inline">Get online and grow fast</span>
                        </h1>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                            <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="{{ route('resume') }}">Resume</a>
                            <a class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder" href="{{ route('projects') }}">Projects</a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7">
                    <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                        <div class="profile bg-gradient-primary-to-secondary">
                            <img class="profile-img" src="{{ asset('assets/profile.png') }}" alt="Profile photo" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="bg-light py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xxl-8">
                    <div class="text-center my-5">
                        <h2 class="display-5 fw-bolder">
                            <span class="text-gradient d-inline">About Me</span>
                        </h2>
                        <p class="lead fw-light mb-4">My name is Start Bootstrap and I help brands grow.</p>
                        <p class="text-muted">This Laravel demo converts the original static HTML portfolio into reusable Blade layout, page, and partial files.</p>
                        <div class="d-flex justify-content-center fs-2 gap-4">
                            <a class="text-gradient" href="#!"><i class="bi bi-twitter"></i></a>
                            <a class="text-gradient" href="#!"><i class="bi bi-linkedin"></i></a>
                            <a class="text-gradient" href="#!"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
```

## Step 7: Create the routes

File: `routes/web.php`
Action: Replace the file content.

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/resume', function () {
    return view('pages.resume');
})->name('resume');

Route::get('/projects', function () {
    return view('pages.projects');
})->name('projects');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
```

Checkpoint:

- `/` should show the Home page.
- `/resume`, `/projects`, and `/contact` will work after you create those page files.

## Step 8: Create the other page files

Create these files using the teacher demo as reference:

- `resources/views/pages/resume.blade.php`
- `resources/views/pages/projects.blade.php`
- `resources/views/pages/contact.blade.php`

Each page starts with:

```blade
@extends('layouts.app')

@section('title', 'Page Name | Personal Portfolio')

@section('content')
    <!-- Page HTML goes here -->
@endsection
```

For pages with a gray body background, add:

```blade
@section('body_class', 'bg-light')
```

## Step 9: Run the Laravel app

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

Also test:

```text
http://127.0.0.1:8000/resume
http://127.0.0.1:8000/projects
http://127.0.0.1:8000/contact
```

## Common errors and fixes

### Error: Route [home] not defined

Check that `routes/web.php` contains:

```php
})->name('home');
```

### Error: View [partials.nav] not found

Check that the file exists:

```text
resources/views/partials/nav.blade.php
```

### CSS is not loading

Check that this file exists:

```text
public/css/styles.css
```

Check that the layout uses:

```blade
<link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
```

### Profile image is missing

Check that this file exists:

```text
public/assets/profile.png
```

Check that the image uses:

```blade
<img class="profile-img" src="{{ asset('assets/profile.png') }}" alt="Profile photo" />
```

## Optional challenge

Improve the navigation by highlighting the current page.

Example:

```blade
<a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
```
