<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function editUsername(Request $request)
    {
        $data = request()->validate([
            "username" => ["required"],
        ]);

        $user = User::where('id_user', $request->input('id_user'))->first();

        if ($user) {
            $user->fill($data);
            $user->save();
            return response()->json(['success' => true, 'pesan' => 'Username berhasil diupdate']);
        } else {
            return response()->json(['success' => false, 'pesan' => 'Gagal mengupdate Username ']);
        }
    }

    public function editPassword(Request $request)
    {
        $data = request()->validate([
            "password" => ["required"],
        ]);

        $user = User::where('id_user', $request->input('id_user'))->first();

        if ($user) {

            $data['password'] = Hash::make($data['password']);
            $user->fill($data);
            $user->save();

            return response()->json(['success' => true, 'pesan' => 'password berhasil diupdate']);
        } else {
            return response()->json(['success' => false, 'pesan' => 'Gagal mengupdate password ']);
        }
    }

    public function editFotoProfil(Request $request)
    {
        $data = request()->validate([
            'foto_profil' => ['required'],
        ]);

        $user = User::where('id_user', $request->input('id_user'))->first();

        if ($user) {
            if ($request->hasFile('foto_profil')) {
                $path = $request->file('foto_profil')->storePublicly('foto_profil', 'public');
                $data['foto_profil'] = $path;
                $user->foto_profil = $path;
            }

            $user->update($data);

            return response()->json(['success' => true, 'pesan' => 'Foto Profil berhasil diupdate']);
        } else {
            return response()->json(['success' => false, 'pesan' => 'Gagal mengupdate Foto Profil ']);
        }
    }
}
