<?php

use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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
        [
            'id' => 3,
            'name' => 'Mony Ratha',
            'role' => 'Laravel Developer',
            'email' => 'ratha@example.com',
            'location' => 'Battambang',
            'status' => 'Published',
        ],
        [
            'id' => 4,
            'name' => 'Vanna Kim',
            'role' => 'Project Manager',
            'email' => 'vanna@example.com',
            'location' => 'Kampot',
            'status' => 'Archived',
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
