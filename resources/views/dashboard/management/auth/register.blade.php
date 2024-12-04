@extends('layouts.dashboardmaster')
@section('title')
Role & User Register's  Page
@endsection
@section('contant')
<x-breadcum  tanvir="Role & User Register's  Page"></x-breadcum>
    <div class="row">
        <div class="col-lg-6 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Role & User Register</h4>

                    <form role="form" action="{{ route('management.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label"> Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control " id="inputEmail3"
                                    placeholder="name " name="name">
                                @error('name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label"> Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control " id="inputPassword3"
                                    placeholder="email" name="email">
                                @error('email')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="inputPassword5" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control " id="inputPassword5"
                                    placeholder="password" name="password">
                                @error('password')
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

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manager's Table</h4>

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
                                @foreach ($managers as $manager)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->index + 1 }}
                                        </th>
                                        <td>
                                            <p class="fw-normal mb-1">{{ $manager->name }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">{{ $manager->role }}</p>
                                        </td>
                                        @if (Auth::user()->role == 'admin')
                                            <td>
                                                <form id="herouser{{ $manager->id }}"
                                                    action="{{ route('management.down', $manager->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input
                                                            onchange="document.querySelector('#herouser{{ $manager->id }}').submit()"
                                                            class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked"
                                                            {{ $manager->role == $manager->role ? 'checked' : '' }}>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-outline-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ route('management.delete',$manager->id) }}" class="btn btn-outline-danger waves-effect waves-light">
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

    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="categoryModalLabel">Category edit</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-3">
                    @foreach ($managers as $manager)
                    <!-- Form content goes here -->
                    <form role="form" action="{{ route('management.update',$manager->id) }}" method="POST">
                        @csrf
                        <!-- Name -->
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-info-subtle" id="inputEmail3" placeholder="name" name="name" value="{{ $manager->name }}">
                                @error('name')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-info-subtle" id="inputPassword3" placeholder="email" name="email" value="{{ $manager->email }}">
                                @error('email')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row mb-2">
                            <label for="inputPassword5" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control border-info-subtle" id="inputPassword5" placeholder="password" name="password" value="{{ $manager->password }}">
                                @error('password')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="row mb-2">
                            <label for="inputPassword5" class="col-sm-3 col-form-label">Role</label>
                             <div class="col-sm-9">
                                <select class="form-select border-info-subtle" name="role" >
                                    <option value="">select roles</option>
                                    <option value="manager" {{ $manager->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="blogger" {{ $manager->role == 'blogger' ? 'selected' : '' }}>Blogger</option>
                                    <option value="user" {{ $manager->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @error('role')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light col-2 mt-3">Create</button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (session('store_register'))
        <script>
            Toastify({
                text: "{{ session('store_register') }}",
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
