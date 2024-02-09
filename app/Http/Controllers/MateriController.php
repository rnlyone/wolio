<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\Kategori;
use App\Models\Materi;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $uuidkategori = $request->input('uuidkategori');
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Kategori',
                     'customcss' => $customcss,
                     'pagetitle' => 'Kategori',
                     'subtitle' => 'Kategori',
                     'navactive' => 'materinav',
                     'baractive' => 'materibar',
                     'prevpage' => route('kategori.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $id_kategori = Kategori::where('uuid', $uuidkategori)->first()->id;
        $nama_kategori = Kategori::where('uuid', $uuidkategori)->first()->nama;

        $materis = Materi::where('id_kategori', $id_kategori)->get();

        return view('auth.materi', [
            'nama_kategori' => $nama_kategori,
            'materis' => $materis,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    public function showkategori()
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Kategori',
                     'customcss' => $customcss,
                     'pagetitle' => 'Kategori',
                     'subtitle' => 'Kategori',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('setting.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kategoris = Kategori::all();

        return view('auth.guru.materi-kategori-index', [
            'kategoris' => $kategoris,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    public function manage(Request $request)
    {
        $uuidkategori = $request->input('uuidkategori');
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Manajemen Materi',
                     'customcss' => $customcss,
                     'pagetitle' => 'Manajemen Materi',
                     'subtitle' => 'Manajemen Materi',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('materi.kategori')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $id_kategori = Kategori::where('uuid', $uuidkategori)->first()->id;
        $nama_kategori = Kategori::where('uuid', $uuidkategori)->first()->nama;

        $materis = Materi::where('id_kategori', $id_kategori)->get();

        return view('auth.guru.materi-manage-index', [
            'nama_kategori' => $nama_kategori,
            'materis' => $materis,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customcss = '';
        if ($request->input('uuidkategori') != null) {
            $uuidkategori = $request->input('uuidkategori');
            $settings = ['title' => ': Materi',
                     'customcss' => $customcss,
                     'pagetitle' => 'Materi',
                     'subtitle' => 'Materi',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('materi.manage', ['uuidkategori' => $uuidkategori])];
        }else {
            $settings = ['title' => ': Materi',
                     'customcss' => $customcss,
                     'pagetitle' => 'Materi',
                     'subtitle' => 'Materi',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('materi.kategori')];
        }
        $jmlsetting = Setting::where('group', 'env')->get();
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kategoris = Kategori::all();

        return view('auth.guru.materi-manage-create', [
            'kategoris' => $kategoris,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
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
        try {
            // Ambil konten dari request
            $content = $request->input('content');

            // Validasi data jika diperlukan
            $validatedData = $request->validate([
                'kategori' => 'required',
                'judul' => 'required',
            ]);

            // Lakukan pembaruan data materi
            $materi = New Materi([
                'id_kategori' => $validatedData['kategori'],
                'slug' => Str::of($validatedData['judul'])->slug('-'),
                'judul' => $validatedData['judul'],
                'konten' => $content,
                // Tambahkan kolom lain yang ingin diupdate jika ada
            ]);
            $materi->save();

            $newMateri = Materi::find($materi->id);
            // Berhasil, kirim response
            return response()->json(['message' => 'Materi berhasil dibuat.', 'data' => $newMateri]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->with('gagal', 'Ada yang Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Materi',
                     'customcss' => $customcss,
                     'pagetitle' => 'Materi',
                     'subtitle' => 'Materi',
                     'navactive' => 'materinav',
                     'baractive' => 'materibar',
                     'prevpage' => route('materi.index', ['uuidkategori' => $materi->kategori->uuid])];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $audios = Audio::where('id_materi', $materi->id)->get();

        try {
            $other['prev'] = Materi::where('id', '<', $materi->id)->orderBy('id', 'desc')->first()->id;
        } catch (\Throwable $th) {
            $other['prev'] = null;
        }

        try {
            $other['next'] = Materi::where('id', '>', $materi->id)->orderBy('id', 'asc')->first()->id;
        } catch (\Throwable $th) {
            $other['next'] = null;
        }

        $latest = Materi::latest()->take(3)->get();

        return view('auth.materi-show', [
            'materi' => $materi,
            'other' => $other,
            'latest' => $latest,
            'audios' => $audios,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Materi',
                     'customcss' => $customcss,
                     'pagetitle' => 'Materi',
                     'subtitle' => 'Materi',
                     'navactive' => 'materinav',
                     'baractive' => 'materibar',
                     'prevpage' => route('materi.manage', ['uuidkategori' => $materi->kategori->uuid])];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $audios = Audio::where('id_materi', $materi->id)->get();

        $kategoris = Kategori::all();

        return view('auth.guru.materi-manage-edit', [
            'materi' => $materi,
            'kategoris' => $kategoris,
            'audios' => $audios,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        try {
            // Ambil konten dari request
            $content = $request->input('content');

            // Validasi data jika diperlukan
            $validatedData = $request->validate([
                'kategori' => 'required',
                'content' => 'required',
                'judul' => 'required',
            ]);

            // Lakukan pembaruan data materi
            $materi->update([
                'id_kategori' => $validatedData['kategori'],
                'slug' => Str::of($validatedData['judul'])->slug('-'),
                'judul' => $validatedData['judul'],
                'konten' => $content,
                // Tambahkan kolom lain yang ingin diupdate jika ada
            ]);

            // Berhasil, kirim response
            return response()->json(['message' => 'Data Materi berhasil diperbarui.']);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui data Materi.', 'mes' => $e], 500);
        }
    }


    /**
     * Update Audio the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function addAudio(Request $request, Materi $materi)
    {
        try {
            // Validasi data jika diperlukan
            $validatedData = $request->validate([
                'audio' => 'required|mimes:mp3,aac,wav|max:5120', // Max 5 MB (5120 kilobytes)
                'caption' => 'required',
            ]);

            // Ambil file audio dari request
            $audioFile = $request->file('audio');

            $fileName = time() . '.' . $audioFile->getClientOriginalExtension();
            // Simpan file audio ke storage publik (public/storage/audios)
            $audioPath = $audioFile->storeAs('public/audios', $fileName, 'public');
            // Simpan informasi audio ke dalam database
            $audio = new Audio([
                'id_materi' => $materi->id, // ID Materi yang dikaitkan dengan audio
                'audio' => $fileName,
                'caption' => $request->caption,
            ]);
            $audio->save();

            // Ambil data audio yang baru ditambahkan
            $newAudio = Audio::find($audio->id);

            return response()->json(['message' => 'File audio berhasil diunggah.', 'data' => $newAudio]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengunggah file audio.', 'message' => $th->getMessage()], 500);
        }
    }

    public function search(Request $request){
        $searchterm = $request->input('term');
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Kategori',
                     'customcss' => $customcss,
                     'pagetitle' => 'Kategori',
                     'subtitle' => 'Kategori',
                     'navactive' => 'materinav',
                     'baractive' => 'materibar',
                     'prevpage' => route('kategori.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $materis = Materi::all();

        return view('auth.materi-search', [
            'searchterm' => $searchterm,
            'materis' => $materis,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        try {
            // Hapus materi
            $materi->delete();

            return response()->json(['message' => 'Materi berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus materi.', 'message' => $th->getMessage()], 500);
        }
    }
}
