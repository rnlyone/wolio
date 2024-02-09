<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Setting;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Buat Kelas',
                     'customcss' => $customcss,
                     'pagetitle' => 'Buat Kelas',
                     'subtitle' => 'Buat Kelas',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('setting.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kelases = Kelas::all();

        return view('auth.guru.kelas-manage-index', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'kelases' => $kelases,
        'stgs' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Buat Kelas',
                     'customcss' => $customcss,
                     'pagetitle' => 'Buat Kelas',
                     'subtitle' => 'Buat Kelas',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kelas.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kelases = Kelas::all();

        return view('auth.guru.kelas-manage-create', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'kelases' => $kelases,
        'stgs' => $settings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'tingkat' => 'required|integer|between:1,6',
            'nama_kelas' => 'required|string|max:255',
        ]);

        // Membuat objek Kelas dan menyimpan data ke dalam database
        $kelas = new Kelas();
        $kelas->tingkat = $validatedData['tingkat'];
        $kelas->nama_kelas = $validatedData['nama_kelas'];
        $kelas->save();

        // Redirect ke halaman yang sesuai setelah menyimpan data
        return redirect()->route('kelas.index')->with('sukses', 'Kelas berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kela)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Edit Kelas',
                     'customcss' => $customcss,
                     'pagetitle' => 'Edit Kelas',
                     'subtitle' => 'Edit Kelas',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kelas.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        return view('auth.guru.kelas-manage-edit', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'kelas' => $kela,
        'stgs' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'tingkat' => 'required|integer|between:1,6',
            'nama_kelas' => 'required|string|max:255',
        ]);

        // Membuat objek Kelas dan menyimpan data ke dalam database
        $kela->tingkat = $validatedData['tingkat'];
        $kela->nama_kelas = $validatedData['nama_kelas'];
        $kela->save();

        // Redirect ke halaman yang sesuai setelah menyimpan data
        return redirect()->route('kelas.index')->with('sukses', 'Kelas berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('kelas.index')->with('sukses', 'Kelas berhasil dihapus.');
    }
}
