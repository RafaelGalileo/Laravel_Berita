{{-- pesan validasi dari admincontroller --}}
								@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif

								@if (Session::has ('pesan_sukses'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									{{ Session::get('pesan_sukses') }}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								@endif

								@if (Session::has ('peringatan'))
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									{{ Session::get('peringatan') }}
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									
								@endif