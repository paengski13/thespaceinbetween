<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rafael Torres</title>
    <!-- Favicon -->
    <link rel="icon" href="http://thespaceinbetween.co.nz/favicon/favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ URL::to('/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::to('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('/bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ URL::to('/bower_components/AdminLTE/dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>TSIB</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">TheSpaceInBetween</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ URL::to('/img/profile.png') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">Rafael Torres</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ URL::to('/img/profile.png') }}" class="img-circle" alt="User Image">

                                <p>
                                    Rafael Torres - PHP Artisan
                                    <small>March 27, 2017</small>
                                </p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::to('/img/profile.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Rafael Torres</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Client List
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-7">
                    <form method="GET" action="{{ route('clients.index') }}" accept-charset="UTF-8">
                        <div class="input-group input-group-sm">
                            <div class="col-xs-5">
                            <input name="search_name" type="text" value="{{ !empty($data['input']['search_name']) ? $data['input']['search_name'] : "" }}" placeholder="name" class="form-control">
                            </div>
                            <div class="col-xs-5">
                                <input name="search_address" type="text" value="{{ !empty($data['input']['search_address']) ? $data['input']['search_address'] : "" }}" placeholder="adrress" class="form-control">
                            </div>
                            <div class="col-xs-2">
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Search</button>
                            </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-4">
                    <form method="POST" action="{{ route('clients.upload') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="input-group input-group-sm">
                            <input type="file" name="upload" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-upload"></i>Upload</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="clear">&nbsp;<br/>&nbsp;</div>
                <div class="col-xs-12">
                    <div class="nav-tabs-custom">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @elseif ($message = Session::get('error'))
                            <div class="alert alert-error alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if (! empty($data['clients']) && count($data['clients']))
                            @foreach($data['clients'] as $key => $clientLetter)
                                <div class="row">
                                <span class="label label-danger"> {{$key}} - {{ count($data['clients'][$key]) }}</span>
                                </div>
                                @foreach($data['clients'][$key] as  $client)
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block" style="padding-left: 5px !important; padding-top: 5px !important; padding-right: 5px !important;">
                                            <img class="img-circle img-bordered-m" src="{{ $client['logo'] }}" alt="user image">
                                                <span class="username">
                                                  <a href="{{ $client['url'] }}" target="_blank">{{ $client['name'] }}</a>
                                                </span>
                                            <span class="description">{{ $client['url'] }}</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p style="padding-left: 5px !important; padding-right: 5px !important;">
                                            {{ $client['address'] }}
                                        </p>
                                    </div>
                                    <!-- /.post -->
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>TheSpaceInBetween</strong>
    </footer>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ URL::to('/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::to('/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::to('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ URL::to('/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::to('/bower_components/AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('/bower_components/AdminLTE/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::to('/bower_components/AdminLTE/dist/js/demo.js') }}"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
</body>
</html>
