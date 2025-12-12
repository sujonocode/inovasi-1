<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ASSISTA - BPS Kabupaten Tanggamus</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #0d47a1, #002f6c);
            position: relative;
            font-family: 'Poppins', sans-serif;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255 255 255 / 0.07);
            animation: float 12s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) translateX(0px);
            }

            50% {
                transform: translateY(-40px) translateX(20px);
            }

            100% {
                transform: translateY(0px) translateX(0px);
            }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.3s ease;
            position: relative;
            z-index: 2;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tagline-small {
            font-size: 10px;
            opacity: 0.75;
            color: #e3e8f0;
            line-height: 1.3;
            text-align: center;
            font-style: italic;
        }

        .tagline-card {
            font-size: 11px;
            color: #e3e8f0;
            opacity: 0.75;
            text-align: center;
            margin-top: 5px;
            font-style: italic;
        }

        .divider-line {
            width: 100%;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 10px 0;
        }

        .institution-text {
            font-family: Arial, sans-serif;
            font-style: italic;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .typewriter-cursor {
            display: inline-block;
            width: 8px;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .motivasi-text {
            font-size: 14px;
            font-style: italic;
            font-weight: bold;
            color: #0d47a1;
            letter-spacing: 0.5px;
        }

        .typewriter-cursor {
            display: inline-block;
            width: 6px;
            background-color: #ffffff99;
            margin-left: 3px;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Floating circles background -->
    <div class="circle" style="width: 120px; height: 120px; top: 10%; left: 5%; animation-duration: 15s;"></div>
    <div class="circle" style="width: 180px; height: 180px; top: 50%; left: 80%; animation-duration: 13s;"></div>
    <div class="circle" style="width: 90px; height: 90px; top: 70%; left: 20%; animation-duration: 17s;"></div>
    <div class="circle" style="width: 140px; height: 140px; top: 30%; left: 60%; animation-duration: 19s;"></div>

    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="w-100" style="max-width: 430px;">

            <!-- Header BPS -->
            <div class="d-flex align-items-center justify-content-center text-white mb-4">
                <img src="<?= base_url('assets/image/bps.png') ?>" width="55" class="me-3">

                <div class="text-start">
                    <h6 class="institution-text m-0 text-uppercase">Badan Pusat Statistik</h6>
                    <h6 class="institution-text m-0 text-uppercase">Kabupaten Tanggamus</h6>
                </div>
            </div>

            <!-- LOGIN CARD -->
            <div class="login-card">

                <!-- Logo ASSISTA -->
                <div class="text-center mb-2">
                    <img src="<?= base_url('assets/image/assista.png') ?>" width="55" class="mb-1">
                    <h6 class="text-white-50 fw-semibold">ASSISTA</h6>
                </div>

                <h4 class="text-center text-white mb-3">LOGIN</h4>

                <form action="<?= base_url('/login') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label text-white fw-semibold">Username</label>
                        <input
                            type="text"
                            name="username"
                            class="form-control"
                            placeholder="Masukkan Username"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white fw-semibold">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan Password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login">
                        Login
                    </button>

                </form>

                <!-- Divider -->
                <div class="divider-line"></div>

                <!-- Tagline Utama -->
                <div class="tagline-card text-center">
                    Aplikasi Satu Sistem Internal, SuperApp Terpadu dan Adaptif<br>
                    <span class="fst-italic">
                        A Single-System Internal SuperApp for Integrated and Adaptive Services
                    </span>
                </div>

                <!-- Subtagline -->
                <div class="tagline-card mt-2 fw-bold text-center">
                    — Satu Aplikasi, Semua Terhubung —
                </div>

            </div>

            <!-- Teks Motivasi Di Luar Card -->
            <div class="text-center mt-5">
                <small
                    id="typewriterText"
                    class="text-white-50 fst-italic"
                    style="font-size: 0.95rem;">
                </small>
                <span id="cursor" class="typewriter-cursor"></span>
            </div>


            <!-- <script>
                const quotes = [
                    "Tetap fokus, setiap langkah kecil membawa perubahan besar.",
                    "Kerja keras hari ini adalah kesuksesan esok.",
                    "Jaga semangat, jangan berhenti berkembang.",
                    "Konsisten lebih penting daripada cepat."
                ];

                const textElement = document.getElementById("typewriterText");

                function typeEffect(text, index = 0) {
                    if (index < text.length) {
                        textElement.textContent += text.charAt(index);
                        setTimeout(() => typeEffect(text, index + 1), 50);
                    }
                }

                function showRandomQuote() {
                    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
                    textElement.textContent = "";
                    typeEffect(randomQuote);
                }

                document.addEventListener("DOMContentLoaded", showRandomQuote);
            </script> -->

            <script>
                // QUOTES UMUM (20)
                const generalQuotes = [
                    "Tetap fokus, setiap langkah kecil membawa perubahan besar.",
                    "Kerja keras hari ini membangun masa depanmu.",
                    "Jaga semangat, jangan berhenti berkembang.",
                    "Konsisten lebih penting daripada cepat.",
                    "Setiap usaha kecil tetap berarti.",
                    "Percaya proses, hasil akan mengikuti.",
                    "Tidak apa-apa pelan, yang penting terus maju.",
                    "Bangkit lagi, hari ini kesempatan baru.",
                    "Fokus pada progress, bukan kesempurnaan.",
                    "Disiplin adalah kunci kekuatan diri.",
                    "Kamu lebih mampu dari yang kamu pikirkan.",
                    "Jangan menyerah sebelum mencoba sepenuhnya.",
                    "Sukses dibangun dari kebiasaan kecil.",
                    "Satu langkah hari ini lebih baik daripada diam.",
                    "Teruslah belajar, teruslah tumbuh.",
                    "Setiap tantangan adalah kesempatan menyala.",
                    "Kerja baik akan berbuah baik.",
                    "Pikiran positif membawa energi positif.",
                    "Kejar kualitas, bukan hanya kuantitas.",
                    "Hidup bergerak maju, kamu juga harus.",

                    "Tetap semangat… kerja tidak menunggu mood.",
                    "Hari ini berat? Wajar, namanya juga kerja bukan piknik.",
                    "Kalau tugas menumpuk, ingat: itu tanda kamu dibutuhkan… atau lupa bilang 'TIDAK'.",
                    "Jangan menyerah. Aplikasi error itu bagian dari perjalanan.",
                    "Tenang, tanggal gajian tidak pernah PHP.",
                    "Kalau pusing, tarik napas. Kalau tetap pusing, mungkin waktunya minum air.",
                    "Kerja itu kadang bukan soal bisa, tapi soal dikejar deadline.",
                    "Capek itu wajar. Yang tidak wajar itu kalau semua tiba-tiba lancar.",
                    "Kalau bingung, baca lagi. Kalau tetap bingung, tanya. Kalau makin bingung, istirahat sebentar.",
                    "Ingat: laporan hari ini adalah ketenangan hidup minggu depan.",
                    "Kalau pekerjaan terasa banyak, ingat: itu karena memang banyak.",
                ];

                // QUOTES PAGI (4)
                const morningQuotes = [
                    "Selamat pagi! Hari baru ini penuh peluang untuk kamu raih.",
                    "Pagi adalah waktu terbaik untuk memulai hal besar.",
                    "Awali pagi dengan senyum, karena energi positif dimulai dari sana.",
                    "Semangat pagi! Langkah kecil hari ini bisa menghasilkan perubahan besar.",
                    "Pagi ini adalah kesempatan baru untuk menjadi lebih baik dari kemarin.",
                    "Nikmati udara pagi, karena ketenangannya membawa inspirasi.",
                    "Pagi selalu membawa harapan—jangan lewatkan pesannya.",
                    "Setiap pagi adalah pengingat bahwa kamu masih diberi kesempatan.",
                    "Pagi yang indah dimulai dengan hati yang bersyukur.",
                    "Jadikan pagi ini sebagai awalan untuk sesuatu yang besar."
                ];


                // QUOTES SIANG (4)
                const noonQuotes = [
                    "Selamat siang! Jangan lupa ambil jeda agar tetap fokus.",
                    "Siang adalah waktu untuk menyegarkan energi, bukan menyerah.",
                    "Tetap semangat di siang hari, perjalananmu masih panjang.",
                    "Jangan biarkan lelah di siang hari menghentikan langkahmu.",
                    "Siang ini adalah kesempatan untuk memperbaiki apa yang tertunda.",
                    "Luangkan waktu sejenak di siang hari untuk bernapas dan tenang.",
                    "Siang adalah waktu yang tepat untuk mengevaluasi progresmu hari ini.",
                    "Jangan lupa makan siang—energi baik datang dari tubuh yang kuat.",
                    "Selamat siang! Fokus kecil menghasilkan pencapaian besar.",
                    "Siang yang produktif dimulai dari pikiran yang terarah."
                ];


                // QUOTES SORE (4)
                const eveningQuotes = [
                    "Selamat sore! Terima kasih sudah bertahan sejauh ini.",
                    "Sore yang tenang adalah hadiah setelah kerja kerasmu.",
                    "Gunakan sore hari untuk merayakan langkah kecilmu.",
                    "Sore adalah waktu untuk meregangkan lelah, bukan menyerah.",
                    "Terus melangkah, sore ini kamu sudah melakukan yang terbaik.",
                    "Selamat sore! Hargai diri sendiri karena telah berusaha.",
                    "Sore yang damai datang untuk menenangkan pikiranmu.",
                    "Jadikan sore sebagai waktu refleksi atas perjuangan hari ini.",
                    "Sore ini adalah kesempatan untuk menutup hari dengan baik.",
                    "Di sore hari, biarkan dirimu merasa cukup dengan apa yang telah dilakukan."
                ];


                // QUOTES MALAM (4)
                const nightQuotes = [
                    "Selamat malam—kamu sudah berjuang jauh hari ini.",
                    "Malam adalah waktu yang tepat untuk menenangkan hati.",
                    "Jika malam terasa panjang, itu tandanya kamu sedang tumbuh.",
                    "Tenanglah, malam ini kamu tetap mampu menyelesaikan apa yang perlu.",
                    "Selamat malam! Biarkan dirimu beristirahat dengan damai.",
                    "Malam membawa ketenangan untuk memulihkan semangatmu.",
                    "Gunakan malam ini untuk bersyukur atas langkah yang sudah ditempuh.",
                    "Malam adalah waktu untuk memperbaiki energi untuk esok.",
                    "Jika kamu masih bekerja di malam hari, ingat bahwa kamu kuat.",
                    "Selamat malam—besok adalah kesempatan baru untuk bersinar.",

                    "Sudah malam… kok belum pulang? Lampu di belakang barusan kedip loh.",
                    "Lembur sendirian? Hebat. Di belakang kamu tadi kayak ada yang lewat.",
                    "Kerja malam memang sunyi… sampai kamu sadar ada suara keyboard selain punyamu.",
                    "Tenang… kalau merasa diawasi, mungkin cuma bayangan. Atau bukan.",
                    "Sudah malam, sepi banget ya… cocok buat dengar suara langkah yang tidak kamu buat.",
                    "Tetap semangat lemburnya! Tapi jangan kaget kalau ada kursi yang tiba-tiba bergeser.",
                    "Jam segini? Harusnya pulang. Kantor kalau malam suka ramai oleh yang tidak terlihat.",
                    "Fokus kerja ya… jangan lihat ke belakang. Serius, jangan sekarang.",
                    "Malam-malam masih buka laptop? Hati-hati, ada yang suka mengintip dari sudut ruangan.",
                    "Lampu monitor kamu terang sekali… makanya dari jauh 'mereka' bisa lihat kamu."
                ];



                const textElement = document.getElementById("typewriterText");

                // Efek mengetik
                function typeEffect(text, i = 0) {
                    if (i < text.length) {
                        textElement.textContent += text.charAt(i);
                        setTimeout(() => typeEffect(text, i + 1), 50);
                    }
                }

                // Pilih quotes berdasarkan jam user
                function getQuoteByTime() {
                    const hour = new Date().getHours();

                    if (hour >= 5 && hour < 9) {
                        return morningQuotes[Math.floor(Math.random() * morningQuotes.length)];
                    } else if (hour >= 12 && hour < 13) {
                        return noonQuotes[Math.floor(Math.random() * noonQuotes.length)];
                    } else if (hour >= 16 && hour < 18) {
                        return eveningQuotes[Math.floor(Math.random() * eveningQuotes.length)];
                    } else if (hour >= 18 && hour < 24) {
                        return nightQuotes[Math.floor(Math.random() * nightQuotes.length)];
                    } else {
                        return generalQuotes[Math.floor(Math.random() * generalQuotes.length)];
                    }
                }

                // Kombinasi: 80% quotes waktu, 20% quotes umum (biar variasi)
                function getFinalQuote() {
                    const chance = Math.random();

                    if (chance < 0.8) {
                        return getQuoteByTime();
                    } else {
                        return generalQuotes[Math.floor(Math.random() * generalQuotes.length)];
                    }
                }

                // Tampilkan saat halaman dimuat
                document.addEventListener("DOMContentLoaded", function() {
                    const quote = getFinalQuote();
                    textElement.textContent = "";
                    typeEffect(quote);
                });
            </script>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>