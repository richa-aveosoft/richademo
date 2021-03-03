<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script>
    $(document).ready(function() {

        //When click edit student
        $('body').on('click', '.btnEdit', function() {
            // alert("");
            var student_id = $(this).attr('data-id');
            $.get('/student/' + student_id + '/edit', function(data) {
                //alert("")
                $('#update').css("display", "block");
                $('#updateStudent #hdnStudentId').val(data.id);
                $('#updateStudent #txtFirstName').val(data.first_name);
                $('#updateStudent #txtLastName').val(data.last_name);
                $('#updateStudent #txtAddress').val(data.address);
            })
        });
        // Update the student
        $("#updateStudent").validate({
            rules: {
                txtFirstName: "required",
                txtLastName: "required",
                txtAddress: "required"

            },
            messages: {},

            submitHandler: function(form) {
                var form_action = $("#updateStudent").attr("action");
                $.ajax({
                    data: $('#updateStudent').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        var student = '<td>' + data.id + '</td>';
                        student += '<td>' + data.first_name + '</td>';
                        student += '<td>' + data.last_name + '</td>';
                        student += '<td>' + data.address + '</td>';
                        student += '<td><a data-id="' + data.id +
                            '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' +
                            data.id +
                            '" class="btn btn-danger btnDelete">Delete</a></td>';
                        $('#studentTable tbody #' + data.id).html(student);
                        $('#updateStudent')[0].reset();
                        $('#update').css("display", "none");

                    },
                    error: function(data) {}
                });
            }
        });
        //Add the Student
        $("#addStudent").validate({
            rules: {
                txtFirstName: "required",
                txtLastName: "required",
                txtAddress: "required"
            },
            messages: {},

            submitHandler: function(form) {
                var form_action = $("#addStudent").attr("action");
                $.ajax({
                    data: $('#addStudent').serialize(),
                    url: form_action,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        var student = '<tr id="' + data.id + '">';
                        student += '<td>' + data.id + '</td>';
                        student += '<td>' + data.first_name + '</td>';
                        student += '<td>' + data.last_name + '</td>';
                        student += '<td>' + data.address + '</td>';
                        student += '<td><a data-id="' + data.id +
                            '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' +
                            data.id +
                            '" class="btn btn-danger btnDelete">Delete</a></td>';
                        student += '</tr>';
                        $('#studentTable tbody').prepend(student);
                        $('#addStudent')[0].reset();
                        $('#addModal').modal('hide');
                    },
                    error: function(data) {}
                });
            }
        });
    });
    $(document).ready(function() {
        //delete student
        $('body').on('click', '.btnDelete', function() {
            var student_id = $(this).attr('data-id');
            $.get('student/' + student_id + '/delete', function(data) {
                $('#studentTable tbody #' + student_id).remove();
            })
        });

    });

</script>

</html>
