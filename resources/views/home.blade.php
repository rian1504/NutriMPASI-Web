@extends('layouts.app')

@section('content')
    <!-- Bagian Hero -->
    <section class="relative overflow-hidden py-8 bg-gradient-to-br from-[#F59E0B] from-36% via-[#F59E0B] via-20% to-white">
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-10 md:mb-0" data-aos="fade-right" data-aos-delay="100">
                    <p class="text-white text-lg mb-4">— Satu aplikasi untuk semua kebutuhan MPASI</p>
                    <h1 class="text-white text-4xl md:text-5xl font-bold mb-4">
                        Nutrisi tepat, anak hebat!<br>
                        <span class="font-bold">NutriMPASI</span>
                    </h1>
                    <p class="text-white text-xl mb-8">
                        Dukung perjalanan makan si kecil<br>
                        dengan rekomendasi nutrisi terbaik!
                    </p>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                        class="inline-block transform hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('image/components/googleplay_download.png') }}" alt="Get it on Google Play"
                            class="h-16 md:h-20">
                    </a>
                </div>
                <div class="w-full md:w-1/2 flex justify-center relative" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="absolute w-[80%] sm:w-[600px] lg:w-[600px] h-[500px] sm:h-[600px] rounded-full bg-white -bottom-80 left-1/2 -translate-x-1/2 z-0 max-w-full">
                    </div>
                    <div
                        class="absolute w-[85%] sm:w-[650px] lg:w-[650px] h-[550px] sm:h-[650px] rounded-full bg-white/60 -bottom-80 left-1/2 -translate-x-1/2 z-0 max-w-full">
                    </div>
                    <div
                        class="absolute w-[90%] sm:w-[700px] lg:w-[700px] h-[600px] sm:h-[700px] rounded-full bg-white/30 -bottom-80 left-1/2 -translate-x-1/2 z-0 max-w-full">
                    </div>
                    <img src="{{ asset('image/mockups/splashscreen_mockup.png') }}" alt="NutriMPASI App"
                        class="max-h-[700px] relative z-10">
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Unduhan -->
    <section class="bg-[#242A41] py-16 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-10 md:mb-0" data-aos="fade-right">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Download <span class="text-[#5966B1]">Nutri<span class="text-[#F59E0B]">MPASI</span></span><br>
                        Sekarang!
                    </h2>
                    <p class="text-lg mb-6">
                        Lebih dari sekadar menu MPASI. Unduh dan jelajahi sendiri, Gratis!
                    </p>
                </div>
                <div class="w-full md:w-1/2" data-aos="zoom-in" data-aos-delay="200">
                    <div
                        class="bg-[#5966B1] rounded-xl p-6 relative flex flex-col md:flex-row items-center max-w-md ml-auto">
                        <div class="w-full md:w-2/3 mb-6 md:mb-0 md:mr-6">
                            <h3 class="text-2xl font-semibold mb-1">For Android</h3>
                            <p class="text-white/80 mb-6">Android 8.0+</p>
                            <a href="#" id="android-download-button" target="_blank" rel="noopener noreferrer"
                                class="bg-[#F59E0B] text-white px-8 py-3 rounded-full font-medium hover:bg-[#E59009] transition-all inline-block">
                                Download App
                            </a>

                            <div class="mt-6 md:mt-8">
                                <img src="{{ asset('image/components/qr_code.png') }}" alt="QR Code" class="w-28 h-28">
                            </div>
                        </div>

                        <div class="absolute -bottom-5 -right-5">
                            <div
                                class="relative bg-[#242A41] rounded-full w-20 h-20 flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('image/icons/android_icon.png') }}" alt="Android"
                                    class="w-10 h-10 absolute">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Tentang Aplikasi -->
    <section id="produk" class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <p class="text-gray-500 text-sm uppercase tracking-wider mb-1">— Produk</p>
                <h2 class="text-3xl font-bold text-gray-800"><span class="text-[#5966B1]">Tentang</span> <span
                        class="text-[#F59E0B]">Aplikasi</span></h2>
            </div>

            <div class="max-w-4xl mx-auto mb-16" data-aos="fade-up" data-aos-delay="100">
                <p class="text-gray-700 text-justify leading-relaxed">
                    Banyak orang tua mengalami kesulitan saat menyusun MPASI yang sesuai dengan kebutuhan gizi bayi.
                    Kurangnya pemahaman tentang porsi, jenis makanan, dan kandungan nutrisi seringkali berdampak pada tumbuh
                    kembang anak. Aplikasi ini hadir untuk membantu perencanaan MPASI secara cerdas dan personal, sekaligus
                    mendukung upaya nasional dalam menurunkan angka stunting.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kartu 1 -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center transition-transform hover:scale-105"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('image/icons/recommend_icon.png') }}" alt="Merekomendasikan" class="w-12 h-12">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Merekomendasikan</h3>
                    <p class="text-gray-600 text-justify">
                        Aplikasi menyarankan menu MPASI sesuai usia periode kedewasaan bayi.
                    </p>
                </div>

                <!-- Kartu 2 -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center transition-transform hover:scale-105"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('image/icons/schedule_icon.png') }}" alt="Merencanakan" class="w-12 h-12">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Merencanakan</h3>
                    <p class="text-gray-600 text-justify">
                        Fitur kalender membantu orang tua membuat jadwal dan mengatur program MPASI.
                    </p>
                </div>

                <!-- Kartu 3 -->
                <div class="bg-white rounded-lg shadow-md p-6 text-center transition-transform hover:scale-105"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <img src="{{ asset('image/icons/notes_icon.png') }}" alt="Mencatat" class="w-12 h-12">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Mencatat</h3>
                    <p class="text-gray-600 text-justify">
                        Memudahkan mencatat dan mengingat catatan gizi secara berkala.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Keunggulan Aplikasi -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-10 md:mb-0 relative" data-aos="fade-right">
                    <div
                        class="absolute w-[80%] sm:w-[400px] h-[400px] rounded-full yellow-radial-gradient top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 max-w-full">
                    </div>
                    <img src="{{ asset('image/mockups/home_mockup.png') }}" alt="Fitur Aplikasi NutriMPASI"
                        class="max-w-full md:max-w-md mx-auto relative z-10">
                </div>

                <div class="w-full md:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="md:pl-10">
                        <h2 class="text-3xl font-bold text-gray-800 mb-8"><span class="text-[#5966B1]">Keunggulan</span>
                            <span class="text-[#F59E0B]">Aplikasi</span>
                        </h2>
                        <p class="text-gray-600 mb-10">Kenapa harus download NutriMPASI?</p>

                        <!-- Fitur 1 -->
                        <div class="flex mb-8" data-aos="fade-up" data-aos-delay="300">
                            <div
                                class="bg-[#F59E0B] rounded-lg p-3 mr-4 h-12 w-12 flex items-center justify-center flex-shrink-0">
                                <img src="{{ asset('image/icons/user_icon.png') }}" alt="UI Ramah" class="w-4 h-6">
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-1">Tampilan Ramah Orang Tua</h3>
                                <p class="text-gray-600 text-justify">Mudah digunakan oleh semua umur tanpa bingung.</p>
                            </div>
                        </div>

                        <!-- Fitur 2 -->
                        <div class="flex mb-8" data-aos="fade-up" data-aos-delay="400">
                            <div
                                class="bg-[#F59E0B] rounded-lg p-3 mr-4 h-12 w-12 flex items-center justify-center flex-shrink-0">
                                <img src="{{ asset('image/icons/ai_icon.png') }}" alt="AI" class="w-6 h-6">
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-1">Didukung AI Cerdas</h3>
                                <p class="text-gray-600 text-justify">Mampu merekomendasikan makanan dan menghitung nutrisi
                                    otomatis sesuai kebutuhan spesifik bayi.</p>
                            </div>
                        </div>

                        <!-- Fitur 3 -->
                        <div class="flex" data-aos="fade-up" data-aos-delay="500">
                            <div
                                class="bg-[#F59E0B] rounded-lg p-3 mr-4 h-12 w-12 flex items-center justify-center flex-shrink-0">
                                <img src="{{ asset('image/icons/steps_icon.png') }}" alt="Fitur" class="w-6 h-6">
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-1">Fitur Lengkap & Praktis</h3>
                                <p class="text-gray-600 text-justify">Fitur interaktif, menu, jadwal masak, hingga resep
                                    lengkap dan riwayat gizi semua dalam satu aplikasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Fitur Unggulan -->
    <section id="fitur" class="relative pb-40">
        <div class="bg-[#242A41] absolute top-0 left-0 w-full h-1/2"></div>
        <div class="container mx-auto px-4 relative pt-20">
            <div class="mb-16 flex flex-col md:flex-row md:items-center md:justify-between" data-aos="fade-up">
                <div>
                    <p class="text-[#F59E0B] text-sm uppercase tracking-wider mb-2">— Fitur</p>
                    <h2 class="text-white text-4xl font-bold">Fitur Unggulan</h2>
                </div>
                <div class="mt-4 md:mt-0 md:max-w-md flex">
                    <div class="border-l-4 border-[#F59E0B] pl-4">
                        <p class="text-white/80 text-lg text-justify">
                            Nikmati fitur-fitur modern yang siap mendukung tumbuh kembang anak secara optimal.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kartu Fitur 1: Resep Usulan -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg relative" data-aos="flip-left"
                    data-aos-delay="100">
                    <div
                        class="absolute w-[80%] sm:w-[400px] md:w-[500px] h-[400px] md:h-[500px] rounded-full yellow-radial-gradient top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 max-w-full">
                    </div>
                    <div class="p-8 text-center relative z-10">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Resep Usulan</h3>
                        <p class="text-gray-600 text-center mb-6">
                            Fitur yang memungkinkan pengguna menambahkan, mengubah, atau menghapus resep MPASI untuk
                            diusulkan ke dalam daftar makanan aplikasi sesuai kebutuhan nutrisi bayi.
                        </p>
                    </div>
                    <div class="bg-gray-50 px-4 relative z-10">
                        <img src="{{ asset('image/mockups/food_list_mockup.png') }}" alt="Fitur Resep Usulan"
                            class="w-full">
                    </div>
                </div>

                <!-- Kartu Fitur 2: Kalkulator Gizi -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg relative" data-aos="flip-up"
                    data-aos-delay="200">
                    <div
                        class="absolute w-[80%] sm:w-[400px] md:w-[500px] h-[400px] md:h-[500px] rounded-full yellow-radial-gradient top-[65%] left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 max-w-full">
                    </div>
                    <div class="bg-gray-50 px-4 relative z-10">
                        <img src="{{ asset('image/mockups/nutrition_calculator_mockup.png') }}"
                            alt="Fitur Kalkulator Gizi" class="w-full">
                    </div>
                    <div class="p-8 text-center relative z-10">
                        <p class="text-gray-600 text-center mb-4">
                            Fitur berbasis AI yang menghitung kandungan nutrisi dari bahan makanan yang diusulkan pengguna
                            secara otomatis.
                        </p>
                        <h3 class="text-xl font-bold text-gray-800">Kalkulator Gizi</h3>
                    </div>
                </div>

                <!-- Kartu Fitur 3: Riwayat Memasak -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg relative" data-aos="flip-right"
                    data-aos-delay="300">
                    <div
                        class="absolute w-[80%] sm:w-[400px] md:w-[500px] h-[400px] md:h-[500px] rounded-full yellow-radial-gradient top-[35%] left-1/2 -translate-x-1/2 -translate-y-1/2 z-0 max-w-full">
                    </div>
                    <div class="p-8 text-center relative z-10">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Riwayat Memasak</h3>
                        <p class="text-gray-600 text-center mb-6">
                            Fitur untuk mencatat dan membandingkan total energi menu MPASI dalam rentang waktu tertentu guna
                            memantau kecukupan gizi demi pertumbuhan optimal bayi.
                        </p>
                    </div>
                    <div class="bg-gray-50 px-4 relative z-10">
                        <img src="{{ asset('image/mockups/cooking_history_mockup.png') }}" alt="Fitur Riwayat Memasak"
                            class="w-full">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Demo Aplikasi -->
    <section class="bg-gradient-to-b from-white to-amber-100/90 py-16 mb-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800">
                    <span class="text-[#5966B1]">Demo</span> <span class="text-[#F59E0B]">Aplikasi</span>
                </h2>
                <p class="text-gray-600 mt-2">Tonton untuk melihat bagaimana aplikasi bekerja.</p>
            </div>

            <div class="max-w-4xl mx-auto pb-24" data-aos="zoom-in" data-aos-delay="200">
                <div class="relative rounded-xl overflow-hidden shadow-lg aspect-video bg-black">
                    <!-- Player Video -->
                    <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/99fju-8Rmbg"
                        title="NutriMPASI Demo Video" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>

                    <div
                        class="absolute top-0 left-0 w-full h-full flex items-center justify-center video-fallback hidden">
                        <!-- Tombol Putar -->
                        <button
                            class="w-16 h-16 rounded-full bg-[#F59E0B] flex items-center justify-center transition-transform hover:scale-110">
                            <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Tombol Info -->
                        <button class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm p-2 rounded-full">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Kontrol Video -->
                        <div
                            class="absolute bottom-0 left-0 w-full px-4 py-3 bg-gradient-to-t from-black/70 to-transparent">
                            <div class="flex items-center">
                                <button class="text-white mr-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                                <button class="text-white mr-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                                <button class="text-white mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.536a5 5 0 001.414-9.9m-3.737 12.728a9 9 0 0112.728-12.728">
                                        </path>
                                    </svg>
                                </button>

                                <div class="w-full bg-gray-500 rounded-full h-1">
                                    <div class="bg-[#F59E0B] h-1 rounded-full w-1/3 relative">
                                        <div
                                            class="absolute -top-1.5 right-0 w-3 h-3 bg-white rounded-full border-2 border-[#F59E0B]">
                                        </div>
                                    </div>
                                </div>

                                <div class="ml-auto flex items-center">
                                    <button class="text-white mx-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                    <button class="text-white mx-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Tentang Kami -->
    <section id="tentang-kami" class="relative py-20">
        <div class="absolute -top-20 left-0 right-0 h-28 bg-[#242A41]"></div>
        <div
            class="absolute top-0 left-0 right-0 h-24 bg-[#5966B1]/90 -skew-y-3 transform origin-top-left z-0 flex items-center justify-center">
            <h2 class="text-4xl font-bold text-white -skew-y-3 transform origin-center">Tentang Kami</h2>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-8 mt-20" data-aos="fade-up">
                <p class="text-gray-800 text-lg">— Tim di Balik NutriMPASI [ PBL IF-08 ]</p>
            </div>

            <!-- Anggota Tim Utama -->
            <div class="max-w-xs mx-auto mb-16" data-aos="zoom-in" data-aos-delay="100">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="aspect-square">
                        <img src="{{ asset('image/photos/sartikha.png') }}" alt="Sartikha, S.ST., M.Eng"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center bg-[#F59E0B]">
                        <h3 class="text-white text-xl font-bold">Sartikha, S.ST., M.Eng</h3>
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-gray-700 font-medium">Project Manager</p>

                        <div class="mt-4 flex justify-center space-x-4">
                            <a href="https://www.instagram.com/tikha12" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg>
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/in/sartikha/" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]">
                                <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Anggota Tim -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <!-- Anggota Tim 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="aspect-square">
                        <img src="{{ asset('image/photos/rian_abdullah.png') }}" alt="Rian Abdullah"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 bg-[#F59E0B] text-white text-center">
                        <h3 class="font-bold text-lg">Rian Abdullah</h3>
                        <p class="text-sm">[ 3312301004 ]</p>
                    </div>
                    <div class="p-3 text-center">
                        <p class="text-gray-700">Backend Developer</p>
                        <div class="mt-3 flex justify-center space-x-3">
                            <a href="https://www.instagram.com/rian1504_" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg></a>
                            <a href="https://github.com/rian1504" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg></a>
                            <a href="https://www.linkedin.com/in/rian-abdullah/" target="_blank"
                                rel="noopener noreferrer" class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg></a>
                        </div>
                    </div>
                </div>

                <!-- Anggota Tim 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="aspect-square">
                        <img src="{{ asset('image/photos/lea_antony.png') }}" alt="Lea Antony"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 bg-[#F59E0B] text-white text-center">
                        <h3 class="font-bold text-lg">Lea Antony</h3>
                        <p class="text-sm">[ 3312301001 ]</p>
                    </div>
                    <div class="p-3 text-center">
                        <p class="text-gray-700">Frontend Developer</p>
                        <div class="mt-3 flex justify-center space-x-3">
                            <a href="https://www.instagram.com/leaantony17" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg></a>
                            <a href="https://github.com/leaantony" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg></a>
                            <a href="https://www.linkedin.com/in/lea-antony/" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg></a>
                        </div>
                    </div>
                </div>

                <!-- Anggota Tim 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="aspect-square">
                        <img src="{{ asset('image/photos/pipit_lolita.png') }}" alt="Pipit Lolita Hapsari"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 bg-[#F59E0B] text-white text-center">
                        <h3 class="font-bold text-lg">Pipit Lolita Hapsari</h3>
                        <p class="text-sm">[ 3312301007 ]</p>
                    </div>
                    <div class="p-3 text-center">
                        <p class="text-gray-700">UI/UX Designer</p>
                        <div class="mt-3 flex justify-center space-x-3">
                            <a href="https://www.instagram.com/pipitlol" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg></a>
                            <a href="https://github.com/pipitlol" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg></a>
                            <a href="https://www.linkedin.com/in/pipitlolita/" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg></a>
                        </div>
                    </div>
                </div>

                <!-- Anggota Tim 4 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                    <div class="aspect-square">
                        <img src="{{ asset('image/photos/firmansyah_pramudia.png') }}" alt="Firmansyah Pramudia"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 bg-[#F59E0B] text-white text-center">
                        <h3 class="font-bold text-lg">Firmansyah Pramudia Ariyanto</h3>
                        <p class="text-sm">[ 3312301030 ]</p>
                    </div>
                    <div class="p-3 text-center">
                        <p class="text-gray-700">Frontend Developer</p>
                        <div class="mt-3 flex justify-center space-x-3">
                            <a href="https://www.instagram.com/firmxn" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg></a>
                            <a href="https://github.com/firmxn" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg></a>
                            <a href="https://www.linkedin.com/in/firmxn/" target="_blank" rel="noopener noreferrer"
                                class="text-gray-600 hover:text-[#F59E0B]"><svg class="w-4 h-4" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Kontak -->
    <section id="kontak" class="py-20">
        <div class="container mx-auto mt-12">
            <div class="relative mx-auto">
                <div class="absolute z-10 right-0 bottom-0 w-full flex justify-end" data-aos="fade-left"
                    data-aos-delay="300">
                    <img src="{{ asset('image/mockups/instagram_mockup.png') }}" alt="NutriMPASI Instagram"
                        class="w-auto h-auto max-h-[180px] xs:max-h-[220px] sm:max-h-[280px] md:max-h-[350px] lg:max-h-[450px]">
                </div>

                <div class="bg-black rounded-3xl overflow-hidden py-8 sm:py-12 px-6 sm:px-8 sm:pt-12"
                    data-aos="fade-right">
                    <div class="flex flex-wrap items-center">
                        <div class="w-full md:w-3/5 pl-2 sm:pl-4">
                            <h2 class="text-white text-2xl sm:text-3xl md:text-4xl font-bold mb-4">
                                Tetap Terhubung,<br>
                                Follow Instagram Kami
                            </h2>

                            <div class="flex items-center mt-4 sm:mt-6">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white mr-2 sm:mr-3" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg>
                                <span class="text-white text-lg sm:text-xl">: @nutrimpasi</span>
                            </div>
                        </div>
                        <div class="w-full md:w-2/5">
                            <div class="h-[160px] sm:h-[180px] md:h-[200px]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bagian Card Popup --}}
    <div id="coming-soon-modal"
        class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-sm mx-auto text-center relative transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full"
            data-aos="zoom-in">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button type="button" id="close-modal-button" class="text-gray-400 hover:text-gray-500 text-2xl"
                    aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="mb-4">
                <img src="{{ asset('image/logo2.png') }}" alt="Alert Icon" class="mx-auto h-16 w-16 text-yellow-500">
            </div>
            <h3 class="text-2xl leading-6 font-medium text-gray-900 mb-2">
                Coming Soon!
            </h3>
            <div class="mt-2 mb-6">
                <p class="text-base text-gray-500">
                    Aplikasi ini sedang dalam pengembangan. Nantikan pembaruan selanjutnya!
                </p>
            </div>
            <div class="mt-5 sm:mt-6">
                <button type="button" id="ok-modal-button"
                    class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-6 py-3 bg-[#F59E0B] text-base font-medium text-white hover:bg-[#E59009] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F59E0B] sm:text-lg">
                    Oke
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle menu mobile
        document.querySelector('button.md\\:hidden').addEventListener('click', function() {
            // Tambahkan fungsi menu mobile di sini jika diperlukan
        });

        // Tambahkan listener animasi scroll untuk memperbarui AOS saat navigasi antar seksi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function() {
                setTimeout(function() {
                    AOS.refresh();
                }, 300);
            });
        });

        // Get the modal and buttons
        const comingSoonModal = document.getElementById('coming-soon-modal');
        const closeModalButton = document.getElementById('close-modal-button');
        const okModalButton = document.getElementById('ok-modal-button');

        // Function to display the pretty alert
        function showComingSoonModal() {
            comingSoonModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        }

        // Function to hide the pretty alert
        function hideComingSoonModal() {
            comingSoonModal.classList.add('hidden');
            document.body.style.overflow = ''; // Re-enable scrolling
        }

        // Attach click event listeners to the download buttons
        document.querySelector('a[href="#"]').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            showComingSoonModal();
        });

        document.getElementById('android-download-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            showComingSoonModal();
        });

        // Event listeners to close the modal
        closeModalButton.addEventListener('click', hideComingSoonModal);
        okModalButton.addEventListener('click', hideComingSoonModal);

        // Close modal when clicking outside of it
        comingSoonModal.addEventListener('click', function(event) {
            if (event.target === comingSoonModal) {
                hideComingSoonModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !comingSoonModal.classList.contains('hidden')) {
                hideComingSoonModal();
            }
        });
    </script>
@endpush
