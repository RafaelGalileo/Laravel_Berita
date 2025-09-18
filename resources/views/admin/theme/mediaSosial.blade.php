@extends('admin.includes.tampilan_adminv2')

@section('title') Medsos - {{ config('app.name', 'Laravel') }} @endsection
@section('content')

<!-- Page Wrapper -->
            <div class="page-wrapper">
				@include('admin.includes._pesan')
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
							<form method="post" action="{{ route('medsosUpdate', $medsos->id) }}">
								@csrf
								<h4 class="page-title">Pengaturan Media Sosial</h4>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Facebook URL</label>
											<input class="form-control" type="url" name="facebook" value="{{$medsos->facebook}}">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>Twitter URL</label>
											<input class="form-control" type="url" name="twitter" value="{{$medsos->twitter}}">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>e-Mail URL</label>
											<input class="form-control" type="url" name="email" value="{{$medsos->email}}">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>Instagram URL</label>
											<input class="form-control" type="url" name="instagram" value="{{$medsos->instagram}}">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>Youtube URL</label>
											<input class="form-control" type="url" name="youtube" value="{{$medsos->youtube}}">
										</div>
									</div>
								</div>
								
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Simpan &amp; Update</button>
								</div>
							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
            </div>
<!-- /Page Wrapper -->

@endsection

