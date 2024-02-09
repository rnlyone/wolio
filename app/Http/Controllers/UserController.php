<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function flogin() {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Login',
                     'customcss' => $customcss,
                     'pagetitle' => 'Login',
                     'subtitle' => 'Login',
                     'navactive' => '',
                     'baractive' => 'userbar',];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        return view('guest.login', [
            $settings['navactive'] => '-active-links',
            'stgs' => $settings]);
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        $attr = request()->validate([
            'username' => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        if (Auth::attempt($attr)){

            Auth::login($user);

        return redirect()->intended('/')->with('sukses', "Login Sukses");
        } else {
            return back()->with('gagal', 'Username / Password Salah!');
        }
    }

    public function logout()
    {
        Auth::logout();
        if(session()->get('gagal')){
            $getflash = session('gagal') ;
        } else {
            $getflash = NULL;
        }
        // dd($getflash);
        if ($getflash != NULL){
            return redirect('/login')->with('gagal', $getflash);
        }else{
            return redirect('/login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Profil',
                     'customcss' => $customcss,
                     'pagetitle' => 'Profil',
                     'subtitle' => 'Profil',
                     'navactive' => 'usernav',
                     'baractive' => 'userbar',
                     'prevpage' => route('welcome')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        return view('auth.user-index', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'stgs' => $settings]);
    }

    public function user_manage()
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Managemen User',
                     'customcss' => $customcss,
                     'pagetitle' => 'Managemen User',
                     'subtitle' => 'Managemen User',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('setting.index')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $users = User::all();
        $kelases = Kelas::all();

        return view('auth.guru.user-manage-index', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'users' => $users,
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
        $settings = ['title' => ': Buat User',
                     'customcss' => $customcss,
                     'pagetitle' => 'Buat User',
                     'subtitle' => 'Buat User',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('user.manage')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $users = User::all();

        $kelases = Kelas::all();

        return view('auth.guru.user-manage-create', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'users' => $users,
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
            'role' => 'required|in:siswa,guru',
            'username' => [
                'required',
                'unique:users',
                'regex:/^[a-z0-9_.-]+$/',
                'max:255'
            ],
            'nama_lengkap' => 'required',
            'nomor_induk' => 'required',
            'email' => 'nullable|email|unique:users',
            'no_hp' => 'nullable|numeric',
            'kelas' => 'nullable',
            'password' => 'required|min:8',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1'
        ], [
            'username.alpha_dash' => 'Username hanya boleh mengandung huruf, angka, tanda "-" atau "_"',
            'username.regex' => 'Username hanya boleh mengandung huruf kecil dan tanda "-" atau "_"',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter',
            'avatar.dimensions' => 'Avatar harus berukuran 1:1 (persegi)',
        ]);

        // Mengubah username menjadi lowercase
        $validatedData['username'] = strtolower($validatedData['username']);

        $file = $request->file('avatar');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/avatar', $fileName, 'public');

        // Menyimpan data User ke dalam model User
        $user = new User;
        $user->role = $validatedData['role'];
        $user->username = $validatedData['username'];
        $user->nama = $validatedData['nama_lengkap'];
        $user->nomor_induk = $validatedData['nomor_induk'];
        $user->email = $validatedData['email'] ?? 'siswa@mail.com';
        $user->no_hp = $validatedData['no_hp'];
        $user->id_kelas = $validatedData['kelas'];
        $user->password = bcrypt($validatedData['password']);
        $user->avatar = $fileName;
        $user->save();

        return redirect()->route('user.manage')->with('sukses', 'User Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customcss = '';
        $jmlsetting = Setting::where('group', 'env')->get();
        $settings = ['title' => ': Edit User',
                     'customcss' => $customcss,
                     'pagetitle' => 'Edit User',
                     'subtitle' => 'Edit User',
                     'navactive' => '',
                     'baractive' => '',
                     'prevpage' => route('user.manage')
                    ];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->setname] = $set->value;
                     }

        $user = User::find($id);
        // dd($user);

        $kelases = Kelas::all();

        return view('auth.guru.user-manage-edit', [
        $settings['navactive'] => '-active-links',
        $settings['baractive'] => 'active',
        'user' => $user,
        'kelases' => $kelases,
        'stgs' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'role' => 'in:guru,siswa',
            'username' => [
                'required',
                'unique:users,username,' . $user->id,
                'regex:/^[a-z0-9_.-]+$/',
                'max:255'
            ],
            'nomor_induk' => 'required',
            'nama_lengkap' => 'required',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'no_hp' => 'required',
            'kelas' => 'nullable',
            'password' => 'nullable|min:8',
            'confirmpassword' => 'nullable|same:password',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1'
        ], [
            'username.alpha_dash' => 'Username hanya boleh mengandung huruf, angka, tanda "-" atau "_"',
            'username.regex' => 'Username hanya boleh mengandung huruf kecil dan tanda "-" atau "_"',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter',
            'confirmpassword.same' => 'Konfirmasi password harus sama dengan password'
        ]);

        // Mengubah username menjadi lowercase
        $validatedData['username'] = strtolower($validatedData['username']);

        if (isset($validatedData['avatar'])) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatar', $fileName, 'public');
            $user->avatar = $fileName;
        }

        if ($request->role != null) {
            $user->role = $validatedData['role'];
        }

        if ($request->kelas != null) {
            $user->id_kelas = $validatedData['kelas'];
        }

        $user->username = $validatedData['username'];
        $user->nama = $validatedData['nama_lengkap'];
        $user->nomor_induk = $validatedData['nomor_induk'];
        $user->email = $validatedData['email'] ?? 'siswa@mail.com';
        $user->no_hp = $validatedData['no_hp'];

        if ($validatedData['password'] != null) {
            if ($validatedData['password'] == $validatedData['confirmpassword']) {
                $user->password = bcrypt($validatedData['password']);
            }
        }

        $user->save();

        return redirect()->route('user.manage')->with('sukses', 'Profile berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.manage')->with('sukses', 'User berhasil dihapus.');
    }
}
