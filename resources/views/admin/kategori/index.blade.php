@extends('admin.includes.tampilan_admin')

@section('title') Semua Kategori - {{ config('app.name', 'Laravel') }} @endsection

@section('content')

    			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Semua Kategori</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
									<li class="breadcrumb-item active">Kategori</li>
								</ul>
							</div>

                            <div class="col-auto float-right ml-auto">
								<a href="{{ route('kategori.tambah') }}" class="btn add-btn"><i class="fa fa-plus-circle"></i>Tambah</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card mb-0">
								
								<div class="card-body">

									<div class="table-responsive">
										<table class="datatable table table-stripped mb-0">
											<thead>
												<tr>
													<th>ID</th>
													<th>Nama Kategori</th>
													<th>Kategori Induk</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</thead>
                                                <tbody>
													@foreach($kategoris as $kategori)
												<tr>
													<td>{{ $loop->index + 1 }}</td>
													<td>{{ $kategori->nama_kategori }}</td>
													<td>
														@if ($kategori->parent_id == 0)
															Kategori Utama
														@else
														   {{ $kategori->subKategori->nama_kategori }}
														@endif
													</td>
													<td>
														@if( $kategori->status ==1 )
															<p><a href="#" class="text-success">Aktif</a></p>
														@else
															<p><a href="#" class="text-danger">Tidak Aktif</a></p>
														@endif
													</td>
													<td>
														<a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-info btn-sm" title="Edit">
															<i class="la la-edit"></i>
														</a>
														<a href="javascript:" class="btn btn-danger btn-sm deleteRecord" rel="{{ $kategori->id }}" rel1="hapus-kategori" title="Hapus">
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