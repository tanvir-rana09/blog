@extends('layouts.dashboardmaster')
@section('title')
User Page's
@endsection
@section('contant')
<x-breadcum  sabbir="User's  Page"></x-breadcum>
    {{-- name --}}
    <div style="margin-top: 50px" class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (Auth::user()->role == "admin")
                    <table class="table align-middle mb-0 bg-gray">
                        <thead class="bg-light font-bold">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>
                                    <p class="fw-normal mb-1">{{ $user->name }}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{ $user->email }}</p>
                                </td>
                                <td>
                                    <p>{{$user->role }}</p>
                                </td>
                                <td>
                                    <a href="{{ route('user_destroy',$user->id) }}" class="btn btn-danger btn-sm text-white font-bold">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach

                    </table>
                    @else
                    <p class="font-bold"> Hey Mr : <b>{{ Auth::user()->name }}</b></p>
                     <h3 style="color:rgb(44, 168, 218); font-weight: bold" class="">Thank You For Comeing My User View Page..!!</h3>
                    @endif
                </div>
            </div>
        </div>
</div>


 @endsection

@section('script')
@if (session('cat_success'))

<script>
   Toastify({
  text: "{{ session('cat_success') }}",
  duration: 3000,
  newWindow: true,
  close: true,
  gravity: "top", // `top` or `bottom`
  position: "right", // `left`, `center` or `right`
  stopOnFocus: true, // Prevents dismissing of toast on hover
  style: {
    background: "linear-gradient(to  right, #FF512F ,#DD2475 )",
  },
  onClick: function(){} // Callback after click
}).showToast();
</script>

@endif
@endsection
