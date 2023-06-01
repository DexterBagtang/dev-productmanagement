<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico"/>

    <title>Project Management </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<style>
    .approvebox {
        width: auto;
        border: 3px solid gray;

        border-radius: 5px;
        font-size: 20px
    }
</style>
</head>


</style>
</head>


<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/home" class="site_title"> <img src="../img/company_logo.png" width='70%' height='80%'></a>

                </div>
                <br/>
                <!-- sidebar menu -->

                @include('side_menu')

                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            @include('top_header')
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add Sales Request</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <div class="container">
                                <div class="card uper">

                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div><br/>
                                        @endif
                                        <form method="post" action="{{ route('salesrequests.store') }}"
                                              enctype="multipart/form-data" class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                @csrf
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                       for="mall_name">Mall Name:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select name='mall_id' class="form-control" required>
                                                        <option disabled selected=selected> -- select an option --
                                                        </option>
                                                        @foreach($malls as $mall)
                                                            <option value="{{$mall->mall_id}}">{{$mall->mall_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                       for="qoutation_addressee">Quotation Addressee:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="qoutation_addressee"
                                                           value="{{ old('qoutation_addressee') }}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                       for="requester">Requester:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="requester"
                                                           value="{{ old('requester') }}" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                       for="project_title">Project Title:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="project_title"
                                                           value="{{ old('project_title') }}" required/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                       for="date_needed">Proposal Target Date:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="date" class="form-control" name="date_needed" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                       for="on_site_survey">For Site Survey:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="radio" name="on_site_survey" value="Yes"> Yes ||
                                                    <input type="radio" name="on_site_survey" value="No"> No
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Comment:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="comment"
                                                           value="{{ old('comment') }}"/>
                                                </div>
                                            </div>

                                            {{--<!-- add more project files--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"--}}
{{--                                                       for="requester">Project Requirement--}}
{{--                                                    File:</label>--}}
{{--                                                <div class="col-md-6 col-sm-6 col-xs-12">--}}
{{--                                                    <div class="table-responvsive">--}}
{{--                                                        <table class="table table-bordered" id="dynamic_field">--}}
{{--                                                            <tr>--}}
{{--                                                                <td><input type="file" class="form-control-file"--}}
{{--                                                                           name="project_requirements_files"></td>--}}
{{--                                                                <td>--}}
{{--                                                                    <button type="button" name="add" id="add"--}}
{{--                                                                            class="btn btn-round btn-primary btn-xs">Add--}}
{{--                                                                        More--}}
{{--                                                                    </button>--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                        </table>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            {{--end add more project files -->--}}




                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                       for="requester">Project Requirement File:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="file" class="form-control" name="project_requirements_files[]">
                                                </div>
                                                <button type="button" class="btn btn-sm btn-success" id="add-btn">Add</button>
                                            </div>
                                            <div id="additional">

                                            </div>


                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select name='category' class="form-control" required>
                                                        <option disabled selected=selected> -- select an option --
                                                        </option>
                                                        <option value="Small">Small</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Large">Large</option>
                                                        <option value="Special">Special</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <a href="{{ action('SalesrequestController@index') }}">
                                                        <button type="button" class="btn btn-primary">Cancel</button>
                                                    </a>
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
        <!-- /page content -->

    </div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<script>
    $(document).ready(function() {
        // Define a counter variable to keep track of the number of additional file input fields
        var counter = 0;

        // Add a click event listener to the "Add" button
        $('#add-btn').click(function() {
            // Increment the counter
            counter++;

            // Create a new file input field with a unique name attribute
            var input = $('<input/>', {
                type: 'file',
                class: 'form-control',
                name: 'project_requirements_files[]',
                multiple: true
            });

            // Create a new remove button
            var removeBtn = $('<button/>', {
                type: 'button',
                class: 'btn btn-sm btn-danger',
                text: 'Remove'
            });



            // Create a new form group to hold the new file input field and remove button
            var formGroup = $('<div/>', {
                class: 'form-group'
            }).append(
                $('<label/>', {
                    class: 'control-label col-md-3 col-sm-3 col-xs-12',
                }),
                $('<div/>', {
                    class: 'col-md-6 col-sm-6 col-xs-12'
                }).append(
                    input
                ),
                removeBtn
            );

            // Add a click event listener to the new remove button
            removeBtn.click(function() {
                formGroup.remove();
                counter--;
            });

            // Add the new form group to the "additional" container
            $('#additional').append(formGroup);
        });
    });
</script>
<script type="text/javascript">

    var x = document.getElementById("add");
    x.addEventListener("click", myFunction1);
    x.addEventListener("click", myFunction2);


    function myFunction1() {


        $(document).ready(function () {
            var postURL = "<?php echo url('addmore'); ?>";
            var i = 20;
            $('#add').click(function () {
                i++;

                $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="hidden" name="project_requirement_files_2_number[]" value="1"><input type="file" name="project_requirements_files_2" class="form-control-file" /></td><td><button type="button" name="remove" id="' + i + '" class="btn-round btn btn-danger btn_remove" ">X</button></td></tr>');
            });

            function getData() {
                var project_requirements_files = document.getElementById('existing_project_requirements_files_id').value;
                $('#dynamic_field').append('<input type="hidden" name="existing_prfs_name" value="' + project_requirements_files + '">');
            }

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submit').click(function () {
                $.ajax({
                    url: postURL,
                    method: "POST",
                    data: $('#add_name').serialize(),
                    type: 'json',
                    success: function (data) {

                        if (data.error) {
                            printErrorMsg(data.error);
                        } else {
                            i = 1;
                            $('.dynamic-added').remove();
                            $('#add_name')[0].reset();
                            $(".print-success-msg").find("ul").html('');
                            $(".print-success-msg").css('display', 'block');
                            $(".print-error-msg").css('display', 'none');
                            $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                        }
                    }
                });
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $(".print-success-msg").css('display', 'none');
                $.each(msg, function (key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });

    }

    ///////////////////////////////////////////////////////////////

    function myFunction2() {


        $(document).ready(function () {
            var postURL = "<?php echo url('addmore'); ?>";
            var i = 20;
            $('#add').click(function () {
                i++;

                $('#dynamic_field1').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="hidden" name="project_requirement_files_3_number[]" value="1"><input type="file" name="project_requirements_files_3" class="form-control-file" /></td><td><button type="button" name="remove" id="' + i + '" class="btn-round btn btn-danger btn_remove" ">X</button></td></tr>');

            });

            function getData() {
                var project_requirements_files = document.getElementById('existing_project_requirements_files_id').value;
                $('#dynamic_field').append('<input type="hidden" name="existing_prfs_name" value="' + project_requirements_files + '">');
            }

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#submit').click(function () {
                $.ajax({
                    url: postURL,
                    method: "POST",
                    data: $('#add_name').serialize(),
                    type: 'json',
                    success: function (data) {

                        if (data.error) {
                            printErrorMsg(data.error);
                        } else {
                            i = 1;
                            $('.dynamic-added').remove();
                            $('#add_name')[0].reset();
                            $(".print-success-msg").find("ul").html('');
                            $(".print-success-msg").css('display', 'block');
                            $(".print-error-msg").css('display', 'none');
                            $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                        }
                    }
                });
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $(".print-success-msg").css('display', 'none');
                $.each(msg, function (key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });

    }
</script>


</body>
</html>
