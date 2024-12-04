@extends('layouts.dashboardmaster')
@section('title')
Profile Page's
@endsection
@section('contant')
<x-breadcum  tanvir="Profile Page"></x-breadcum>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="{{ 'update' }}/assets/app-1o_sA8DU.css" rel="stylesheet" type="text/css" />
        <link href="{{ 'update' }}/assets/app-DLXkxiZ3.js" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                    {{-- iamge update session --}}
                    <div class="col-lg-5 ">
                        <div class="card dark:bg-gray-800">
                            <div class="card-body">
                                <form action="{{ route('profile.image') }} " method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div style="position: relative;" class="mb-2 ">
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                Profile Image
                                            </h2>
                                        </header>
                                        <br>

                                        <div style=" width: 100px; height:100px; display: flex; flex-direction:row;">
                                            @if  (auth()->user()->image == 'default.jpg')
                                                <img style=" width:100%; height:100%;  object-fit:cover; border:4px solid rgb(41, 105, 102);"
                                                    src="{{ asset('update/default') }}/{{ auth()->user()->image }}"
                                                    alt="user-image" class="rounded-circle" id="showimage">
                                            @else
                                                <img style=" width:100%; height:100%;  object-fit:cover; border:4px solid rgb(41, 105, 102);" src="{{ asset('update/profile') }}/{{ auth()->user()->image }}"
                                                    alt="user-image" class="rounded-circle" id="showimage">
                                            @endif

                                            <label style=" position: absolute; font-size:23px; left:65px; top:115px; font-size:17px;"
                                                for="updat"><i
                                                    style=" bottom:20px; left:90px;background-color:white; padding:5px;display:flex; align-items:center; color:black; border-radius:50%; border:4px solid rgb(46, 47, 49);"
                                                    class="fa-solid fa-pen-to-square"></i></label>

                                        </div>
                                        <input id="updat" hidden style="border: 1px solid rgb(43, 112, 97);"
                                            value="{{ old('password') }}" type="file" name="image"
                                            class="form-control  @error('name') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            onchange="document.querySelector('#showimage').src = window.URL.createObjectURL(this.files[0])">
                                        @error('image')
                                            <p class="text-danger mt-2">
                                                <strong>{{ $message }}</strong>
                                            </p>
                                        @enderror

                                    </div>
                                    <button style="background-color:rgb(75, 112, 235); border:none; margin-top:10px;" type="submit"
                                        class="btn btn-primary col-12">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- name information session  --}}
                    <div class="grid grid-cols-2 gap-5">
                        <div class="p-4 sm:p-8 bg-gray dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="w-full">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Profile Information
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Update your account&#039;s profile information and Name
                                        address.
                                    </p>
                                </header>
                                {{-- name update session start  --}}
                                <form method="POST" action="{{ route('profile.username') }}" class="mt-6 space-y-6">
                                    @csrf
                                    <div class="mt-6">
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"for="name">
                                            Name </label>
                                        <input
                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full mt-1"
                                            value="{{ old('name') }}" type="text" name="name"
                                            class="form-control  @error('name') is-invalid @enderror"
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                        @error('name')
                                            <p class="text-danger mt-2">
                                                <strong>{{ $message }}</strong>
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="flex items-center gap-4 mt-3">
                                        <button type="submit"
                                            class="bg-blue p-2 w-20 rounded-md text-white">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Email sesssion start.......... --}}
                        <div iv class="p-4 sm:p-8 bg-gray dark:bg-gray-800 shadow sm:rounded-lg">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Profile Information
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Update your account&#039;s profile information and email
                                    address.
                                </p>
                            </header>
                            <form method="post" action="{{ route('profile.useremail') }}" class="mt-6 space-y-6">
                                @csrf
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                        for="email"> Email</label>
                                    <input
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full mt-1"
                                        value="{{ old('email') }}" type="text" name="email"
                                        class="form-control  @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    @error('email')
                                        <p class="text-danger mt-2">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex items-center gap-4">
                                    <button type="submit" class="bg-blue p-2 w-20 rounded-md text-white">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{--
                password session start here/........ --}}
                    <div class="p-4 sm:p-8 bg-gray dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="w-full ">
                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Update Password
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Ensure your account is using a long, random password to stay
                                        secure.
                                    </p>
                                </header>

                                <form method="post" action="{{ route('profile.password') }} ">
                                    @csrf
                                    <div class="grid grid-cols-2 gap-4 mt-5">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                                for="update_password_current_password">Current Password
                                            </label>
                                            <input
                                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                                value="{{ old('password') }}" type="password" name="c_password"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleInputEmail1" aria-describedby="emailHelp" />
                                            @error('password')
                                                <p class="text-danger mt-2">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                                for="update_password_password">New Password
                                            </label>
                                            <input
                                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                                value="{{ old('password') }}" type="password" name="password"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('password')
                                                <p class="text-danger mt-2">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                                                for="update_password_password_confirmation">
                                                Confirm Password
                                            </label>
                                            <input
                                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                                value="{{ old('password') }}" type="password"
                                                name="password_confirmation"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                            @error('password_confirmation')
                                                <p class="text-danger mt-2">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="flex items-center gap-4 mt-3">
                                        <button type="submit"
                                            class="bg-blue p-2 w-20 rounded-md text-white">Save</button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-gray dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <section class="space-y-6">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        Delete Account
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Once your account is deleted, all of its resources and data will
                                        be permanently deleted. Before deleting your account, please
                                        download any data or information that you wish to retain.
                                    </p>
                                </header>

                                <form method="post" action="{{ route('users.delete-all',["id"=>auth()->user()->id]) }} ">
                                    @csrf
                                    <button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                    Delete Account
                                </button>
                                </form>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </body>

    </html>
@endsection

<!-- Page Content -->
@section('script')
    {{-- name --}}
    @if (session('name_update'))
        <script>
            Toastify({
                text: "{{ session('name_update') }}",
                duration: 3000,
                destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right",
                // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to  right, #FF512F ,#DD2475 )",
                },
                onClick: function() {} // Callback after click
            }).showToast();
        </script>
    @endif

    {{-- email --}}
    @if (session('email_update'))
        <script>
            Toastify({
                text: "{{ session('email_update') }}",
                duration: 3000,
                destination: "https://github.com/apvarun/toastify-js",
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

    {{-- password --}}
    @if (session('password_update'))
        <script>
            Toastify({
                text: "{{ session('password_update') }}",
                duration: 3000,
                destination: "https://github.com/apvarun/toastify-js",
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

    {{-- image --}}
    @if (session('image_update'))
        <script>
            Toastify({
                text: "{{ session('image_update') }}",
                duration: 3000,
                destination: "https://github.com/apvarun/toastify-js",
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
