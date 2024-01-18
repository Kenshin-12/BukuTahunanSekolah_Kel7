<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'admin' => Admin::all(),
            'user' => User::all()
        ];
        return view('Admin.index', $data);
    }

    /**
     * Menampilkan halaman tambah pelatih
     */
    public function indexCreate()
    {
        return view('Admin.tambah');
    }

    /**
     * Menampilkan halaman detail pelatih
     */
    public function indexDetail(Request $request)
    {
        // $data = [
        //     'admin' => Admin::where('nik_admin', $request->id)->first()
        // ];

        // return view('Admin.detail', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $data = $request->validate([
            // Menambah ke tabel admin
            'nik_admin' => ['required'],
            'nama_admin' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],


            // Menambah ke tabel user
            'username' => ['required'],
            'password' => ['required'],
            'role' => ['required'],
            'foto_profil' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        //Upload foto profil
        $path = $request->file("foto_profil")->storePublicly("foto_profil", "public");
        $data['foto_profil'] = $path;

        //hash password
        $data['password'] = Hash::make($data['password']);

        DB::transaction(function () use ($data) {
            $user = new User([
                'username' => $data['username'],
                'nama_admin' => $data['nama_admin'],
                'nik_admin' => $data['nik_admin'],
                'password' => $data['password'],
                'role' => $data['role'],
                'foto_profil' => $data['foto_profil']
            ]);

            $user->save();

            $admin = new Admin($data);
            $admin->id_user = $user->id_user;
            $admin->save();
        });

        return redirect('/admin')
            ->with('success', 'User baru berhasil ditambahkan!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $pelatih)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $data = $request->validate([
            'nama_admin' => ['required'],
            // 'nik_admin' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],
        ]);

        $admin = Admin::where('nik_admin', $request->input('nik_admin'))->first();
        $admin->fill($data);
        $admin->save();

        return redirect()->to('/admin')->with('success', 'Admin Berhasil Diupdate');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $pelatih)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Admin $admin, Request $request)
    {
        //

        $nik = $request->id;

        $admin = Admin::where('nik_admin', $nik)->first();

        if ($admin) {

            // //hapus foto profil
            if ($admin->user->foto_profil) {
                Storage::disk('public')->delete($admin->user->foto_profil);
            }

            //menghapus admin
            $admin->delete();

            //menghapus user
            $user = User::where('id_user', $admin->id_user)->first();
            if ($user) {
                $user->delete();
            }

            $pesan = [
                'success' => true,
                'pesan' => 'Admin Berhasil Dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Admin Gagal Dihapus'
            ];
        }

        return response()->json($pesan);
    }
}
