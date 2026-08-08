# Add Profile Management with Laravel DataTables

## Goal

Add a management page to the Laravel portfolio demo using the PHP package `yajra/laravel-datatables-oracle`. The page loads sample profile data through an AJAX route, then DataTables handles search, sort, pagination, and page length.

## What students will build

URLs:

```text
/manage/profiles
/manage/profiles/data
```

Files:

- `composer.json`
- `routes/web.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/partials/nav.blade.php`
- `resources/views/pages/manage-profiles.blade.php`

## Step 1: Install the PHP DataTables package

Run this in the Laravel project root:

```bash
composer require yajra/laravel-datatables-oracle
```

This package lets Laravel return data in the JSON format expected by jQuery DataTables.

Checkpoint:

- `composer.json` contains `yajra/laravel-datatables-oracle`.
- `composer.lock` contains `yajra/laravel-datatables-oracle`.

## Step 2: Add the page route and data route

File: `routes/web.php`
Action: Add the import at the top.

```php
use Yajra\DataTables\Facades\DataTables;
```

Action: Add these routes after the Contact route.

```php
Route::get('/manage/profiles', function () {
    return view('pages.manage-profiles');
})->name('manage.profiles');

Route::get('/manage/profiles/data', function () {
    $profiles = [
        [
            'id' => 1,
            'name' => 'Sok Dara',
            'role' => 'Frontend Developer',
            'email' => 'dara@example.com',
            'location' => 'Phnom Penh',
            'status' => 'Published',
        ],
        [
            'id' => 2,
            'name' => 'Chan Sopheak',
            'role' => 'UI Designer',
            'email' => 'sopheak@example.com',
            'location' => 'Siem Reap',
            'status' => 'Draft',
        ],
    ];

    return DataTables::of(collect($profiles))
        ->addColumn('status_badge', function ($profile) {
            $status = data_get($profile, 'status');
            $badgeClass = match ($status) {
                'Published' => 'bg-success',
                'Draft' => 'bg-warning text-dark',
                'Archived' => 'bg-secondary',
                default => 'bg-light text-dark',
            };

            return '<span class="badge '.$badgeClass.'">'.e($status).'</span>';
        })
        ->addColumn('actions', function ($profile) {
            return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Profile actions">
                    <a class="btn btn-outline-primary" href="#!">View</a>
                    <a class="btn btn-outline-secondary" href="#!">Edit</a>
                    <a class="btn btn-outline-danger" href="#!">Delete</a>
                </div>
            ';
        })
        ->rawColumns(['status_badge', 'actions'])
        ->make(true);
})->name('manage.profiles.data');
```

How it works:

- `/manage/profiles` returns the Blade page.
- `/manage/profiles/data` returns JSON for DataTables.
- `DataTables::of(collect($profiles))` converts the PHP sample array into a DataTables response.
- `rawColumns()` allows the badge and buttons to render as HTML.

## Step 3: Allow pages to add extra CSS

File: `resources/views/layouts/app.blade.php`
Action: Add this line after the main stylesheet.

```blade
@stack('styles')
```

This lets the management page load DataTables CSS without loading it on every page.

## Step 4: Add the Manage link

File: `resources/views/partials/nav.blade.php`
Action: Add this list item inside the navigation `<ul>`.

```blade
<li class="nav-item"><a class="nav-link" href="{{ route('manage.profiles') }}">Manage</a></li>
```

## Step 5: Create the management page

File: `resources/views/pages/manage-profiles.blade.php`
Action: Create this file.

```blade
@extends('layouts.app')

@section('title', 'Manage Profiles | Personal Portfolio')
@section('body_class', 'bg-light')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush

@section('content')
    <section class="py-5">
        <div class="container px-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="display-5 fw-bolder mb-1">
                        <span class="text-gradient d-inline">Profile Management</span>
                    </h1>
                    <p class="text-muted mb-0">Manage sample portfolio profiles with server-side Laravel DataTables.</p>
                </div>
                <a class="btn btn-primary px-4 py-3" href="#!">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add Profile
                </a>
            </div>

            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="table-responsive">
                        <table id="profilesTable" class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function () {
            $('#profilesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('manage.profiles.data') }}',
                pageLength: 5,
                lengthMenu: [5, 10, 25],
                order: [[0, 'asc']],
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'role', name: 'role' },
                    { data: 'email', name: 'email' },
                    { data: 'location', name: 'location' },
                    { data: 'status_badge', name: 'status' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-end' }
                ]
            });
        });
    </script>
@endpush
```

Important detail:

The `<tbody>` is empty because the rows come from AJAX:

```blade
<tbody></tbody>
```

## Step 6: Test

Run Laravel:

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000/manage/profiles
```

Expected result:

- The Manage page opens.
- DataTables sends an AJAX request to `/manage/profiles/data`.
- The table shows profile rows.
- Search, sort, page length, and pagination work.

You can also test the JSON route directly:

```text
http://127.0.0.1:8000/manage/profiles/data
```

## Common errors

### Class "Yajra\DataTables\Facades\DataTables" not found

The package is not installed. Run:

```bash
composer require yajra/laravel-datatables-oracle
```

### Route [manage.profiles.data] not defined

Check that the data route ends with:

```php
})->name('manage.profiles.data');
```

### DataTable shows "Ajax error"

Open this URL directly:

```text
http://127.0.0.1:8000/manage/profiles/data
```

If Laravel shows an error page, fix that backend error first.

### DataTable style or search box is missing

Check that your browser has internet access because this demo still loads jQuery and DataTables CSS/JS from CDN.
