@extends('admin.includes.tampilan_admin')

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
                                <h3 class="page-title">Profile Admin</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    {{-- Pesan Validasi --}}
                    @include('admin.includes._pesan')
                    
                    <form method="post" action="{{ route('updateprofil', $admin->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="nama" value="{{ $admin->nama }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Alamat Email</label>
                                    <input class="form-control is-valid" name="email" type="email" value="{{ $admin->email }}" disabled>
                                    <div class="valid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control " type="text" name="alamat" value="{{ $admin->alamat }}">
                                </div>
                            </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input class="form-control " name="no_telp" type="text" value="{{ $admin->no_telp }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Foto Profil</label>
                                    <input class="form-control " name="foto" type="file" accept="image/*" onchange="readURL(this)">
                                </div>
                                <img src="{{ asset('public/uploads/'.$admin->foto) }}" alt="digitalrutengsnoop" width="150" id="one">
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
    <script>
        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $("#one").attr('src', e.target.result).width(150)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection