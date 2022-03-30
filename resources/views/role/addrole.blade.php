@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="content-wrapper p-2">   
    <div class="container-fluid">
        <div class="card">
            <div class="card-header row">
                <div class="col-sm-2">
                        {{ __('Add Role') }}
                    </div>
                    <div class="col-sm-8">
                    <a class="btn btn-dark text-white" href="{{route('role.show')}}">
                            {{ __('Back') }}
                        </a>
                    </div>
                </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" id="successMessage" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="post" enctype="multipart/form-data" action="{{route('role.postAdd')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="rolename" class="form-label">{{ __('Role Name') }} <i class="text text-danger">*</i></label>
                        <input type="text" name="rolename" class="form-control @error('rolename') is-invalid @enderror" id="rolename" placeholder="Role Name" value="{{ old('rolename') }}" autofocus>
                        @error('rolename')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Role') }}
                        </button>
                    </div>
                </form>
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
