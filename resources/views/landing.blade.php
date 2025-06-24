<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Janji Temu Dokter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .hero-section {
            background-color: #3b82f6;
        }
        
        .login-card {
            transition: transform 0.2s ease;
        }
        
        .login-card:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Hero Section -->
    <main class="flex-grow">
        <section class="hero-section text-white">
            <div class="max-w-4xl mx-auto px-4 py-16">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-4">Sistem Poliklinik</h1>
                    <p class="text-lg max-w-2xl mx-auto">Membuat janji temu dengan dokter menjadi lebih mudah dan efisien</p>
                </div>
            </div>
        </section>

        <!-- Login Options -->
        <section class="max-w-4xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="login-card bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pasien</h3>
                    <p class="text-gray-600 mb-4">Login untuk membuat janji temu atau melihat riwayat</p>
                    <a href="{{ route('login') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md">Login Pasien</a>
                </div>
                
                <div class="login-card bg-white rounded-lg shadow-md p-8 text-center">
                    <div class="flex justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Dokter</h3>
                    <p class="text-gray-600 mb-4">Login untuk mengelola jadwal dan pasien</p>
                    <a href="{{ route('login') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md">Login Dokter</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t border-gray-200 py-6">
        <div class="max-w-4xl mx-auto px-4 text-center text-gray-500 text-sm">
            <p>&copy; 2025 Sistem Poliklinik. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
