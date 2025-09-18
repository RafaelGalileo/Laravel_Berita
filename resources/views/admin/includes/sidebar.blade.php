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

				@if (Session::get('admin_page') == 'kategori')
					@php $active = "active" @endphp
						@else
					@php $active = "" @endphp
				@endif
				<li class="{{ $active }}">
					<a href="{{ route('kategori.index') }}"><i class="la la-dropbox"></i> <span> Kategori</span></a>
				</li>

				@if (Session::get('admin_page') == 'berita')
					@php $active = "active" @endphp
						@else
					@php $active = "" @endphp
				@endif

				<li class="{{ $active }}">
					<a href="{{ route('index.berita') }}"><i class="la la-newspaper-o"></i> <span> Kelola Berita</span></a>
				</li>

				@if (Session::get('admin_page') == 'theme')
					@php $active = "active" @endphp
						@else
					@php $active = "" @endphp
				@endif

				<li class="{{ $active }}">
					<a href="{{ route('theme') }}"><i class="la la-cogs"></i> <span>Pengaturan</span></a>
				</li>

			</ul>
		</div>
	</div>
</div>
<!-- /Sidebar -->