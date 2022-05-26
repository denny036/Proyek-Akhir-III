<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal Petugas</title>
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="w-full h-screen bg-no-repeat bg-cover" style="background-image: url('https://i.ibb.co/56qkQjB/login.png');">
            <div class="flex items-center justify-center h-screen font-poppins sm:px-6">
                <div class="w-full max-w-sm p-4 bg-neutral-50 rounded-md shadow-md sm:p-6">
                    <img src="../images/logo.png" alt="Logo-Del" class="bg-auto w-28 mx-auto">
                    <div class="flex items-center justify-center mt-2">
                    <span class="text-xs text-gray-500">Institut Teknologi Del</span>
                    </div>
                    <div class="flex items-center justify-center">
                        <span class="text-xl font-medium text-slate-900 mt-2">Silakan Masuk</span>
                    </div>

                    <form class="mt-4" action="{{ route('petugas.check') }}" method="POST">

                        @if(Session::get('fail'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 
                        dark:text-red-800" role="alert">
                            <span class="font-medium">{{ Session::get('fail') }}</span>
                        </div>
                        @endif

                        @csrf
                        <label for="email" class="block">
                            <span class="text-sm text-login">Email</span>
                            <input type="text" id="email" name="email"
                                class="block w-full px-3 py-2 mt-1 text-slate-900 bg-gray-200 rounded-md 
                                focus:outline-none focus:shadow-outline placeholder:text-slate-800"
                                placeholder="Masukkan email Anda.." value="{{ old('email') }}"/>
                                <span class="text-red-800 text-sm">
                                    @error('email')
                                        {{ $message }} 
                                    @enderror
                                </span>
                        </label>
                        <label for="password" class="block mt-3">
                            <span class="text-sm text-login">Password</span>
                            <input type="password" id="password" name="password" 
                                class="block w-full px-3 py-2 mt-1 text-slate-900 bg-gray-200 rounded-md 
                                focus:outline-none focus:shadow-outline placeholder:text-slate-800"
                                placeholder="Password.." />
                            <span class="text-red-800 text-sm">
                                @error('password')
                                    {{ $message }} 
                                @enderror
                            </span>
                        </label>
                        <div class="flex items-center justify-between mt-4">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="remember"
                                        class="text-indigo-600 border form-checkbox focus:outline-none focus:shadow-outline" />
                                    <span class="mx-2 text-sm text-slate-900">Ingat saya</span>
                                </label>
                            </div>
                            <!-- <div>
                                <a class="block text-sm text-slate-900 hover:underline focus:outline-none focus:underline"
                                    href="#">Lupa kata sandi?</a>
                            </div> -->
                            
                        </div>
                        <div class="mt-6 text-center">
                            <button type="submit"
                                class="w-28 px-4 py-2 mt-4 text-sm text-center text-white 
                                bg-login rounded-md hover:bg-login">Login</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </body>
</html>


   