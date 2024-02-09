<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kuis;
use App\Models\Riwayat;
use App\Models\Setting;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KuisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function play(Request $request)
    {
        $uuidkategori = $request->input('uuidkategori');
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Play',
                     'customcss' => $customcss,
                     'pagetitle' => 'Play',
                     'subtitle' => 'Play',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kategori.index', ['kuis' => '1'])
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kategori = Kategori::where('uuid', $uuidkategori)->first();

        $kuises = $kategori->kuises()
            ->whereHas('soals', function ($query) {
                $query->whereNotNull('jawaban_benar');
            })
            ->whereHas('soals.jawabans', function ($query) {
                $query->groupBy('id_soal')->havingRaw('COUNT(*) >= 2');
            })
            ->withCount('soals') // Menghitung jumlah soal pada setiap kuis
            ->having('soals_count', '>=', 5) // Memastikan ada minimal 5 soal
            ->inRandomOrder()
            ->get();


        $play = $kuises->first();

        return view('auth.games-play', [
            'play' => $play,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    public function ambilSoal(Request $request){
        try {
            $uuidkuis = $request->id_kuis;
            $kuis = Kuis::where('uuid', $uuidkuis)->first();

            if ($kuis) {
                // Jika kuis ditemukan, ambil soal random dari kuis tersebut
                $soalRandom = Soal::with(['jawabans' => function ($query) {
                    // Menghilangkan atribut "jawaban_benar" dari relasi jawabans
                    $query->select('id', 'id_soal', 'jenis', 'jawaban');
                }, 'audios' => function ($query) {
                    // Menghilangkan atribut "jawaban_benar" dari relasi audios
                    $query->select('id_soal', 'audio', 'caption');
                }])->where('id_kuis', $kuis->id)->inRandomOrder()->limit(5)->get();

                // Menghilangkan atribut "jawaban_benar" dari setiap soal
                $soalRandom->makeHidden(['jawaban_benar']);

                return response()->json(['data' => $soalRandom], 200);
            } else {
                // Jika kuis tidak ditemukan
                return response()->json(['message' => 'Kuis tidak ditemukan.'], 404);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'gagal.', 'error' => $th], 404);
        }
    }
public function kirim(Request $request)
{
    // Mendapatkan data dari request
    $data = $request->input('data');

    // Memeriksa apakah data sesuai dengan yang diharapkan
    if (!isset($data['pastSoal']) || !isset($data['answer'])) {
        return response()->json(['message' => 'Data tidak lengkap'], 400);
    }

    // Mendapatkan ID user yang sedang login
    $userId = Auth::id();

    // Memeriksa jawaban benar dari setiap soal
    $jumlahBenar = 0;
    foreach ($data['pastSoal'] as $index => $soalId) {
        $jawabanBenar = Soal::find($soalId)->jawaban_benar;
        if ($jawabanBenar == $data['answer'][$index]) {
            $jumlahBenar++;
        }
    }

    // Menyimpan hasil kuis ke dalam database
    $riwayat = Riwayat::create([
        'uuid' => Str::uuid(),
        'id_user' => $userId,
        'id_kuis' => $data['id_kuis'],
        'jumlah_benar' => $jumlahBenar,
        'jumlah_salah' => 5 - $jumlahBenar, // Jumlah soal - jumlah benar
    ]);

    return response()->json(['message' => 'Kuis berhasil dikirim', 'riwayat_uuid' => $riwayat->uuid], 200);
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

        return view('auth.guru.games.kuis-kategori-index', [
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
        $settings = ['title' => ': Manajemen kuis',
                     'customcss' => $customcss,
                     'pagetitle' => 'Manajemen kuis',
                     'subtitle' => 'Manajemen kuis',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kuis.kategori')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $id_kategori = Kategori::where('uuid', $uuidkategori)->first()->id;
        $nama_kategori = Kategori::where('uuid', $uuidkategori)->first()->nama;

        $kuises = kuis::where('id_kategori', $id_kategori)->get();

        return view('auth.guru.games.kuis-manage-index', [
            'nama_kategori' => $nama_kategori,
            'kuises' => $kuises,
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
            $settings = ['title' => ': Kuis',
                     'customcss' => $customcss,
                     'pagetitle' => 'Kuis',
                     'subtitle' => 'Kuis',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kuis.manage', ['uuidkategori' => $uuidkategori])];
        }else {
            $settings = ['title' => ': Kuis',
                     'customcss' => $customcss,
                     'pagetitle' => 'Kuis',
                     'subtitle' => 'Kuis',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kuis.kategori')];
        }
        $jmlsetting = Setting::where('group', 'env')->get();
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $kategoris = Kategori::all();

        return view('auth.guru.games.kuis-manage-create', [
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
            // Validasi data jika diperlukan
            $validatedData = $request->validate([
                'kategori' => 'required',
                'nama' => 'required',
            ]);

            // Lakukan pembaruan data kuis
            $kuis = New Kuis([
                'id_kategori' => $validatedData['kategori'],
                'uuid' => Str::uuid(),
                'nama' => $validatedData['nama'],
                // Tambahkan kolom lain yang ingin diupdate jika ada
            ]);
            $kuis->save();

            $newKuis = Kuis::find($kuis->id);
            // Berhasil, kirim response
            return response()->json(['message' => 'Kuis berhasil diunggah.', 'data' => $newKuis]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->with('gagal', 'Ada yang Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function show(Kuis $kui)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Manajemen kuis',
                     'customcss' => $customcss,
                     'pagetitle' => 'Manajemen kuis',
                     'subtitle' => 'Manajemen kuis',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kuis.manage', ['uuidkategori' => $kui->kategori->uuid])
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $soals = Soal::where('id_kuis', $kui->id)->get();

        return view('auth.guru.games.soal-manage-index', [
            'soals' => $soals,
            'kuis' => $kui,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function edit(Kuis $kui)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kuis $kui)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kuis  $kui
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuis $kui)
    {
        try {
            // Hapus materi
            $kui->delete();

            return response()->json(['message' => 'Materi berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus Kuis.', 'message' => $th->getMessage()], 500);
        }
    }
}
