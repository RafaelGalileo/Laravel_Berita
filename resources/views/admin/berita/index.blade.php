@extends('admin.includes.tampilan_admin')

@section('title') Konten Berita - {{ config('app.name', 'Laravel') }} @endsection

@section('content')

    			
	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col">
						<h3 class="page-title">Konten Berita</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
							<li class="breadcrumb-item active">Berita</li>
						</ul>
					</div>

					<div class="col-auto float-right ml-auto">
						<a href="{{ route('tambah.berita') }}" class="btn add-btn"><i class="fa fa-plus-circle"></i>Tambah</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			@include('admin.includes._pesan')
			
			<div class="row">
				<div class="col-sm-12">
					<div class="card mb-0">
						
						<div class="card-body">

							<div class="table-responsive">
								<table class="datatable table table-stripped mb-0">
									<thead>
										<tr>
											<th>No.</th>
											<th>Gambar</th>
											<th>Judul Berita</th>
											<th>Penulis</th>
											<th>Kategori</th>
											<th>Dilihat</th>
											<th>Status</th>
											<th>Diperbaharui</th>
											<th>Aksi</th>
										</tr>
									</thead>
										<tbody>
										@foreach($berita as $data)
										<tr>
											<td>{{ $loop->index + 1 }}</td>
											<td>
												<img src="{{ asset('uploads/berita/'.$data->gambar) }}" alt="" width="200px">
											</td>
											<td>{{ $data->judul_berita }}</td>
											<td> {{$data->admin->nama}}</td>
											<td>{{ $data->kategori->nama_kategori }}</td>
											<td>{{ $data->dilihat }}</td>
											<td>
											@if ($data->status == 1)
												<span class="badge badge-success">Diterbitkan</span>
												@else
												<span class="badge badge-danger">Konsep</span>
											@endif
											</td>
											<td>{{ $data->updated_at->diffForHumans() }}</td>
											<td>
														<a href="{{ route('edit.berita', $data->id) }}" class="btn btn-info btn-sm" title="Edit">
															<i class="la la-edit"></i>
														</a>
														<a href="javascript:" class="btn btn-danger btn-sm deleteRecord" rel="{{ $data->id }}" rel1="hapus-berita" title="Hapus">
															<i class="la la-trash"></i>
														</a>
													</td>
										</tr>
										@endforeach
										</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>			
	</div>
	<!-- /Page Wrapper -->

    @endsection

    @section('js')
        		<!-- Datatable JS -->
		<script src="{{ asset('admin/assets/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{ asset('admin/assets/js/dataTables.bootstrap4.min.js')}}"></script>

		<script>
			$('body').on('click', '.deleteRecord', function (event){
				event.preventDefault();
				var SITEURL = '{{ URL::to('') }}';
				var id = $(this).attr('rel');
				var deleteFunction = $(this).attr('rel1');
				swal({
					title: 'Anda Yakin?',
					text: "Data yang dihapus tidak dapat dikembalikan!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					// confirmButtonColor: "#00ff55",
					// cancelButtonColor: "#999999",
					ReverseButton: true,
					cancelButtonText: 'Batal',
					confirmButtonText: 'Ya, Hapus!'
				},
					function(){
						window.location.href = SITEURL+ "/admin/" + deleteFunction + "/" + id;
					});
			});
		</script>
    @endsection