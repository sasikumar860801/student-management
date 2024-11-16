<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main><br>
            <div class="container">
    <h1 style="text-align: center;">Student Management System</h1><br>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
        Add Student
    </button>

    <!-- Student Table -->
    <div class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>S.No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="students-list">
                @foreach($students as $student)
                    <tr id="student-{{ $student->id }}">
                    <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->mobile }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->department_name }}</td>
                        <td>{{ $student->status }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $student->id }}">Edit</button>                                                    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



 <!-- Modal for Add  -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="student-form" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="student-id">
                    
                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>

                    <!-- Mobile -->
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select id="department_id" name="department_id" class="form-control" required>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Form -->
<div class="modal fade" id="studentModal-edit" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Update Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="student-form-edit" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="student-id-edit">
                    
                    <!-- First Name -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name-edit" name="first_name" required>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name-edit" name="last_name" required>
                    </div>

                    <!-- Mobile -->
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control" id="mobile-edit" name="mobile" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email-edit" name="email" required>
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address-edit" name="address" required></textarea>
                    </div>

                    <!-- Department -->
                    <div class="form-group">
    <label for="department_id">Department</label>
    <select id="department_id-edit" name="department_id" class="form-control" required>
        @foreach($departments as $department)
            <option value="{{ $department->id }}" 
                @if($department->id == old('department_id', $student->department_id)) selected @endif>
                {{ $department->name }}
            </option>
        @endforeach
    </select>
</div>
                    <!-- Status -->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status-edit" name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
$(document).ready(function() {
    $('#save-btn').click(function(e) {
        e.preventDefault();

        var formData = $('#student-form').serialize();

        $.ajax({
            url: '/students',        
            type: 'POST',            
            data: formData,          
            dataType: 'json',        
            success: function(response) {
                alert('Student saved successfully!');
                location.reload();
                $('#studentModal').modal('hide');
                
                console.log(response); 
            },
            error: function(xhr, status, error) {
    const errorData = JSON.parse(xhr.responseText);
    if (errorData.errors) {
        $(".error-message").remove();
        for (let field in errorData.errors) {
            const fieldInput = $(`input[name=${field}], select[name=${field}], textarea[name=${field}]`);

            const errorMessage = $(`<span class="error-message" style="color: red; font-size: 12px; margin-top: 5px;">${errorData.errors[field].join(', ')}</span>`);
                        fieldInput.after(errorMessage);
                    }
                }
                console.error(xhr.responseText);
            }
        });
    });


$(".edit-btn").click(function() {
    var studentId = $(this).data("id");
    $.ajax({
        type: "GET",
        url: "/students/" + studentId + "/edit",
        success: function(response) {
             
                var student = response.student;

                $("#student-id-edit").val(student.id); 
                $("#first_name-edit").val(student.first_name);
                $("#last_name-edit").val(student.last_name);
                $("#mobile-edit").val(student.mobile);
                $("#email-edit").val(student.email);
                $("#address-edit").val(student.address);
                $("#department_id-edit").val(student.department_id);
                $("#status-edit").val(student.status);
                $("#studentModalLabel").text("Edit Student");
                
                // Show the modal
                $('#studentModal-edit').modal('show');
            },
    });
});

$('#update-btn').click(function(e) {
        e.preventDefault(); 

        var studentId = $('#student-id-edit').val();
      
        var edit_formData = $('#student-form-edit').serialize();  // Serialize the form data

        $.ajax({
            url: '/students/update/' + studentId,  
            type: 'post',                   
            data: edit_formData,               
            dataType: 'json',              
            success: function(response) {
                $('#studentModal-edit').modal('hide');
                location.reload();

            },
            error: function(xhr, status, error) {
    const errorData = JSON.parse(xhr.responseText);
    if (errorData.errors) {
        $(".error-message").remove(); 
        for (let field in errorData.errors) {
            const fieldInput = $(`input[name=${field}], select[name=${field}], textarea[name=${field}]`);
            const errorMessage = $(`<span class="error-message" style="color: red; font-size: 12px; margin-top: 5px;">${errorData.errors[field].join(', ')}</span>`);

            fieldInput.after(errorMessage);
        }
    }
    console.error(xhr.responseText);
    alert('An error occurred while updating the student. Please check the form and try again.');
}

        });
    });

});
</script>


    </body>
</html>
