<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kuis = $request->input('kuis');
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Kategori',
                     'customcss' => $customcss,
                     'pagetitle' => 'Kategori',
                     'subtitle' => 'Kategori',
                     'navactive' => 'materinav',
                     'baractive' => 'materibar',
                     'prevpage' => route('welcome')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kategoris = Kategori::all();

        if (isset($kuis)) {
            $settings = ['title' => ': Kategori Games',
                     'customcss' => $customcss,
                     'pagetitle' => 'Kategori Games',
                     'subtitle' => 'Kategori Games',
                     'navactive' => 'gamesnav',
                     'baractive' => 'gamesbar',
                     'prevpage' => route('welcome')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }
            return view('auth.kategori-games', [
                'kategoris' => $kategoris,
                $settings['navactive'] => '-active-links',
                $settings['baractive'] => 'active',
                'stgs' => $settings]);
        }



        return view('auth.kategori', [
            'kategoris' => $kategoris,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    public function manage(){
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Manajemen Kategori',
                     'customcss' => $customcss,
                     'pagetitle' => 'Manajemen Kategori',
                     'subtitle' => 'Manajemen Kategori',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('setting.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kategoris = Kategori::all();

        return view('auth.guru.kategori-manage-index', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'kategoris' => $kategoris,
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
        $settings = ['title' => ': Buat Kategori',
                     'customcss' => $customcss,
                     'pagetitle' => 'Buat Kategori',
                     'subtitle' => 'Buat Kategori',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kategori.manage')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kategoris = Kategori::all();

        return view('auth.guru.kategori-manage-create', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'kategoris' => $kategoris,
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
            'nama' => 'required|string|max:255',
        ]);

        // Membuat objek Kategori dan menyimpan data ke dalam database
        $kategori = new Kategori();
        $kategori->uuid = Str::uuid();
        $kategori->nama = $validatedData['nama'];
        $kategori->save();

        // Redirect ke halaman yang sesuai setelah menyimpan data
        return redirect()->route('kategori.manage')->with('sukses', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Edit Kategori',
                     'customcss' => $customcss,
                     'pagetitle' => 'Edit Kategori',
                     'subtitle' => 'Edit Kategori',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kategori.manage')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }



        return view('auth.guru.kategori-manage-edit', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'kategori' => $kategori,
        'stgs' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Membuat objek Kategori dan menyimpan data ke dalam database
        $kategori->nama = $validatedData['nama'];
        $kategori->save();

        // Redirect ke halaman yang sesuai setelah menyimpan data
        return redirect()->route('kategori.manage')->with('sukses', 'Kategori berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.manage')->with('sukses', 'Kategori berhasil dihapus.');
    }
}
