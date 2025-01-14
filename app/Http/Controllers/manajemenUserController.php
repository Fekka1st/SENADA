<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
class manajemenUserController extends Controller
{
    //
    public function index()
    {
        $title = "Hapus Data!";
        $text = "Kamu Yakin Mau Hapus Data?";
        confirmDelete($title, $text);

        $user = User::latest()->get();
        return view("Manajemen-User.index", compact("user"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "password" => "required",
            "email" => "required",
            "role" => "required",
            "foto" => "required|image|mimes:jpeg,jpg,png|max:2048",
        ]);
        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0]);
        }
        try {
            $filename =
            round(microtime(true) * 1000) .
            "-" .
            str_replace(
                " ",
                "-",
                $request->file("foto")->getClientOriginalName()
            );
        $request->file("foto")->move(public_path("img/profile"), $filename);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => $request->role,
            "foto_url" => "/img/profile/" . $filename,
        ]);
        // Alert::success('Success Title', 'Success Message');
        return redirect("manajemen-user")->with('success','Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
        return redirect("manajemen-user")->with('errors','Error'.$th);
        }

    }
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "nullable|min:6",
            "role" => "required"
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if ($request->filled("password")) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile("foto")) {
                $data = User::find($id);
                $oldFilePath = public_path($data->foto_profile);

                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }

                $filename =
                    round(microtime(true) * 1000) . "-" .
                    str_replace(
                        " ",
                        "-",
                        $request->file("foto")->getClientOriginalName()
                    );
                $request->file("foto")->move(public_path("img/profile"), $filename);
                $user->foto_profile = "/img/profile/" . $filename;
            }

            $user->save();

            return redirect("manajemen-user")->with('success', 'Data berhasil dirubah!');
        } catch (\Exception $e) {
            return redirect("manajemen-user")->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $userCount = User::count();
        if ($userCount <= 1) {
            return redirect("manajemen-user")->with(
                'error', 'Tidak bisa menghapus data, karena hanya ada satu pengguna.'
            );
        }
        $data = User::find($id);
        if ($data) {
            if ($data->foto_url) {
                $oldFilePath = public_path($data->foto_url);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $data->delete();
            return redirect("manajemen-user")->with(
                'success', 'Data berhasil dihapus.'
            );
        }
        return redirect("manajemen-user")->with(
            'error', 'Pengguna tidak ditemukan.'
        );
    }
}
