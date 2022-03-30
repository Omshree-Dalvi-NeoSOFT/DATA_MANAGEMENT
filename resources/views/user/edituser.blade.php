@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="content-wrapper p-2">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ __('Edit User') }}</div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" id="successMessage" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" id="successMessage" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Update User') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{route('PostEditUser')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}"/>
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }} <i class="text text-danger">*</i></label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>

                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }} <i class="text text-danger">*</i></label>

                                            <div class="col-md-6">
                                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" autofocus>

                                                @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }} <i class="text text-danger">*</i></label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('User Role') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control"  name="role_id" value="{{ old('role_id') }}" required autocomplete="role_id" autofocus>
                                                @foreach ($roles as $role )
                                                    @if ($userrole->role_id == $role->role_id)
                                                    <option value="{{$role->role_id}}" selected>{{$role->role_name}}</option>
                                                    @else
                                                    @if ($role->role_id == 1)
                                                        @continue
                                                    @else
                                                        <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                                                    @endif
                                                    @endif
                                                @endforeach
                                                </select>
                                                @error('role_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('User Status') }}</label>

                                            <div class="col-md-6">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" checked>
                                                <label class="form-check-label" for="inlineRadio1" aria-selected>Active</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                                                <label class="form-check-label" for="inlineRadio2">In-Active</label>
                                                </div>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Update User') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    setTimeout(function() {
        $('#successMessage').fadeOut('fast');
    }, 3000);
</script>
@endsection
