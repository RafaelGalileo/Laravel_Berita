@extends('admin.includes.tampilan_admin')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Ganti Password</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    @include('admin.includes._pesan')
                    
                    <form method="post" action="{{ route('updatePassword', $admin->id) }}">
                        @csrf
                        <div class="form-group">
                            <label>Kata sandi lama <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="current_password" 
                                    placeholder="Masukan Kata Sandi yang Sekarang..." name="current_password">
                            <p id="correct_password">
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Kata sandi baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="konfir_pass"
                                    placeholder="Masukan Kata Sandi yang Baru..." name="password">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi kata sandi<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="pass"
                                    placeholder="Konfirmasikan Kata Sandi yang Baru..." name="konfir_pass">
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" type="submit">Ubah Password</button>
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
        $("#current_password").keyup(function(){
            var current_password = $("#current_password").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            type: 'post',
            url: 'cek_password',
            data: {
                current_password:current_password},
            success: function (resp) {
                if(resp =="true"){
                    $("#correct_password").text("Kata Sandi ini Cocok").css("color", "green");
                } else if (resp =="false"){
                    $("#correct_password").text("Kata Sandi Tidak Cocok").css("color", "rgb(185, 74, 72)");
                }
            }, error:function (resp) {
               alert("Error");
            }
            });
        });
    </script>
@endsection