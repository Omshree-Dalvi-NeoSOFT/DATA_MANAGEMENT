@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="content-wrapper p-2">   
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ __('Error') }}</div>

            <div class="card-body">
                {{ $error }}
            </div>
        </div>
    </div>
</div>
@endsection
