<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Setting;
use Illuminate\Http\Request;

class RiwayatController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Hasil Kuis',
                     'customcss' => $customcss,
                     'pagetitle' => 'Hasil Kuis',
                     'subtitle' => 'Hasil Kuis',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('kategori.index', ['kuis' => '1'])
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $uuid = $request->input('uuid');
        $riwayat = Riwayat::where('uuid', $uuid)->first();

        if ($riwayat->jumlah_benar == 5) {
            $caption = "KAMU SEMPURNA!!";
        } elseif ($riwayat->jumlah_benar == 4) {
            $caption = "HEBAT, SEDIKIT LAGI!!";
        } elseif ($riwayat->jumlah_benar == 3) {
            $caption = "SEMANGAT!!";
        } elseif ($riwayat->jumlah_benar == 2) {
            $caption = "LUMAYAN!!";
        } elseif ($riwayat->jumlah_benar == 1) {
            $caption = "BELAJAR LAGI YUK!";
        } elseif ($riwayat->jumlah_benar == 0) {
            $caption = "BELAJAR YUK!";
        }

        $img = $riwayat->jumlah_benar."out5.svg";

        // dd($riwayat);

        return view('auth.riwayat-show', [
            'riwayat' => $riwayat,
            'caption' => $caption,
            'img' => $img,
            $settings['navactive'] => '-active-links',
            $settings['baractive'] => 'active',
            'stgs' => $settings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(Riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riwayat $riwayat)
    {
        //
    }
}
