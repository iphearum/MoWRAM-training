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
