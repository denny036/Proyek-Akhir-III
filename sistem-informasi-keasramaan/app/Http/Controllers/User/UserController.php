<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Asrama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RecordMahasiswaAsrama;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{   

    public function create(Request $request)
    {
        //validate input
        $request->validate(
            [
                'nama' => 'required|min:3|max:23',
                'nim' => [
                    'required',
                    'unique:users,nim',
                    'min:8',
                    'max:8',
                    'regex:/^((11)+(3|4)|(13)+3|(11|12|14|21|31)+S)(17|18|19|20|21|22)[0-9]{3}$/',
                ],
                'password' => 'required|string|min:6|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirm_password' => 'required|string|min:6|max:16|same:password|',
                'angkatan' => 'required',
                'prodi' => 'required'
            ],
            [
                'nama.required' => 'Kolom nama tidak boleh kosong.',
                'nama.min' => 'Kolom nama minimal 3 karakter.',
                'nama.max' =>  'Kolom nama maksimal 23 karakter.',
                'nim.regex' => 'Kolom NIM harus sesuai dengan format akademik.',
                'nim.required' =>  'Kolom NIM tidak boleh kosong.',
                'nim.unique' => 'Kolom NIM sudah terdaftar.',
                'nim.min' => 'Kolom NIM sesuai dengan format akademik.',
                'nim.max' => 'Kolom NIM sesuai dengan format akademik.',
                'password.required' => 'Kolom password tidak boleh kosong.',
                'password.min' => 'Kolom password minimal 6 karakter.',
                'password.max' => 'Kolom password maksimal 16 karakter.',
                'password.regex' => 'Password harus mengandung huruf besar, kecil, angka, dan karakter khusus.',
                'confirm_password.required' => 'Kolom konfirmasi sandi tidak boleh kosong.',
                'confirm_password.same' => 'Konfirmasi sandi Anda harus sama dengan kolom Password',
                'angkatan.required' => 'Kolom angkatan tidak boleh kosong.',
                'prodi.required' =>  'Kolom program studi tidak boleh kosong.',
            ]
        );

        $user = new User();
        $user->nama = $request->nama;
        $user->nim = $request->nim;
        $user->password = Hash::make($request->password);
        $user->angkatan = $request->angkatan;
        $user->prodi = $request->prodi;
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'Anda berhasil melakukan registrasi.');
        } else {
            return redirect()->back()->with('fail', 'Registrasi gagal, silakan periksa format yang diminta.');
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:users,nim',
            'password' => 'required'
        ], [
            'nim.required' => 'NIM tidak boleh kosong.',
            'nim.exists' => 'NIM Anda tidak ditemukan.',
            'password.required' => 'Password tidak boleh kosong.'
        ]);
        
        $rememberMe = $request->remember ? true : false;
        $credentials = $request->only('nim', 'password');

        if (Auth::guard('web')->attempt($credentials, $rememberMe)) {
            return redirect()->route('mahasiswa.home');
        } else {
            return redirect()->route('mahasiswa.login')->with('fail', 'Incorrect username or password.')->withInput();
        }
    }

    public function showHomeMahasiswa(Asrama $asrama) 
    {
        $dataAsrama = Asrama::all();
        $user_id = Auth::guard('web')->user()->id;

        $checkAsrama = DB::table('record_mahasiswa_asrama')->where('users_id', '=', $user_id)->get();
        $isNullAsrama = $checkAsrama->isEmpty();

        $getDataMahasiswa = DB::table('record_mahasiswa_asrama')
                                ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
                                ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
                                ->where('record_mahasiswa_asrama.users_id', '=', $user_id)
                                ->first();
                              
        $asramaUser = DB::table('record_mahasiswa_asrama')
                        ->where('users_id', '=', $user_id)
                        ->orderBy('asrama_id', 'desc')
                        ->first();

        if(empty($asramaUser)) {
            $totalMahasiswaAsrama = 0;
            return redirect()->route('mahasiswa.profile')
                             ->with('info', 'Untuk menggunakan aplikasi ini, silakan pilih asrama Anda terlebih dahulu!');
        }else{
            $getUserAsramaID = $asramaUser->asrama_id;
                                
            $totalMahasiswaAsrama = DB::table('record_mahasiswa_asrama')
                                ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')        
                                ->select(DB::raw('count(asrama_id) as Total'))                   
                                ->where('asrama.id', '=', $getUserAsramaID)
                                ->first();

            $dataPenghuniAsrama = DB::table('record_mahasiswa_asrama')
                                ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')  
                                ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
                                ->where('record_mahasiswa_asrama.asrama_id', '=', $getUserAsramaID)
                                ->paginate(15);
                                
                                
            // dd($dataPenghuniAsrama);
            
            return view('mahasiswa.home', compact('dataAsrama', 'isNullAsrama', 'getDataMahasiswa', 'totalMahasiswaAsrama', 'dataPenghuniAsrama'));
        }
                          
    }

    public function getDataAsrama(Asrama $asrama)
    {
        $asrama = Asrama::all();
        $user_id = Auth::guard('web')->user()->id;

        $checkAsrama = DB::table('record_mahasiswa_asrama')->where('users_id', '=', $user_id)->get();
        $nullAsrama = $checkAsrama->isEmpty();

        $dataMahasiswa = DB::table('record_mahasiswa_asrama')
                         ->join('users', 'record_mahasiswa_asrama.users_id', '=', 'users.id')
                         ->join('asrama', 'record_mahasiswa_asrama.asrama_id', '=', 'asrama.id')
                         ->where('record_mahasiswa_asrama.users_id', '=', $user_id)
                         ->get();
       
        return view('mahasiswa.profile', compact('asrama', 'nullAsrama', 'dataMahasiswa'));
    }

    public function storeAsramaMahasiswa(Request $request)
    {
        $request->validate(
            [
                'asrama' => 'required'
            ],
            [
                'asrama.required' => 'Kolom Asrama tidak boleh kosong.',
            ]
        );

        $user_id = Auth::guard('web')->user()->id;
        $asrama_id = $request->asrama;

        RecordMahasiswaAsrama::create([
            'users_id' => $user_id,
            'asrama_id' => $asrama_id,
        ]);

        return redirect()->route('mahasiswa.profile')->with('success', 'Berhasil memperbarui data Asrama.');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('welcome');
    }
}
