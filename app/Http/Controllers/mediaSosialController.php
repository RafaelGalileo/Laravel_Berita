<?php

namespace App\Http\Controllers;

use App\Models\mediaSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mediaSosialController extends Controller
{
    //penaturan media sosial
    public function medsos()
    {
        Session::put('admin_page', 'medsos');
        $medsos = mediaSosial::first();
        return view('admin.theme.mediaSosial', compact('medsos'));
    }

    // update medsos
    public function medsosUpdate(Request $request, $id)
    {
        $medsos = mediaSosial::findOrFail($id);
        $data = $request->all();
        $medsos->facebook = $data['facebook'];
        $medsos->twitter = $data['twitter'];
        $medsos->email = $data['email'];
        $medsos->instagram = $data['instagram'];
        $medsos->youtube = $data['youtube'];
        $medsos->save();
        Session::flash('pesan_sukses', 'Pengaturan Media Sosial Telah Diubah');
        return redirect()->back();
    }
}
