@extends('layouts.dashboardmaster')
@section('title')
    Cetegry Page's
@endsection
@section('contant')
    <x-breadcum sabbir="Cetegory's  Page"></x-breadcum>
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <table class="table align-middle mb-0 bg-gray">
                        <thead class="bg-light">
                            <tr>
                                <th>Cetegory Image</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cetegories as $cetegorie)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('uploads/cetegory') }}/{{ $cetegorie->image }}" alt=""
                                                style="width: 45px; height: 45px; margin-left:10px;" class="rounded-circle">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1">{{ $cetegorie->slug }}</p>

                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                        <p class="fw-normal mb-1">{{ $cetegorie->title }}</p>
                                    </td>
                                    <td>
                                        <form id="sabbirkharap{{ $cetegorie->id }}"
                                            action="{{ route('category.status', $cetegorie->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input
                                                    onchange="document.querySelector('#sabbirkharap{{ $cetegorie->id }}').submit()"
                                                    class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $cetegorie->status == 'active' ? 'checked' : '' }}>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', $cetegorie->slug) }}"
                                            class="btn btn-outline-info waves-effect waves-light">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('category.destroy', $cetegorie->slug) }}"
                                            class="btn btn-outline-danger waves-effect waves-light">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Category Insert</h4>

                    <form role="form" action="{{ route('category.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Category Title"
                                    name="title">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Category Slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Category Slug"
                                    name="slug">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <img id="montrimosai" src="{{ asset('uploads/default/deafulttt.jpg') }}" alt=""
                                style="width:100%; height:300px; object-fit:contain;">
                        </div>
                        <div class="row mb-2">
                            <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                            <div class="col-sm-9">
                                <input
                                    onchange="document.querySelector('#montrimosai').src = window.URL.createObjectURL(this.files[0])"
                                    type="file" class="form-control" id="inputPassword5" name="image">
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light col-12">Insert</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal Structure -->
        {{-- <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="categoryModalLabel">Category edit</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-3">
                <!-- Form content goes here -->

                <form role="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Category Title"
                                name="titlee">
                            @error('titlee')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="Category Slug"
                                name="slugg">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <img id="mosai" src="{{ asset('uploads/default/deafulttt.jpg') }}" alt=""
                            style="width:100%; height:300px; object-fit:contain;">
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                        <div class="col-sm-9">
                            <input
                                onchange="document.querySelector('#mosai').src = window.URL.createObjectURL(this.files[0])"
                                type="file" class="form-control" id="inputPassword5" name="imagee">
                            @error('imagee')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Update
                      </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
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
                    onClick: function() {} // Callback after click
                }).showToast();
            </script>
        @endif
    @endsection
