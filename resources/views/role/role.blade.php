@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="content-wrapper p-2">   
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-2">
                        {{ __('User Roles') }}
                    </div>
                    <div class="col-sm-8"></div>
                    <div class="col-sm-2">
                        <a class="btn btn-primary text-white" href="{{route('role.add')}}">
                            {{ __('Add Role') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" id="successMessage" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role as $r)
                            <tr>
                                @if ($r->role_id == 1)
                                    @continue
                                @else
                                    <th scope="row">{{$loop->iteration -1 }}</th>
                                    <td>{{$r->role_name}}</td>
                                    <td><a type="button" class="btn btn-warning btn-sm dtlpro" data-bs-toggle="modal" data-bs-target="#staticBackdrop" aid="{{$r->role_id}}">
                                        Delete</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>  
    $(document).ready(function(){
        $(".dtlpro").click(function(e){
            var aid = $(this).attr("aid");
            if(confirm('Do you want to delete ?')){
                $.ajax({
                    url:"{{url('/deleterole')}}",
                    type:'post',
                    method:'patch',
                    data:{_token:'{{csrf_token()}}',aid:aid},
                    success:function(response){
                        window.location.reload();
                    },
                    error: function(jqXHR, status, err){
                        window.location.reload();
                    }
                }) 
            }
        })
    }),  
    setTimeout(function() {
        $('#successMessage').fadeOut('fast');
    }, 3000);
    </script>
          
@endsection
