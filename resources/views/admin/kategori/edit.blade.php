@extends('admin.includes.tampilan_admin')

@section('title') Edit Kategori {{ $kategori->nama_kategori }} - {{ config('app.name', 'Laravel') }} @endsection

@section('content')

    			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col">
								<h3 class="page-title">Edit Kategori</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
									<li class="breadcrumb-item active">Kategori</li>
								</ul>
							</div>

                            <div class="col-auto float-right ml-auto">
								<a href="{{ route('kategori.index') }}" class="btn add-btn"><i class="fa fa-long-arrow-left"></i>Kembali</a>
							</div>
						</div>
					</div>

					@include('admin.includes._pesan')
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">

								<div class="card-body">
									<form action="{{ route('kategori.update', $kategori->id) }}" method="post">
										@csrf
										
										<div class="row">

											<div class="col-md-6">
												<div class="form-group">
													<label for="nama_kategori">Sub Kategori</label>
													<select name="parent_id" id="parent_id" class="form-control">
														<option value="0">Kategori Utama</option>
														@foreach ($kategoris as $data)
															<option value="{{ $data->id }}" @if($data->id == $kategori->parent_id) selected @endif>{{ $data->nama_kategori }}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="nama_kategori">Nama Kategori</label>
													<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}">
												</div>
											</div>

											<div class="col-md-12">
												<div class="form-group">
													<label for="nama_kategori">Deskripsi</label>
													<textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control">
														{{ $kategori->deskripsi }}
													</textarea>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" value="1" 
														name="status" id="status" @if($kategori->status == 1) checked @endif>
														<label class="form-check-label" for="invalidCheck">
															Tandai sebagai Status Aktif
														</label>
													</div>
												</div>
											</div>

										</div>

										<div class="text-left">
											<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
										</div>
									</form>
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
    @endsection