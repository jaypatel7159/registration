<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container">


        <div class="row">
            <h2 class="">List User</h2>
            <div class="emp-btn float-right">
                <button type="button" id="addEmployee" class="btn btn-primary ml-1">
                    Add User
                </button>
            </div>
            <div class="w-25">
                @if(Session::has('log'))
                <p class="alert alert-info">{{ Session::get('log') }}</p>
                @endif
                @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
                @endif
                @if(Session::has('del'))
                <p class="alert alert-danger">{{ Session::get('del') }}</p>
                @endif

            </div>
            <!-- //add modal -->
            <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>

                            <button type="button" class="btn-close reset_btn" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="userForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control" id="firstname" placeholder="Enter first name"
                                        name="first_name">
                                    @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" class="form-control" id="lastname" placeholder="Enter last name"
                                        name="last_name">
                                    @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter Subject"
                                        name="email">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label><br>
                                    <input type="radio" name="gender" value="Male">Male
                                    <input type="radio" name="gender" value="Female">Female
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <label class="error_gender error_hide"></label>
                                </div>
                                <div class="form-group">
                                    <label for="hobbies">Hobbies:</label><br>
                                    <input type="checkbox" name="hobby[]" value="Cricket"> Cricket
                                    <input type="checkbox" name="hobby[]" value="Football"> Football
                                    <input type="checkbox" name="hobby[]" value="Travelling"> Travelling
                                    <input type="checkbox" name="hobby[]" value="Music"> Music

                                    @error('hobby')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_hobby error_hide"></label>
                                </div>
                                <div class="mb-1">
                                    <label for="country">Choose a country:</label>
                                    <select name="country" id="country" class="form-control country">
                                        <option value="">Select a country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_country error_hide"></label>
                                </div>

                                <div class="mb-1">
                                    <label for="state">Choose a state:</label>
                                    <select name="state" id="state" class="form-control state">
                                        <option value="">Select a state</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_state error_hide"></label>
                                </div>

                                <div class="mb-1">
                                    <label for="city">Choose a city:</label>
                                    <select name="city" id="city" class="form-control">
                                        <option value="">Select a city</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_city error_hide"></label>
                                </div>
                                <div class="mb-1">
                                    <label for="technology">Choose a technology:</label>
                                    <select name="technology[]" id="technology" class="form-control" multiple>
                                        <option value="php">PHP</option>
                                        <option value="laravel">Laravel</option>
                                        <option value="html">Html</option>
                                        <option value="python">Python</option>
                                    </select>
                                    @error('technology')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_technology error_hide"></label>
                                </div>
                                <div class="mb-1">
                                    <label for="image">Image:</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- edit modal -->
            <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>

                            <button type="button" class="btn-close reset_btn" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_update_data" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control first_name" id="firstname" placeholder="Enter first name"
                                        name="first_name">
                                    @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" class="form-control last_name" id="lastname" placeholder="Enter last name"
                                        name="last_name">
                                    @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control email" id="email" placeholder="Enter Subject"
                                        name="email">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender:</label><br>
                                    <input type="radio" class="male" name="gender" value="Male">Male
                                    <input type="radio" name="gender" class="female" value="Female">Female
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror<br>
                                    <label class="error_gender error_hide"></label>
                                </div>
                                <div class="form-group">
                                    <label for="hobbies">Hobbies:</label><br>
                                    <input type="checkbox" class="cricket" name="hobby[]" value="Cricket"> Cricket
                                    <input type="checkbox" class="football" name="hobby[]" value="Football"> Football
                                    <input type="checkbox" class="travelling" name="hobby[]" value="Travelling"> Travelling
                                    <input type="checkbox" class="music" name="hobby[]" value="Music"> Music

                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_hobby error_hide"></label>
                                </div>
                                <div class="mb-1">
                                    <label for="country">Choose a country:</label>
                                    <select name="country" id="country" class="form-control country">
                                        <option value="">Select a country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_country error_hide"></label>
                                </div>

                                <div class="mb-1">
                                    <label for="state">Choose a state:</label>
                                    <select name="state" id="state" class="form-control state">
                                        <option value="">Select a state</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_state error_hide"></label>
                                </div>

                                <div class="mb-1">
                                    <label for="city">Choose a city:</label>
                                    <select name="city" id="city" class="form-control">
                                        <option value="">Select a city</option>
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_city error_hide"></label>
                                </div>

                                <div class="mb-1">
                                    <label for="technology">Choose a technology:</label>
                                    <select name="technology[]" id="technology" class="form-control" multiple>
                                        <option value="php">PHP</option>
                                        <option value="laravel">Laravel</option>
                                        <option value="html">Html</option>
                                        <option value="python">Python</option>
                                    </select>
                                    @error('technology')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_technology error_hide"></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Choose image:</label>
                                    <div id="show_image"></div>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label class="error_image error_hide"></label>

                                </div>
                                <input type="hidden" name="id" class="id">
                                <button type="submit" class="btn btn-primary update-btn">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <table class="table table-striped" id="employeeDatatbale">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Gender</th>
                        <th>Hobby</th>
                        <th>Technology</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on("click", "#addEmployee", function() {
                $("#userModal").modal("show");
            })


            $(function() {
                var table = $('#employeeDatatbale').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('userList') }}",
                    columns: [{
                            data: 'first_name',
                            name: 'first_name'
                        },
                        {
                            data: 'last_name',
                            name: 'last_name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'country_id',
                            name: 'country_id'
                        },
                        {
                            data: 'state_id',
                            name: 'state_id'
                        },
                        {
                            data: 'city_id',
                            name: 'city_id'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'hobby',
                            name: 'hobby'
                        },
                        {
                            data: 'technology',
                            name: 'technology'
                        },
                        {
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'action',
                            name: 'action',
                        },
                    ]
                });

                $('#country').change(function() {
                    var countryId = $(this).val();
                    if (countryId) {
                        $.ajax({
                            url: '/states/' + countryId,
                            type: 'GET',
                            success: function(data) {
                                $('#state').empty();
                                $('#state').append('<option value="">Select a state</option>');
                                $.each(data, function(key, value) {
                                    $('#state').append('<option value="' + key + '">' + value + '</option>');
                                });
                            }
                        });
                    }
                });

                $('#state').change(function() {
                    var stateId = $(this).val();
                    if (stateId) {
                        $.ajax({
                            url: '/cities/' + stateId,
                            type: 'GET',
                            success: function(data) {
                                $('#city').empty();
                                $('#city').append('<option value="">Select a city</option>');
                                $.each(data, function(key, value) {
                                    $('#city').append('<option value="' + key + '">' + value + '</option>');
                                });
                            }
                        });
                    }
                });

                $("#userForm").on('submit', (function(event) {
                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('userStore') }}",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data.status == "0") {

                                $.each(data.error, function(key, value) {

                                    $(".error_" + key).show();
                                    $(".error_" + key).html(value);
                                    $(".error_" + key).css("color", "red");
                                })
                            } else {
                                table.ajax.reload();
                                sweetAlert("Data inserted successfully");
                                $("#userModal").modal("hide");
                            }

                        },
                    });
                }));

                $(document).on("click", ".edit_btn", function() {
                    var id = $(this).attr("data-id")
                    $.ajax({
                        url: "{{route('userEdit')}}",
                        type: 'get',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $("#editUserModal").modal("show");
                            $(".first_name").val(data.user.first_name)
                            $(".last_name").val(data.user.last_name)
                            $(".email").val(data.user.email)
                            $(".country").val(data.user.country_id)
                            $(".id").val(data.user.id)
                            var urls = window.location.origin
                            $("#show_image").html('<img src="' + urls + '/storage/images/' + data.user.image + '" width="50" class="img-fluid img-thumbnail">')
                            if (data.user.gender == "Male") {
                                $(".male").prop("checked", true)
                            } else {
                                $(".female").prop("checked", true)
                            }

                            $(".cricket").prop("checked", false);
                            $(".football").prop("checked", false);
                            $(".travelling").prop("checked", false);
                            $(".music").prop("checked", false);

                            if ($.inArray("Cricket", data.hobby) != -1) {

                                $(".cricket").prop("checked", true);
                            }
                            if ($.inArray("Football", data.hobby) != -1) {

                                $(".football").prop("checked", true);
                            }
                            if ($.inArray("Travelling", data.hobby) != -1) {

                                $(".travelling").prop("checked", true);
                            }
                            if ($.inArray("Music", data.hobby) != -1) {

                                $(".music").prop("checked", true);
                            }
                        }
                    })
                })

                $("#form_update_data").on('submit', (function(event) {
                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('userUpdate') }}",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data.status == "0") {

                                $.each(data.error, function(key, value) {

                                    $(".error_" + key).show();
                                    $(".error_" + key).html(value);
                                    $(".error_" + key).css("color", "red");
                                })
                            } else {
                                table.ajax.reload();
                                sweetAlert("Data update successfully");
                                $("#editUserModal").modal("hide");
                            }
                        },
                    });
                }));

                $(document).on("click", ".delete_btn", function() {

                    swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this imaginary file!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: "{{route('userDelete')}}",
                                    type: 'GET',
                                    data: {
                                        emp_id: $(this).attr("data-id"),
                                    },
                                    success: function(data) {
                                        table.ajax.reload();
                                        sweetAlert("Data Delete successfully");
                                    }
                                });
                            } else {
                                swal("Your imaginary file is safe!");
                            }
                        });
                });
            });
        })

        $(".reset_btn").click(function() {
            $("#form_data").trigger('reset');
            $(".error_hide").hide();
        })
    </script>
</html>