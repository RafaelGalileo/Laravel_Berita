<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminLoginController extends Controller
{
    //Login Admin
    public function adminLogin(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // validasi datanya
            $rules = [
                'email' => 'required|email|max:50',
                'password' => 'required'
            ];
            $pesan = [
                'email.required' => 'Email Wajib diisi!',
                'email.email' => 'Alamat Email tidak Valid',
                'email.max' => 'Alamat Email tidak boleh melebihi dari 50 karakter',
                'password.required' => 'Password wajib diisi!',
            ];
            $this->validate($request, $rules, $pesan);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->route('adminDashboard');
            } else {
                Session::flash('peringatan', 'Username atau Kata Sandi Salah!');
                return redirect()->route('adminLogin');
            }
        }
        if (Auth::guard('admin')->check()) {
            return redirect()->route('adminDashboard');
        } else {
            return view('admin.login');
        }
    }

    //Lupa Password
    public function forgetPassword()
    {
        return view('admin.forgetPassword');
    }

    // dashboard Admin
    public function adminDashboard()
    {
        Session::put('admin_page', 'dashboard');
        return view('admin.dashboard');
    }

    // Admin Logout
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        Session::flash('pesan_sukses', 'Terima kasih Admin, anda telah logout.');
        return redirect()->route('adminLogin');
    }

    // Profil Admin
    public function profil()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profil', compact('admin'));
    }
    // Profil Update
    public function updateprofil(Request $request, $id)
    {
        $data = $request->all();
        // validasi data
        $validasiData = $request->validate([
            'nama' => 'required'
        ]);
        $admin_id = Auth::guard('admin')->user()->id;
        $admin = Admin::findOrFail($id);
        $admin->nama = $data['nama'];
        $admin->alamat = $data['alamat'];
        $admin->no_telp = $data['no_telp'];

        $random = Str::random(20);
        if ($request->hasFile('foto')) {
            $image_tmp = $request->file('foto');
            if ($image_tmp->isValid()) {
                $ekstensi = $image_tmp->getClientOriginalExtension();
                $nama_file = $random . '.' . $ekstensi;
                $image_path = 'public/uploads/' . $nama_file;
                Image::make($image_tmp)->save($image_path);
                $admin->foto = $nama_file;
            }
        }

        $admin->save();
        Session::flash('pesan_sukses', 'Data Profil Admin telah diubah');
        return redirect()->back();
    }

    // Ganti Password
    public function gantiPassword()
    {
        $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.gantiPassword', compact('admin'));
    }

    // cek password
    public function cekPassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_password'];
        $user_id = Auth::guard('admin')->user()->id;
        $cek_password = Admin::where('id', $user_id)->first();
        if (Hash::check($current_password, $cek_password->password)) {
            return "true";
            die;
        } else {
            return "false";
            die;
        }
    }

    // update password
    public function updatePassword(Request $request, $id)
    {
        // validasi data
        $validasiData = $request->validate([
            'current_password' => 'required|max:255',
            'password' => 'min:8',
            'konfir_pass' => 'required_with:password|same:password|min:8'
        ]);
        $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $current_admin_password = $admin->password;
        $data = $request->all();
        if (Hash::check($data['current_password'], $current_admin_password)) {
            $admin->password = bcrypt($data['password']);
            $admin->save();
            Session::flash('pesan_sukses', 'Password berhasil diubah');
            return redirect()->back();
        } else {
            Session::flash('peringatan', 'Kata Sandi lama tidak cocok/tidak terdaftar');
            return redirect()->back();
        }
    }
}
