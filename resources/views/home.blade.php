@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i> Success
            </div>
            <div class="card">
                <div class="card-header">Dashboard - Users List</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id  }}</th>
                                <td>{{ $user->name  }}</td>
                                <td>{{ $user->email  }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user_{{$user->id}}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="user_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit <mark>{{ $user->name }}</mark></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" name="name" class="form-control" id="name_{{ $user->id }}" value="{{ $user->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Email:</label>
                                                    <input type="text" name="email" class="form-control" id="email_{{ $user->id }}" value="{{ $user->email }}">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" onclick="updateUser('{{ $user->id }}')" id="editUser" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.alert-success').hide();
    })
    function updateUser(id) {
        const name = $("#name_"+id).val();
        const email = $("#email_"+id).val();
        if(!name || name ===''){
            alert('name is required');
            return
        }
        if(!email || email ===''){
            alert('email is required');
            return
        }
        const data = { 'id':id, 'name': name, 'email': email };
        $.ajax({
            'url': '/updateUser',
            'type': 'GET',
            'data': data,
            'success': function (data) {
                console.log(data.message)
                $('#user_'+id).modal('hide')
                $('.alert-success').show();
            },
            'error': function (request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    }
</script>
