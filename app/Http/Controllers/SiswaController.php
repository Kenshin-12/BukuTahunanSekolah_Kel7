<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //mengirimkan data ke view dengan isi array data user dan pemain
        $data = [
            'siswa' => Siswa::all(),
            'user' => User::all()
        ];
        return view('Pemain.index', $data);
    }

    /**
     * Menampilkan halaman tambah pemain
     */
    public function indexCreate()
    {
        return view('Pemain.tambah');
    }

    /**
     * Menampilkan halaman detail pemain
     * mengirimkan data ke view dengan isi array data user dan pemain
     */
    public function indexDetail(Request $request)
    {
        $data = [
            'pemain' => Siswa::where('nisn_siswa', $request->id)->first()
        ];

        return view('Siswa.detail', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $data = $request->validate([
            // Menambah ke tabel pemain
            'nisn_siswa' => ['required'],
            'nama_siswa' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'alamat' => ['required'],
            'deskripsi_siswa' => ['nullable'],

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

        // Get the current user
        // $user = Auth::user();

        //menggabungkan data pemain dan user
        DB::transaction(function () use ($data) {
            $user = new User([
                'username' => $data['username'],
                'password' => $data['password'],
                'role' => $data['role'],
                'foto_profil' => $data['foto_profil']
            ]);

            $user->save();

            $pemain = new Siswa($data);
            $pemain->id_user = $user->id_user;
            $pemain->save();
        });

        return redirect('/siswa')
            ->with('success', 'User baru berhasil ditambahkan!');
    }

    /**
     * edit the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $data = $request->validate([
            'nama_pemain' => ['required'],
            'alamat' => ['required'],
            'no_telp' => ['required'],
            'email' => ['required'],
            'deskripsi_pemain' => ['nullable']
        ]);

        $pemain = Siswa::where('nisn_siswa', $request->input('nisn_siswa'))->first();
        $pemain->fill($data);
        $pemain->save();

        return redirect()->to('/siswa')->with('success', 'Siswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Siswa $siswa, Request $request)
    {
        //

        $nisn = $request->id;

        $siswa = Siswa::where('nisn_siswa', $nisn)->first();

        if ($siswa) {

            //hapus foto profil
            if ($siswa->user->foto_profil) {
                Storage::disk('public')->delete($siswa->user->foto_profil);
            }

            //menghapus pemain
            $siswa->delete();

            //menghapus user
            $user = User::where('id_user', $siswa->id_user)->first();
            if ($user) {
                $user->delete();
            }

            $pesan = [
                'success' => true,
                'pesan' => 'siswa Berhasil Dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'siswa Gagal Dihapus'
            ];
        }

        return response()->json($pesan);
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
    // public function show(Pemain $pemain)
    // {
    //     //
    // }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Siswa $siswa)
    // {
    //     //
    // }

    // public function cetaksiswa()
    // {
    //     $data = [
    //         'siswa' => Siswa::get(),
    //         'user' => User::get(),
    //         'tim' => Tim::get()
    //     ];
    //     return view('siswa.cetak', $data);
    // }

    // public function print()
    // {
    //     $data = Siswa::limit(10)->get();
    //     $pdf = PDF::loadView('siswa.cetak', compact('data'));
    //     $pdf->setPaper('A4', 'landscape');
    //     return $pdf->stream('daftar-siswa.pdf');
    // }
}
