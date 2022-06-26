<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=a, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('title')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/alpine.js') }}" defer></script>
    @stack('scripts')
</head>

<body class="antialiased bg-gray-100">
    <div class="flex relative" x-data="{ navOpen: false }">
        <!-- NAV -->
        <nav class="absolute md:relative w-64 transform -translate-x-full md:translate-x-0 h-screen overflow-y-scroll bg-templateNav transition-all duration-300"
            :class="{ '-translate-x-full': !navOpen }">
            <div class="flex flex-col justify-between h-full">
                <div class="p-4">
                    <!-- LOGO -->
                    <a class="flex items-center text-white space-x-4" href="">
                        <img src="{{ asset('/images/logo-admin.png') }}" class="w-7 rounded-full" alt="Logo">

                        <span class="text-base font-bold font-poppins">
                            @yield('judul-navigasi')
                        </span>
                    </a>

                    <!-- SEARCH BAR -->
                    <div class="border-gray-700 py-1 text-white border-b rounded">

                    </div>



                    @include('koordinator.layouts.partials.navbar')

                    <!-- PROFILE -->
                    <div class="text-gray-200 border-gray-800 rounded flex items-center justify-between p-2">
                        <div class="flex items-center space-x-2">
                            <!-- AVATAR IMAGE BY FIRST LETTER OF NAME -->
                            <img src="{{ asset('/images/avatar/avatar.png') }}" class="w-7 rounded-full"
                                alt="Profile">
                            <h1 class="text-sm font-poppins">{{ Auth::guard('koordinator')->user()->nama }}</h1>
                        </div>
                        <a onclick="event.preventDefault(); document.getElementById('logoutForm').submit()"
                            href="{{ route('koordinator.logout') }}"
                            class="hover:bg-gray-800 hover:text-white p-2 rounded">
                            <form id="logoutForm" action="{{ route('koordinator.logout') }}" method="POST">
                                @csrf
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </form>
                        </a>
                    </div>

                </div>
        </nav>
        <!-- END OF NAV -->

        <!-- PAGE CONTENT -->
        <main class="flex-1 h-screen overflow-y-scroll overflow-x-hidden">
            <div class="md:hidden justify-between items-center bg-black text-white flex">
                <h1 class="text-xl font-bold px-4 font-poppins">Keasramaan IT DEL</h1>
                <button @click="navOpen = !navOpen" class="btn p-4 focus:outline-none hover:bg-gray-800">
                    <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <section class="max-w-7xl mx-auto py-4 px-5">
                <div class="flex justify-between items-center border-b border-gray-300">
                    <h1 class="text-xl font-semibold pt-2 pb-6 font-poppins">@yield('judul-halaman')</h1>
                </div>

                @yield('statistics')

                @yield('table')


            </section>
            <!-- END OF PAGE CONTENT -->
        </main>
    </div>

</body>
@stack('ext-script')
</html>
