@extends('admin.layout.main')

@push('title')
    <title>Register</title>
@endpush

@section('content')
    <section class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <!-- Additional header content if needed -->
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <!-- Removed duplicate form tag -->
            <form action="{{ route('admin-register') }}" method="post"> 
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Admin</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Full name" value="{{ old('full_name') }}"> <!-- Added value attribute to retain old input -->
                                    <span class="text-danger mb-2">
                                        @error('full_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Role</label>
                                    <select name="role_type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    <span class="text-danger mb-2">@error('role_type') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>

                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}"> <!-- Added value attribute to retain old input -->
                                    <span class="text-danger mb-2">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <span class="text-danger mb-2">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password-confir" placeholder="Retype password">
                                    <span class="text-danger mb-2">
                                        @error('password-confir')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary w-25 btn-block">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <h2 class="mt-5">Admin List</h2>
            <table class="table table-striped mt-1 table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter = 1; @endphp

                        @foreach ($register as $user)
                            @if ($user->id != 1)
                                <tr>
                                    <td><span class="increment">{{ $counter }}.</span></td>
                                    <td>{{ $user ? $user->name : '' }}</td>
                                    <td>{{ $user ? $user->email : '' }}</td>
                                    <td>
                                        @if($user)
                                            @if($user->type_role == 0)
                                                Super Admin
                                            @elseif($user->type_role == 1)
                                                Admin
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('delete-register', ['id' => $user->id]) }}">
                                            <i class="nav-icon fas fa-trash text-danger pe-auto admin-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                @php $counter++; @endphp
                            @endif
                        @endforeach



                </tbody>
            </table>
        </section>
    </section>
@endsection
