<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ThemeController extends Controller
{
    // kelola tema
    public function theme()
    {
        Session::put('admin_page', 'theme');
        $theme = Theme::first();
        return view('admin.theme.theme', compact('theme'));
    }

    // update tema
    public function themeUpdate(Request $request, $id)
    {
        $data = $request->all();
        $theme = Theme::findOrFail($id);
        $theme->judul_web = $data['judul_web'];

        // header logo
        $slug = str::slug($data['judul_web']);
        $random = rand(1, 999999);
        if ($request->hasFile('logo_header')) {
            $image_tmp = $request->file('logo_header');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $slug . '-' . $random . '.' . $extension;
                $image_path = 'public/uploads/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $theme->logo_header = $filename;
            }
        }

        // footer logo
        $slug = "logo-footer";
        $random = rand(1, 999999);
        if ($request->hasFile('logo_footer')) {
            $image_tmp = $request->file('logo_footer');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $slug . '-' . $random . '.' . $extension;
                $image_path = 'public/uploads/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $theme->logo_footer = $filename;
            }
        }

        // favicon
        $slug = "favicon";
        $random = rand(1, 999999);
        if ($request->hasFile('favicon')) {
            $image_tmp = $request->file('favicon');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $slug . '-' . $random . '.' . $extension;
                $image_path = 'public/uploads/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $theme->favicon = $filename;
            }
        }

        $theme->save();
        Session::flash('pesan_sukses', 'Tampilan Berhasil Diubah');
        return redirect()->back();
    }
}
