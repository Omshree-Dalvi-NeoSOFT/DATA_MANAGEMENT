@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="content-wrapper p-2">   
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">{{ __('Modify User') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" id="successMessage" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-hover" id="example1">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email Id</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <th scope="col">Action</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->firstname}} {{$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                                @foreach ($roles as $role )
                                    @if ($role->role_id == $user->role_id)
                                        <td>{{$role->role_name}}</td>
                                    @endif
                                @endforeach
                                <td> @if($user->status == 1)
                                  <h3><span class="badge badge-success">Active</span></h3>
                               @else 
                                <h3><span class="badge badge-warning">In Active</span></h3>
                                @endif </td>

                                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <td><a href="edituser/{{ $user->id }}" class="btn btn-info btn-sm" role="button">Edit</a> | <a type="button" class="btn btn-danger text-white btn-sm dtlpro" data-bs-toggle="modal" data-bs-target="#staticBackdrop" aid="{{$user->id}}">
                                        Move to Trash</a>
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
                        url:"{{url('/deleteuser')}}",
                        type:'post',
                        method:'patch',
                        data:{_token:'{{csrf_token()}}',aid:aid},
                        success:function(response){
                            alert("User moved to trash !");
                            window.location.reload();
                        },
                        error: function(jqXHR, status, err){
                            window.location.reload();
                        }
                    }) 
                }
            })
        })
        $(function () {
            $('#example1').DataTable( {
                "responsive": false, 
                "lengthChange": false,
                "autoWidth": false,
                "bPaginate": true,
                "bInfo": false,
                dom: 'Blfrtip',
                buttons: [
                    {
                extend: 'csv',
                footer: false,
                exportOptions: {
                        columns: [0,1,2,3,4]
                    }
            },
            {
                extend: 'excel',
                footer: false,
                exportOptions: {
                        columns: [0,1,2,3,4]
                    }
            },
            {
                extend: 'pdf',
                title:'Users',
                footer: true,
                exportOptions: {
                        columns: [0,1,2,3,4]
                    }
            }
            ]
            } ).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        setTimeout(function() {
        $('#successMessage').fadeOut('fast');
    }, 3000);
    </script>
          
@endsection
