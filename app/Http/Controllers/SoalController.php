<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\Jawaban;
use App\Models\Kategori;
use App\Models\Kuis;
use App\Models\Setting;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SoalController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $uuidkuis = $request->input('uuidkuis');
            $kuis = Kuis::where('uuid', $uuidkuis)->first();
            $customcss = '';
            $settings = ['title' => ': Buat Soal',
                        'customcss' => $customcss,
                        'pagetitle' => 'Buat Soal',
                        'subtitle' => 'Buat Soal',
                        'navactive' => '',
                        'baractive' => '',
                        'prevpage' => route('kuis.show', ['kui' => $kuis->id])];
            $jmlsetting = Setting::where('group', 'env')->get();
                        foreach ($jmlsetting as $i => $set) {
                            $settings[$set->setname] = $set->value;
                        }

            return view('auth.guru.games.soal-manage-create', [
                'kuis' => $kuis,
                $settings['navactive'] => '-active-links',
                $settings['baractive'] => 'active',
                'stgs' => $settings]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', 'tidak ada kuis tersebut');
        }
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

            // dd($content);

            // // Validasi data jika diperlukan
            // $validatedData = $request->validate([
            //     'id_kuis' => 'required',
            // ]);

            // Lakukan pembaruan data soal
            $soal = New Soal([
                'id_kuis' => $request->id_kuis,
                'soal' => $content,
            ]);
            $soal->save();

            $newSoal = Soal::find($soal->id);
            // Berhasil, kirim response
            return response()->json(['message' => 'Soal berhasil dibuat.', 'data' => $newSoal]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Fail', 'error' => $e]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function show(Soal $soal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function edit(Soal $soal)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Soal',
                     'customcss' => $customcss,
                     'pagetitle' => 'Soal',
                     'subtitle' => 'Soal',
                     'navactive' => 'soalnav',
                     'baractive' => 'soalbar',
                     'prevpage' => route('kuis.show', ['kui' => $soal->kuis->id])];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $audios = Audio::where('id_soal', $soal->id)->get();

        $jawabans = Jawaban::where('id_soal', $soal->id)->get();

        return view('auth.guru.games.soal-manage-edit', [
            'soal' => $soal,
            'audios' => $audios,
            'jawabans' => $jawabans,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    public function addAudio(Request $request, Soal $soal)
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
                'id_soal' => $soal->id, // ID Soal yang dikaitkan dengan audio
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

    public function addJawaban(Request $request, Soal $soal)
    {
        try {
            if ($request->jenis == 'text') {
                $validatedData = $request->validate([
                    'caption' => 'required',
                    'jenis' => 'required|in:text',
                ]);

                $jawaban = new Jawaban([
                    'id_soal' => $soal->id,
                    'jenis' => 'text',
                    'jawaban' => $validatedData['caption'],
                ]);
                $jawaban->save();

                // Ambil data jawaban yang baru ditambahkan
                $newJawaban = Jawaban::find($jawaban->id);

                return response()->json(['message' => 'File Jawaban berhasil diunggah.', 'data' => $newJawaban]);
            } else {
                // Validasi data jika diperlukan
                $validatedData = $request->validate([
                    'files' => 'required|max:5120', // Max 5 MB (5120 kilobytes)
                    'jenis' => 'required|in:gambar,audio',
                ]);

                            // Ambil file jawaban dari request
                $jawabanFile = $request->file('files');

                $fileName = time() . '.' . $jawabanFile->getClientOriginalExtension();
                // Simpan file jawaban ke storage publik (public/storage/jawabans)
                $jawabanPath = $jawabanFile->storeAs('public/jawabans', $fileName, 'public');
                // Simpan informasi jawaban ke dalam database
                $jawaban = new Jawaban([
                    'id_soal' => $soal->id,
                    'jenis' => $validatedData['jenis'],
                    'jawaban' => $fileName
                ]);
                $jawaban->save();

                // Ambil data jawaban yang baru ditambahkan
                $newJawaban = Jawaban::find($jawaban->id);

                return response()->json(['message' => 'File Jawaban berhasil diunggah.', 'data' => $newJawaban]);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengunggah file.', 'message' => $th->getMessage()], 500);
        }
    }

    public function updateJawaban(Request $request, Soal $soal){
        try {
            $soal->jawaban_benar = $request->jawaban_benar;
            $soal->save();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengunggah file.', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Soal $soal)
    {
        try {

            // dd($content);
            // Validasi data jika diperlukan
            $validatedData = $request->validate([
                'content' => 'required|max:8388608',
            ]);

            $content = $request->input('content');

            // Lakukan pembaruan data soal
            $soal->soal = $content;
            $soal->save();

            $newSoal = Soal::find($soal->id);
            // Berhasil, kirim response
            return response()->json(['message' => 'Soal berhasil dibuat.', 'data' => $newSoal]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Fail', 'error' => $e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soal  $soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Soal $soal)
    {
        try {
            // Hapus materi
            $soal->delete();

            return response()->json(['message' => 'Materi berhasil dihapus.']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus Kuis.', 'message' => $th->getMessage()], 500);
        }
    }
}
