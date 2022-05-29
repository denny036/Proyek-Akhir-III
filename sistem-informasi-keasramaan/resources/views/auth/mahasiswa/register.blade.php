<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal Registrasi Mahasiswa</title>
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       
    </head>

    <body>
        <div class="w-full h-screen bg-no-repeat bg-cover" style="background-image: url('https://i.ibb.co/56qkQjB/login.png');">
            <div class="flex items-center justify-center h-screen font-poppins sm:px-6">
                <div class="w-full max-w-md p-4 bg-neutral-50 rounded-md shadow-md sm:p-6">
                    <img src="../images/logo.png" alt="Logo-Del" class="bg-auto w-28 mx-auto">
                    <div class="flex items-center justify-center mt-2">
                    <span class="text-xs text-gray-500">Institut Teknologi Del</span>
                    </div>
                    <div class="flex items-center justify-center">
                        <span class="text-xl font-medium text-slate-900 mt-2">Portal Registrasi Mahasiswa</span>
                    </div>

                    <form class="mt-4" action="{{ route('mahasiswa.create') }}" method="POST">

                        @if(Session::get('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            <span class="font-medium">{{ Session::get('success') }}</span>
                        </div>
                        @endif

                        @if(Session::get('fail'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            <span class="font-medium">{{ Session::get('fail') }}</span>
                        </div>
                        @endif

                        @csrf
                        <label for="nama" class="block">
                            <span class="text-sm text-login">Nama</span>
                            <input type="text" id="nama" name="nama" autocomplete="nama"
                                class="block w-full px-3 py-2 mt-1 text-slate-900 bg-gray-200 rounded-md focus:outline-none focus:shadow-outline placeholder:text-slate-800"
                                value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" />
                            <span class="text-red-800 text-sm">
                                @error('nama')
                                    {{ $message }} 
                                @enderror
                            </span>
                        </label>
                        <label for="nim" class="block">
                            <span class="text-sm text-login">NIM</span>
                            <input type="text" id="nim" name="nim" autocomplete="nim"
                                class="block w-full px-3 py-2 mt-1 text-slate-900 bg-gray-200 rounded-md focus:outline-none focus:shadow-outline placeholder:text-slate-800"
                                value="{{ old('nim') }}" placeholder="Nomor Induk Mahasiswa" />
                            <span class="text-red-800  text-sm">
                                @error('nim')
                                    {{ $message }} 
                                @enderror
                            </span>
                        </label>
                        <label for="password" class="block mt-3">
                            <span class="text-sm text-login">Password</span>
                            <input type="password" id="password" name="password" autocomplete="current-password"
                                class="block w-full px-3 py-2 mt-1 text-slate-900 bg-gray-200 rounded-md focus:outline-none focus:shadow-outline placeholder:text-slate-800"
                                placeholder="Masukkan kata sandi"  />

                            <span class="text-red-800 text-sm">
                                @error('password')
                                {{ $message }} 
                                @enderror
                            </span>
                        </label>
                        <label for="confirm_password" class="block mt-3">
                            <span class="text-sm text-login">Confirm Password</span>
                            <input type="password" id="confirm_password" name="confirm_password" autocomplete="confirm_password"
                                class="block w-full px-3 py-2 mt-1 text-slate-900 bg-gray-200 rounded-md focus:outline-none focus:shadow-outline placeholder:text-slate-800"
                                placeholder="Masukkan konfirmasi kata sandi" />
                                <span class="text-red-800  text-sm">
                                    @error('confirm_password')
                                        {{ $message }} 
                                    @enderror
                                </span>
                        </label>
                        <label for="angkatan" class="block mt-3">
                            <span class="text-sm text-login">Angkatan</span>
                            <select name="angkatan" id="angkatan"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                            dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="2022" {{ old('angkatan') == "2022" ? "selected" : ""}}>2022</option>
                                <option value="2021" {{ old('angkatan') == "2021" ? "selected" : ""}}>2021</option>
                                <option value="2020" {{ old('angkatan') == "2020" ? "selected" : ""}}>2020</option>
                                <option value="2019" {{ old('angkatan') == "2019" ? "selected" : ""}}>2019</option>
                                <option value="2018" {{ old('angkatan') == "2018" ? "selected" : ""}}>2018</option>
                                <option value="2017" {{ old('angkatan') == "2017" ? "selected" : ""}}>2017</option>
                                <option value="2016" {{ old('angkatan') == "2016" ? "selected" : ""}}>2016</option>
                            </select>
                        </label>
                        <label for="prodi" class="block mt-3">
                            <span class="text-sm text-login">Program Studi</span>
                            <select name="prodi" id="prodi"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                            dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 
                                    dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="informatika" {{ old('prodi') == "informatika" ? "selected" : ""}}>Informatika</option>
                                <option value="sistem_informasi" {{ old('prodi') == "sistem_informasi" ? "selected" : ""}}>Sistem Informasi</option>
                                <option value="teknik_elektro" {{ old('prodi') == "teknik_elektro" ? "selected" : ""}}>Teknik Elektro</option>
                                <option value="teknik_bioproses" {{ old('prodi') == "teknik_bioproses" ? "selected" : ""}}>Teknik Bioproses</option>
                                <option value="manajemen_rekayasa" {{ old('prodi') == "manajemen_rekayasa" ? "selected" : ""}}>Manajemen Rekayasa</option>
                                <option value="d4_trpl" {{ old('prodi') == "d4_trpl" ? "selected" : ""}}>D4 Teknologi Rekayasa Perangkat Lunak</option>
                                <option value="d3_ti" {{ old('prodi') == "d3_ti" ? "selected" : ""}}>D3 Teknologi Informasi</option>
                                <option value="d3_tk" {{ old('prodi') == "d3_tk" ? "selected" : ""}}>D3 Teknologi Komputer</option>
                            </select>
                        </label>
                        
                        <div class="mt-6 text-center">
                            <p class="text-slate-900 text-xs sm:text-center mx-8">Sudah punya akun? Silakan masuk <a href="{{ route('mahasiswa.login') }}" class="text-login">kesini.</a>
                            <button type="submit"
                                class="w-28 px-4 py-2 mt-4 text-sm text-center text-white bg-login rounded-md hover:bg-login">Daftar</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </body>
</html>