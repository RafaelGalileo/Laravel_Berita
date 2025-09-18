@extends('admin.includes.tampilan_adminv2')

@section('title') Tampilan - {{ config('app.name', 'Laravel') }} @endsection
@section('content')

    		<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Pengaturan Tampilan</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
                            
                            @include('admin.includes._pesan')

							<form method="post" action="{{ route ('themeUpdate', $theme->id)}}" enctype="multipart/form-data">
                                @csrf
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Nama Website</label>
									<div class="col-lg-9">
										<input name="judul_web" class="form-control" type="text" value="{{$theme->judul_web}}">
									</div>
								</div>
                                {{-- logo header --}}
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Logo Header</label>
									<div class="col-lg-5">
										<input type="file" class="form-control" name="logo_header">
										<span class="form-text text-muted">Ukuran yang direkomendasikan adalah 40px x 40px</span>
									</div>
									<div class="col-lg-4">
										<div class="img-thumbnail float-right"><img src="{{ asset('uploads/'.$theme->logo_header)}}" alt="" width="200" height="40"></div>
									</div>
								</div>
                                {{-- logo footer --}}
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Logo Footer</label>
									<div class="col-lg-5">
										<input type="file" class="form-control" name="logo_footer">
										<span class="form-text text-muted">Ukuran yang direkomendasikan adalah 40px x 40px</span>
									</div>
									<div class="col-lg-4">
										<div class="img-thumbnail float-right"><img src="{{ asset('uploads/'.$theme->logo_footer)}}" alt="" width="200" height="40"></div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Favicon</label>
									<div class="col-lg-7">
										<input type="file" class="form-control" name="favicon">
										<span class="form-text text-muted">Ukuran yang direkomendasikan adalah 16px x 16px</span>
									</div>
									<div class="col-lg-2">
										<div class="settings-image img-thumbnail float-right"><img src="{{ asset('uploads/'.$theme->favicon)}}" class="img-fluid" width="16" height="16" alt=""></div>
									</div>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Simpan</button>
								</div>
							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
            </div>
			<!-- /Page Wrapper -->
@endsection


@section('js')
    
@endsection