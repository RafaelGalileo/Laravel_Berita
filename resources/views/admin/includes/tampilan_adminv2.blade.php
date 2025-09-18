<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')

    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="index.html" class="logo">
						<img src="{{ asset('admin/assets/img/dr_logo.png') }}" width="40" height="40" alt="">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>digitalRuteng</h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="index.html#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">


					{{-- pengguna_saat_ini--}}
					@php
						$current_user = Auth::guard('admin')->user();
					@endphp

					{{--  --}}

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="index.html#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img src="{{ asset('uploads/'. $current_user->foto)}}" alt="{{$current_user->nama}}">
							<span class="status online"></span></span>
							<span>{{ $current_user->nama }}</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{ route('profil')}}">Profil</a>
							<a class="dropdown-item" href="{{ route('gantiPassword')}}">Ganti Password</a>
							<a class="dropdown-item" href="{{ route('adminLogout')}}">Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="index.html#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{ route('profil')}}">Profil</a>
						<a class="dropdown-item" href="{{ route('gantiPassword')}}">Ganti Password</a>
						<a class="dropdown-item" href="{{ route('adminLogout')}}">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            @include('admin.includes.sidebarv2')
			<!-- /Sidebar -->
			
            @yield('content')
			
        </div>
		<!-- /Main Wrapper -->

        @include('admin.includes.footer')		
        <!-- jQuery -->

		<!-- Bootstrap Core JS -->
        
        <!-- Chart JS -->
        
        <!-- Custom JS -->