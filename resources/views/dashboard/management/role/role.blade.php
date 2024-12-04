@extends('layouts.dashboardmaster')
@section('title')
Exists & User Role Management's  Page
@endsection
@section('contant')
<x-breadcum  tanvir="Exists & User Role Management's  Page"></x-breadcum>
<div class="col-lg-12 ">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Exists & User Role Management</h4>

<form role="form" action="{{ route('role_assing_session') }}" method="POST">
    @csrf

    <div class="row mb-2">
        <label for="inputPassword5" class="col-sm-3 col-form-label">Manage User</label>
        <div class="col-sm-9">
            <select class="form-select border-info-subtle" name="user_id">
                <option value="">select roles</option>
               @foreach ($manage as $user)
               <option value="{{ $user->id }}">{{ $user->name }}</option>
               @endforeach
            </select>
            @error('role')
                <p class="text-danger mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="row mb-2">
        <label for="inputPassword5" class="col-sm-3 col-form-label ">Role</label>
        <div class="col-sm-9">
            <select class="form-select border-info-subtle" name="role">
                <option value="">select roles</option>
                <option value="manager">Manager</option>
                <option value="blogger">Blogger</option>
                <option value="user">User</option>
            </select>
            @error('role')
                <p class="text-danger mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="justify-content-end row">
        <div class="col-sm-9">
            <button type="submit" class="btn btn-info waves-effect waves-light col-12">Sign In</button>
        </div>
    </div>
</form>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">User's Table</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manage as $user)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        <p class="fw-normal mb-1">{{ $user->name }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1">{{ $user->role }}</p>
                                    </td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <form id="herouser{{ $user->id }}"
                                                action="{{ route('management.role.user.down', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="form-check form-switch">
                                                    <input
                                                        onchange="document.querySelector('#herouser{{ $user->id }}').submit()"
                                                        class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked"
                                                        {{ $user->role == $user->role ? 'checked' : '' }}>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-outline-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('management.user.delete',$user->id) }}" class="btn btn-outline-danger waves-effect waves-light">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>


    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Blogger's Table</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bloggers as $blogger)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        <p class="fw-normal mb-1">{{ $blogger->name }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1">{{ $blogger->role }}</p>
                                    </td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <form id="herouser{{ $blogger->id }}"
                                                action="{{ route('management.role.blogger.down', $blogger->id) }}" method="POST">
                                                @csrf
                                                <div class="form-check form-switch">
                                                    <input
                                                        onchange="document.querySelector('#herouser{{ $blogger->id }}').submit()"
                                                        class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked"
                                                        {{ $blogger->role == $blogger->role ? 'checked' : '' }}>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-outline-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('management.blogger.delete',$blogger->id) }}" class="btn btn-outline-danger waves-effect waves-light">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>
</div>
@endsection

@section('script')
    @if (session('assignrole'))
        <script>
            Toastify({
                text: "{{ session('assignrole') }}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to  right, #FF512F ,#DD2475 )",
                },
                onClick: function() {} // Callback after click
            }).showToast();
        </script>
    @endif
@endsection
