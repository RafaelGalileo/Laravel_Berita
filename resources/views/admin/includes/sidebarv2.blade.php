<!-- Sidebar -->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>
				@if (Session::get('admin_page') == 'dashboard')
					@php $active = "active" @endphp
						@else
					@php $active = "" @endphp
				@endif
				<li class="{{ $active }}">
					<a href="{{ route('adminDashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
				</li>

				@if (Session::get('admin_page') == 'theme')
					@php $active = "active" @endphp
						@else
					@php $active = "" @endphp
				@endif
				<li class="{{ $active }}">
					<a href="{{ route('theme') }}"><i class="la la-photo"></i> <span>Pengaturan Tampilan</span></a>
				</li>

				@if (Session::get('admin_page') == 'medsos')
					@php $active = "active" @endphp
						@else
					@php $active = "" @endphp
				@endif
				<li class="{{ $active }}">
					<a href="{{ route('medsos') }}"><i class="la la-share-alt-square"></i> <span>Pengaturan Medsos</span></a>
				</li>

			</ul>
		</div>
	</div>
</div>
<!-- /Sidebar -->