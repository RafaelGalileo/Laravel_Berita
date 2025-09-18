    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="digitalRuteng">
		<meta name="keywords" content="digitalRuteng, Ruteng, Manggarai, Kemenag, Kementerian Agama, Kabupaten Manggarai">
        <meta name="author" content="digitalRuteng">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" {{ csrf_token() }}>
        <title>@yield('title')</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon1.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/line-awesome.min.css') }}">

        <!-- Datatable CSS -->
		<link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap4.min.css') }}">
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css') }}">

        <!-- SweetAlert -->
        <link rel="stylesheet" href="{{ asset('assets/sweetalert.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
		

    </head>