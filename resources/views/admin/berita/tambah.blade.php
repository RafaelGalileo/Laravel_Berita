@extends('admin.includes.tampilan_admin')

@section('title') Tambah Berita - {{ config('app.name', 'Laravel') }} @endsection

@section('content')

    			
	<!-- Page Wrapper -->
	<div class="page-wrapper">
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col">
						<h3 class="page-title">Tambah Berita</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
							<li class="breadcrumb-item active">Berita</li>
						</ul>
					</div>

					<div class="col-auto float-right ml-auto">
						<a href="{{ route('index.berita') }}" class="btn add-btn"><i class="fa fa-long-arrow-left"></i>Kembali</a>
					</div>
				</div>
			</div>

			@include('admin.includes._pesan')
			<!-- /Page Header -->
			
			<div class="row">
				<div class="col-md-12">
					<div class="card">

						<div class="card-body">
							<form action="{{ route('berita.store') }}" method="post" enctype="multipart/form-data">
								@csrf
								
								<div class="text-center">
									<img src="" alt="" width="200px" id="one" style="...">
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="id_kategori">Sub Kategori</label>
											<select name="id_kategori" id="id_kategori" class="form-control">
												@php echo $kategoris_dropdown @endphp
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="gambar">Foto</label>
											<input class="form-control " name="gambar" type="file" accept="image/*" onchange="readURL(this)">
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group">
											<label>Judul Berita</label>
											<input class="form-control" type="text" name="judul_berita">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="konten_berita">Deskripsi Berita</label>
											<textarea name="konten_berita" id="konten_berita" cols="30" rows="10" class="form-control"></textarea>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<div class="form-check" data-children-count="1">
												<input class="form-check-input" type="checkbox" value="1" name="status" id="status" checked>
												<label class="form-check-label" for="invalidCheck">
													Tandai sebagai Status Aktif
												</label>
											</div>
										</div>
									</div>

								</div>

								<hr>
								<h4 class="text uppercase">
									KELOLA SEO
								</h4>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="seo_title">SEO Title</label>
											<input name="seo_title" id="seo_title" class="form-control"></input>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="seo_subtitle">SEO Sub Title</label>
											<input name="seo_subtitle" id="seo_subtitle" class="form-control"></input>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="seo_keywords">SEO Keywords</label>
											<input name="seo_keywords" id="seo_keywords" class="form-control"></input>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="seo_deskripsi">SEO Description</label>
											<input name="seo_deskripsi" id="seo_deskripsi" class="form-control"></input>
										</div>
									</div>
								</div>

								<div class="text-left">
									<button type="submit" class="btn btn-primary">Tambahkan</button>
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

		<script>
        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $("#one").attr('src', e.target.result).width(300)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    	</script>

		<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
		<script type="text/javascript">
			CKEDITOR.replace('konten_berita', {
				filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
				filebrowserUploadMethod: 'form'
				});
		</script>
    @endsection