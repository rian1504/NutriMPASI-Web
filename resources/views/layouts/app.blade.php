<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'NutriMPASI') }}</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#F59E0B',
                        'primary-dark': '#E59009',
                        'secondary': '#5966B1',
                        'dark': '#242A41',
                        'accent': '#585EA8',
                    }
                }
            }
        }
    </script>
    
    <!-- Gaya Kustom -->
    <style>
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .yellow-radial-gradient {
            background: radial-gradient(circle, rgba(245, 158, 11, 0.5) 0%, rgba(245, 158, 11, 0.2) 20%, rgba(255, 255, 255, 1) 60%);
        }
        
        .shadow-navbar {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        /* Animasi fade-in untuk menu mobile */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.2s ease-in-out forwards;
        }
    </style>
    
    @yield('styles')
</head>
<body class="antialiased">
    <div id="app" class="overflow-hidden">
        <!-- Navbar -->
        <nav class="bg-white shadow-navbar py-4 fixed top-0 left-0 right-0 w-full z-50">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="#top" class="flex items-center">
                    <img src="{{ asset('image/logo/navbar_logo.png') }}" alt="NutriMPASI Logo" class="h-10">
                    <span class="text-2xl font-extrabold ml-2"><span class="text-[#5966B1]">Nutri</span><span class="text-[#F59E0B]">MPASI</span></span>
                </a>
                <div class="hidden md:flex space-x-8">
                    <a href="#top" class="nav-link text-gray-700 hover:text-[#F59E0B] text-lg font-medium" data-section="top">Beranda</a>
                    <a href="#produk" class="nav-link text-gray-700 hover:text-[#F59E0B] text-lg font-medium" data-section="produk">Produk</a>
                    <a href="#fitur" class="nav-link text-gray-700 hover:text-[#F59E0B] text-lg font-medium" data-section="fitur">Fitur</a>
                    <a href="#tentang-kami" class="nav-link text-gray-700 hover:text-[#F59E0B] text-lg font-medium" data-section="tentang-kami">Tentang Kami</a>
                    <a href="#kontak" class="nav-link text-gray-700 hover:text-[#F59E0B] text-lg font-medium" data-section="kontak">Kontak</a>
                </div>
                <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Menu Mobile -->
            <div id="mobile-menu" class="md:hidden bg-white absolute w-full left-0 top-full z-20 shadow-lg hidden">
                <div class="py-2 px-4 space-y-3">
                    <a href="#top" class="mobile-nav-link block py-2 px-4 text-gray-700 hover:text-[#F59E0B] hover:bg-gray-50 font-medium hover:border-l-4 hover:border-[#F59E0B]" data-section="top">Beranda</a>
                    <a href="#produk" class="mobile-nav-link block py-2 px-4 text-gray-700 hover:text-[#F59E0B] hover:bg-gray-50 font-medium hover:border-l-4 hover:border-[#F59E0B]" data-section="produk">Produk</a>
                    <a href="#fitur" class="mobile-nav-link block py-2 px-4 text-gray-700 hover:text-[#F59E0B] hover:bg-gray-50 font-medium hover:border-l-4 hover:border-[#F59E0B]" data-section="fitur">Fitur</a>
                    <a href="#tentang-kami" class="mobile-nav-link block py-2 px-4 text-gray-700 hover:text-[#F59E0B] hover:bg-gray-50 font-medium hover:border-l-4 hover:border-[#F59E0B]" data-section="tentang-kami">Tentang Kami</a>
                    <a href="#kontak" class="mobile-nav-link block py-2 px-4 text-gray-700 hover:text-[#F59E0B] hover:bg-gray-50 font-medium hover:border-l-4 hover:border-[#F59E0B]" data-section="kontak">Kontak</a>
                </div>
            </div>
        </nav>

        <div class="h-[72px]"></div>

        <!-- Konten Utama -->
        @yield('content')
        
        <!-- Footer -->
        <footer class="bg-[#F59E0B] py-12 text-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Kolom 1: Logo & Deskripsi -->
                    <div class="col-span-1">
                        <div class="flex items-center mb-4">
                            <div class="bg-white p-2 rounded-full mr-3">
                                <img src="{{ asset('image/logo/navbar_logo.png') }}" alt="NutriMPASI Logo" class="h-9">
                            </div>
                            <span class="text-2xl font-extrabold">NutriMPASI</span>
                        </div>
                        <p class="text-white/90 text-sm mt-3">
                            NutriMPASI merupakan aplikasi mobile berbasis AI yang dirancang untuk membantu orang tua menyusun MPASI yang sesuai kebutuhan gizi bayi secara mudah dan tepat.
                        </p>
                    </div>

                    <!-- Kolom 2: Tautan Proyek -->
                    <div class="col-span-1">
                        <h3 class="text-xl font-bold mb-4">Tautan Proyek</h3>
                        <ul class="space-y-2">
                            <li><a href="https://github.com/rian1504/NutriMPASI-Mobile" target="_blank" rel="noopener noreferrer" class="hover:underline">GitHub Mobile</a></li>
                            <li><a href="https://github.com/rian1504/NutriMPASI-Web" target="_blank" rel="noopener noreferrer" class="hover:underline">GitHub Web</a></li>
                            <li><a href="https://youtu.be/99fju-8Rmbg" target="_blank" rel="noopener noreferrer" class="hover:underline">Demo Video</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 3: Halaman -->
                    <div class="col-span-1">
                        <h3 class="text-xl font-bold mb-4">Halaman</h3>
                        <ul class="space-y-2">
                            <li><a href="#top" class="hover:underline">Beranda</a></li>
                            <li><a href="#produk" class="hover:underline">Produk</a></li>
                            <li><a href="#fitur" class="hover:underline">Fitur</a></li>
                            <li><a href="#tentang-kami" class="hover:underline">Tentang Kami</a></li>
                            <li><a href="#kontak" class="hover:underline">Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Kolom 4: Kontak -->
                    <div class="col-span-1">
                        <h3 class="text-xl font-bold mb-4">Kontak</h3>
                        <p class="mb-4">Batam, Kepulauan Riau</p>
                        <div class="flex space-x-3 mt-4">
                            <a href="mailto:nutrimpasi@gmail.com" target="_blank" rel="noopener noreferrer" class="bg-white rounded-full p-2 hover:bg-white/80">
                                <svg class="w-5 h-5 text-[#F59E0B]" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </a>
                            <a href="https://instagram.com/nutrimpasi" target="_blank" rel="noopener noreferrer" class="bg-white rounded-full p-2 hover:bg-white/80">
                                <svg class="w-5 h-5 text-[#F59E0B]" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Hak Cipta -->
                <div class="mt-12 pt-8 border-t border-white/20 text-center">
                    <p>© 2025 NutriMPASI. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Skrip toggle menu mobile dan scrollspy -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi menu mobile
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.classList.add('animate-fadeIn');
                } else {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Tutup menu saat klik pada item menu mobile
            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            });

            // Tutup menu mobile saat klik diluar menu
            document.addEventListener('click', function(event) {
                const isClickInsideMenu = mobileMenu.contains(event.target);
                const isClickOnButton = mobileMenuButton.contains(event.target);
                
                if (!isClickInsideMenu && !isClickOnButton && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Fungsi scrollspy
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
            
            // Atur Beranda sebagai aktif secara default
            setActiveLink('top');
            
            function setActiveLink(sectionId) {
                // Link navigasi desktop
                navLinks.forEach(link => {
                    if (link.dataset.section === sectionId) {
                        link.classList.add('text-[#F59E0B]');
                        link.classList.remove('text-gray-700');
                    } else {
                        link.classList.remove('text-[#F59E0B]');
                        link.classList.add('text-gray-700');
                    }
                });
                
                // Link navigasi mobile
                mobileNavLinks.forEach(link => {
                    if (link.dataset.section === sectionId) {
                        link.classList.add('text-[#F59E0B]', 'border-l-4', 'border-[#F59E0B]');
                        link.classList.remove('hover:border-l-4');
                    } else {
                        link.classList.remove('text-[#F59E0B]', 'border-l-4', 'border-[#F59E0B]');
                        link.classList.add('hover:border-l-4');
                    }
                });
            }
            
            function onScroll() {
                const scrollPos = window.pageYOffset;
                const windowHeight = window.innerHeight;
                const documentHeight = Math.max(
                    document.body.scrollHeight,
                    document.body.offsetHeight,
                    document.documentElement.clientHeight,
                    document.documentElement.scrollHeight,
                    document.documentElement.offsetHeight
                );
                
                if (scrollPos < 200) {
                    setActiveLink('top');
                    return;
                }
                
                if (scrollPos + windowHeight >= documentHeight - 50) {
                    setActiveLink('kontak');
                    return;
                }
                
                let visibleSections = [];
                
                sections.forEach(section => {
                    const sectionId = section.getAttribute('id');
                    const rect = section.getBoundingClientRect();
                    const sectionTop = rect.top + scrollPos;
                    const sectionBottom = rect.bottom + scrollPos;
                    const sectionHeight = rect.height;
                    
                    const viewportMid = scrollPos + windowHeight/3;
                    const largeSection = sectionHeight > windowHeight * 0.7;
                    
                    if ((sectionTop <= viewportMid && sectionBottom >= viewportMid) || 
                        (largeSection && scrollPos >= sectionTop - 100 && scrollPos <= sectionBottom - 100)) {
                        visibleSections.push({
                            id: sectionId,
                            area: Math.min(sectionBottom, scrollPos + windowHeight) - 
                                Math.max(sectionTop, scrollPos),
                            top: sectionTop
                        });
                    }
                });
                
                if (visibleSections.length > 0) {
                    visibleSections.sort((a, b) => b.area - a.area);
                    setActiveLink(visibleSections[0].id);
                } else {
                    let closestSection = null;
                    let minDistance = Infinity;
                    
                    sections.forEach(section => {
                        const rect = section.getBoundingClientRect();
                        const distance = Math.abs(rect.top);
                        
                        if (distance < minDistance) {
                            minDistance = distance;
                            closestSection = section.getAttribute('id');
                        }
                    });
                    
                    if (closestSection) {
                        setActiveLink(closestSection);
                    } else {
                        setActiveLink('top');
                    }
                }
            }
            
            let scrollTimeout;
            window.addEventListener('scroll', function() {
                if (!scrollTimeout) {
                    scrollTimeout = setTimeout(function() {
                        onScroll();
                        scrollTimeout = null;
                    }, 100);
                }
            });
            
            onScroll();
            setTimeout(onScroll, 200);
            
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href').substring(1);
                    if (targetId === '') return;
                    
                    if (targetId === 'top') {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        return;
                    }
                    
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        let offsetY = 80;
                        
                        if (targetId === 'tentang-kami') {
                            offsetY = 120;
                        }
                        
                        window.scrollTo({
                            top: targetElement.offsetTop - offsetY,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
    
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: false,
            mirror: false,
        });
    </script>
    
    @stack('scripts')
</body>
</html>
