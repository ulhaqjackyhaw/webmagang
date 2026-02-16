<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - URSHIPORTS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @keyframes successPop {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-success {
            animation: successPop 0.6s ease-out;
        }

        .animate-fade-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
            opacity: 0;
        }

        .delay-200 {
            animation-delay: 0.2s;
            opacity: 0;
        }

        .delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center py-12"
    style="background: linear-gradient(135deg, rgba(32, 178, 170, 0.05) 0%, #ffffff 50%, rgba(32, 178, 170, 0.08) 100%);">
    <div class="container mx-auto px-4">
        <!-- Logo Header -->
        <div class="text-center mb-8 animate-fade-up">
            <img src="{{ asset('images/company-logo.png') }}" alt="Injourney Airports" class="h-14 mx-auto mb-4">
        </div>

        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Success Icon Section -->
            <div class="pt-12 pb-8 px-6 text-center"
                style="background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);">
                <div
                    class="animate-success bg-white rounded-full w-28 h-28 flex items-center justify-center mx-auto mb-6 shadow-xl">
                    <i class="fas fa-check text-5xl" style="color: #20B2AA;"></i>
                </div>
                <h1 class="text-4xl font-bold text-white mb-3 animate-fade-up delay-100">Pendaftaran Berhasil!</h1>
                <p class="text-lg animate-fade-up delay-200" style="color: rgba(255,255,255,0.9);">ID Pendaftaran:
                    #{{ str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) }}</p>
            </div>


            <!-- Content Section -->
            <div class="p-10">
                <div class="text-center mb-8">
                    <p class="text-xl text-gray-700 leading-relaxed">
                        Terima kasih telah mendaftar program magang <strong
                            style="color: #20B2AA;">URSHIPORTS</strong>.<br>
                        Data Anda telah kami terima dengan baik dan sedang dalam proses review oleh tim kami.
                    </p>
                </div>

                <!-- Timeline -->
                <div class="rounded-2xl p-8 mb-8"
                    style="background: linear-gradient(135deg, rgba(32, 178, 170, 0.08) 0%, rgba(32, 178, 170, 0.12) 100%);">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Langkah Selanjutnya</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0 shadow-lg"
                                style="background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);">
                                <span class="text-white font-bold">1</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800 mb-1">Review Berkas</h4>
                                <p class="text-gray-600">Tim HC kami akan mereview semua dokumen dan data yang Anda
                                    kirimkan</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0 shadow-lg"
                                style="background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);">
                                <span class="text-white font-bold">2</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800 mb-1">Notifikasi WhatsApp</h4>
                                <p class="text-gray-600">Anda akan dihubungi melalui WhatsApp dalam <strong>3-5 hari
                                        kerja</strong></p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0 shadow-lg"
                                style="background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);">
                                <span class="text-white font-bold">3</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800 mb-1">Konfirmasi & Informasi</h4>
                                <p class="text-gray-600">Informasi lengkap mengenai hasil seleksi dan jadwal magang akan
                                    diberikan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6 mb-8">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-2">Penting!</h4>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>• Pastikan nomor WhatsApp Anda aktif dan dapat dihubungi</li>
                                <li>• Periksa pesan masuk secara berkala</li>
                                <li>• Simpan nomor kami agar pesan tidak masuk ke spam</li>
                                <li>• Jika dalam 7 hari kerja belum ada kabar, hubungi kami</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('public.landing') }}"
                        class="inline-flex items-center justify-center text-white font-bold py-5 px-12 rounded-full transition duration-300 shadow-lg transform hover:scale-105"
                        style="background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('public.register') }}"
                        class="inline-flex items-center justify-center bg-white font-bold py-5 px-12 rounded-full transition duration-300 shadow-lg transform hover:scale-105"
                        style="color: #20B2AA; border: 2px solid #20B2AA;">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Daftar Lagi
                    </a>
                </div>
            </div>

            <!-- Footer Contact -->
            <div class="bg-gray-50 px-10 py-6 text-center border-t">
                <p class="text-sm text-gray-600 mb-2">Butuh bantuan atau ada pertanyaan?</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-sm">
                    <a href="mailto:admin@injourney-airports.co.id" class="flex items-center transition"
                        style="color: #20B2AA;">
                        <i class="fas fa-envelope mr-2"></i>
                        admin@injourney-airports.co.id
                    </a>
                    <span class="hidden sm:inline text-gray-400">|</span>
                    <a href="https://wa.me/6281234567890" class="flex items-center transition" style="color: #20B2AA;">
                        <i class="fab fa-whatsapp mr-2"></i>
                        +62 812-3456-7890
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center mt-8 text-gray-600">
            <p class="text-sm">© {{ date('Y') }} Injourney Airports Kantor Regional I</p>
            <p class="text-xs mt-1" style="color: #20B2AA;">URSHIPORTS - Your Internship Programme</p>
        </div>
    </div>
</body>

</html>
