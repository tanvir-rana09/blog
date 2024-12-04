{{-- @extends('layouts.dashboardmaster')

@section('contant')
<div class="col-lg-7 ">
    <form method="POST" action="">
        @csrf
        @method('PUT')

        <div>
            <label>Name:</label>
            <input type="text" name="name" value="" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="" required>
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

        <div>
            <label>Password (optional):</label>
            <input type="password" name="password">
        </div>

        <button type="submit">Update</button>
    </form>
</div>
@endsection --}}
