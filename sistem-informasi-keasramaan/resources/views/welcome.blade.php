<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome &mdash; Sistem Informasi Keasramaan IT DEL</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<body class="bg-neutral-100">
    <!-- component -->
<div class="min-h-screen items-center">
    <div class="">
        <div class="text-center font-semibold mt-8">
            <h1 class="pt-10 text-5xl text-headWelcome font-poppins w-full px-8 md:w-full">
                Sistem Informasi Keasramaan Institut Teknologi Del
            </h1>
            <div class="grid place-items-center mt-8">
                <img src="../images/logo.png" alt="Logo IT Del" class="object-contain h-32 w-32">
                <span class="mt-2 text-sm font-poppins font-thin text-captionWelcome">Institut Teknologi Del</span>
            </div>
        </div>
        <!-- cards -->

        <!-- component -->
        <div class="container flex flex-wrap pt-4 pb-10 m-auto mt-6 md:mt-15 lg:px-12 xl:px-16">
            <div class="w-full px-0 lg:px-4">
            <h2 class="px-12 py-4 text-base font-bold text-center lg:text-3xl md:text-2xl text-login font-poppins">
                Pilih Login Sebagai
            </h2>
            
            <div class="flex flex-wrap items-center justify-center py-4 pt-0">
                <div class="w-full p-4 md:w-1/2 lg:w-1/4 sm:w-1/2 plan-card">
                    <a href="#">
                    <label class="flex flex-col rounded-lg shadow-lg group relative cursor-pointer hover:shadow-2xl">
                        <div class="w-full px-4 py-6 rounded-t-lg card-section-1 bg-cardWelcome">
                            <h3 class="mx-auto text-base font-semibold text-center underline">
                                <i class="fas fa-user-tie text-5xl"></i>
                            </h3>
                            <p class="text-3xl py-4 font-bold text-center font-poppins text-login">
                                Portal Koordinator
                            </p>
                            
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-full py-4 rounded-b-lg bg-login">
                            <p class="text-sm font-poppins text-white text-center py-2">
                                Klik untuk masuk sebagai Koordinator Keasramaan!
                            </p>
                        </div>
                    </label>
                    </a>
                </div>

                <div class="w-full p-4 md:w-1/2 lg:w-1/4 sm:w-1/2 plan-card">
                    <a href="{{ route('mahasiswa.login') }}">
                    <label class="flex flex-col rounded-lg shadow-lg group relative cursor-pointer hover:shadow-2xl">
                        <div class="w-full px-4 py-6 rounded-t-lg card-section-1 bg-cardWelcome">
                            <h3 class="mx-auto text-base font-semibold text-center underline">
                                <i class="fas fa-user-graduate text-5xl"></i>
                            </h3>
                            <p class="text-4xl py-4 font-bold text-center font-poppins text-login">
                                Portal Mahasiswa
                            </p>
                            
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-full py-7 rounded-b-lg bg-login">
                            <p class="text-sm font-poppins text-white text-center py-2">
                                Klik untuk masuk sebagai Mahasiswa!
                            </p>
                             
                        </div>
                    </label>
                    </a>
                </div>

                {{-- <div class="w-full p-4 md:w-1/2 lg:w-1/4">
                    <label class="flex flex-col rounded-lg shadow-lg relative cursor-pointer hover:shadow-2xl">
                        <div class="w-full px-4 py-8 rounded-t-lg bg-blue-500">
                            <h3 class="mx-auto text-base font-semibold text-center underline text-white group-hover:text-white">
                                Premium
                            </h3>
                            <p class="text-5xl font-bold text-center text-white">
                                $21.<span class="text-3xl">95</span>
                            </p>
                            <p class="text-xs text-center uppercase text-white">
                                monthly
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-full py-6 rounded-b-lg bg-blue-700">
                            <p class="text-xl text-white">
                                3 months
                            </p>
                            <button class="w-5/6 py-2 mt-2 font-semibold text-center uppercase bg-white border border-transparent rounded text-blue-500">
                                Save 15%
                            </button>
                        </div>
                    </label>
                </div> --}}

                <div class="w-full p-4 md:w-1/2 lg:w-1/4 sm:w-1/2 plan-card">
                    <a href="#">
                    <label class="flex flex-col rounded-lg shadow-lg group relative cursor-pointer hover:shadow-2xl">
                        <div class="w-full px-4 py-6 rounded-t-lg card-section-1 bg-cardWelcome">
                            <h3 class="mx-auto text-base font-semibold text-center underline">
                                <i class="fas fa-users text-5xl"></i>
                            </h3>
                            <p class="text-3xl py-4 font-bold text-center font-poppins text-login">
                                Portal Petugas
                            </p>
                            
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-full py-4 rounded-b-lg bg-login">
                            <p class="text-sm font-poppins text-white text-center py-2">
                                Klik untuk masuk sebagai Petugas Keasramaan!
                            </p>
                        </div>
                    </label>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>