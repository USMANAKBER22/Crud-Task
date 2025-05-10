<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD List</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child {
            width: 180px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            
            $('#createUserForm').on('submit', function(event) {
                event.preventDefault();
            
                $.ajax({
                    url: '{{ url('/store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                       
                        $('#createUserModal').modal('hide');

                        var newUser = `
                            <tr id="user-${response.id}">
                                <td>${response.id}</td>
                                <td>${response.name}</td>
                                <td>${response.email}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Update">
                                        <i class="fa fa-refresh"></i> Update
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-user" data-id="${response.id}" data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        `;

                        $('table tbody').append(newUser);
                    },
                    error: function(error) {
                        alert('Error adding user');
                    }
                });
            });

            
            $(document).on('click', '.delete-user', function(event) {
                event.preventDefault();
                var userId = $(this).data('id');

               
                $.ajax({
                    url: '{{ url('/delete') }}/' + userId,
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                           
                            $('#user-' + userId).remove();
                        }
                    },
                    error: function(error) {
                        alert('Error deleting user');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1> Crud Task  </h1>
        @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

        <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#createUserModal" data-toggle="tooltip" title="Create New User">
            <i class="fa fa-plus"></i> Create
        </a>

        @if($users->count())
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr id="user-{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                 <a href="{{ url('/edit/' . $user->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Update">
                                    <i class="fa fa-refresh"></i> Update
                                </button>
                                <form action="{{ url('/delete/'.$user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
            <i class="fa fa-trash"></i> Delete
        </button>
    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info mt-3">No records found.</div>
        @endif
    </div>

   
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <form id="createUserForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <button type="submit" class="btn btn-success">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
