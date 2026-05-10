<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - Nauval & Zaneta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Jost:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="{{ isset($guest) && $guest->category === 'colleague' ? 'font-large' : '' }}">

    <!-- ========= COVER ========= -->
    <div id="cover">
        <div class="envelope-decor"></div>
        <svg class="cover-ornament" viewBox="0 0 120 120" fill="none">
            <circle cx="60" cy="60" r="55" stroke="#c9a96e" stroke-width="0.5" opacity="0.5" />
            <circle cx="60" cy="60" r="45" stroke="#c9a96e" stroke-width="0.5" opacity="0.3" />
            <path d="M60 20 L64 50 L60 55 L56 50 Z" fill="#c9a96e" opacity="0.6" />
            <path d="M60 100 L64 70 L60 65 L56 70 Z" fill="#c9a96e" opacity="0.6" />
            <path d="M20 60 L50 64 L55 60 L50 56 Z" fill="#c9a96e" opacity="0.6" />
            <path d="M100 60 L70 64 L65 60 L70 56 Z" fill="#c9a96e" opacity="0.6" />
            <circle cx="60" cy="60" r="8" fill="none" stroke="#c9a96e" stroke-width="0.8" />
            <circle cx="60" cy="60" r="3" fill="#c9a96e" />
        </svg>
        <div class="cover-tag">Undangan Pernikahan</div>
        <div class="cover-title"><span>Nauval</span> & <span>Zaneta</span></div>
        <div class="cover-subtitle">29 · 05 · 2026</div>
        <div class="cover-line"></div>
        @if($guest)
            <div class="cover-guest">
                <span>Kepada Yth.</span>
                <strong>{{ $guest->name }}</strong>
            </div>
        @endif
        <button class="open-btn" onclick="openInvitation()">
            <span>✦</span> Buka Undangan <span>✦</span>
        </button>
    </div>

    <!-- ========= MAIN ========= -->
    <div id="main">

        <!-- HERO -->
        <section class="hero" id="section-hero">
            <div class="petals-canvas" id="petals"></div>
            <div class="hero-tag">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</div>
            <div class="hero-names">
                Nauval<span class="amp">&</span>Zaneta
            </div>
            <div class="hero-date">Jum'at, 29 Mei 2026</div>
            <div class="hero-divider">✦</div>
            @if($guest)
                <p style="font-size:13px;color:rgba(250,246,239,0.5);letter-spacing:1px;text-align:center;">
                    Dengan penuh kebahagiaan, kami mengundang<br>
                    <span
                        style="color:var(--gold-light);font-size:16px;font-family:'Cormorant Garamond',serif;">{{ $guest->name }}</span>
                </p>
            @else
                <p style="font-size:13px;color:rgba(250,246,239,0.5);letter-spacing:1px;text-align:center;max-width:400px;">
                    Dengan penuh kebahagiaan, kami mengundang Bapak/Ibu/Saudara/i untuk hadir di hari bahagia kami
                </p>
            @endif
            <div class="scroll-hint">
                <span>Scroll</span>
                <div class="scroll-arrow"></div>
            </div>
        </section>

        <!-- ======== AYAT AL-QUR'AN ======== -->
        <section class="section" id="section-quran">
            <div class="container">
                <div class="reveal">
                    <div class="quran-box">
                        <div class="quran-arabic">
                            وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا إِلَيْهَا
                            وَجَعَلَ بَيْنَكُم مَّوَدَّةً وَرَحْمَةً ۚ إِنَّ فِي ذَٰلِكَ لَآيَاتٍ لِّقَوْمٍ
                            يَتَفَكَّرُونَ
                        </div>
                        <div class="quran-translation">
                            "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu
                            dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan
                            di antaramu rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat
                            tanda-tanda (kebesaran Allah) bagi kaum yang berpikir."
                        </div>
                        <div class="quran-source">QS. Ar-Rum : 21</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- COUPLE -->
        <section class="section" id="section-couple" style="padding-top:20px;">
            <div class="container">
                <div class="reveal">
                    <div class="section-tag">Mempelai</div>
                    <div class="section-title">Dua Hati Menjadi Satu</div>
                </div>
                <div class="couple-grid reveal">
                    <div class="couple-groom">
                        <div class="couple-name">Moch Nauval Alfarisi</div>
                        <div class="couple-parent">
                            Putra kedua dari<br>
                            <strong>Bapak Maruji</strong><br>
                            &amp; <strong>Ibu Siti Kholifah</strong>
                        </div>
                    </div>
                    <div class="couple-sep">&amp;</div>
                    <div class="couple-bride">
                        <div class="couple-name">Zaneta Izdihar Raissa</div>
                        <div class="couple-parent">
                            Putri pertama dari<br>
                            <strong>Bapak Solehuddin</strong><br>
                            &amp; <strong>Ibu Dwi Lestari</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOTO -->
        <section class="photo-section" id="section-photos">
            <div class="container">
                <div class="reveal">
                    <div class="section-tag" style="color:var(--gold)">Foto Bersama</div>
                    <div class="section-title light">Kenangan Indah</div>
                </div>
                <div class="photo-grid reveal">
                    <div class="photo-frame main">
                        <img src="{{ asset('photos/foto_wedding.jpg') }}"
                            style="width:100%;height:100%;object-fit:cover;object-position:top">
                        <div class="photo-placeholder">
                            <div class="photo-icon">📸</div>
                            <span>Foto Berdua Utama</span>
                        </div>
                    </div>
                    <div class="photo-frame side">
                        <img src="{{ asset('photos/echa_kecil.jpg') }}" style="width:100%;height:100%;object-fit:cover">
                        <div class="photo-placeholder">
                            <div class="photo-icon">🌸</div>
                            <span>Foto 2</span>
                        </div>
                    </div>
                    <div class="photo-frame side">
                        <img src="{{ asset('photos/noppeng_kecil.jpg') }}"
                            style="width:100%;height:100%;object-fit:cover">
                        <div class="photo-placeholder">
                            <div class="photo-icon">💍</div>
                            <span>Foto 3</span>
                        </div>
                    </div>
                </div>
                <p class="photo-caption reveal">Nauval & Zaneta · 2026</p>
            </div>
        </section>

        <!-- LOVE STORY -->
        <section class="section" id="section-story">
            <div class="container">
                <div class="reveal">
                    <div class="section-tag">Kisah Kami</div>
                    <div class="section-title">Cerita Cinta</div>
                </div>

                <div class="story-timeline reveal">
                    <div class="story-item">
                        <div class="story-year">Masa SMP</div>
                        <div class="story-heading">Awal Pertemuan</div>
                        <div class="story-text">
                            Kita berdua sudah saling mengenal sejak masih duduk di bangku SMP.
                            Waktu itu semuanya terasa sederhana—sekadar saling sapa, bercanda di kelas,
                            dan perlahan tumbuh rasa yang bahkan belum kami pahami sepenuhnya.
                            Hingga akhirnya, di kelas 7 SMP, kami memutuskan untuk berpacaran.
                            Hubungan pertama kami memang sangat singkat, hanya berlangsung selama 13 hari,
                            namun cukup untuk meninggalkan kenangan kecil yang manis.
                        </div>
                    </div>

                    <div class="story-item">
                        <div class="story-year">Kelas 8 SMP</div>
                        <div class="story-heading">Kembali Bersama</div>
                        <div class="story-text">
                            Waktu terus berjalan, dan saat kami naik ke kelas 8 SMP,
                            entah bagaimana kami kembali dekat. Rasa yang dulu sempat hilang,
                            muncul lagi dengan cara yang lebih kuat. Kami pun memutuskan untuk
                            mencoba kembali menjalani hubungan yang kali ini terasa lebih serius.
                            Hari demi hari kami lewati bersama, hingga akhirnya hubungan itu
                            bertahan cukup lama bahkan sampai kami duduk di bangku kelas 10 SMA.
                        </div>
                    </div>

                    <div class="story-item">
                        <div class="story-year">Masa SMA</div>
                        <div class="story-heading">Perpisahan Sementara</div>
                        <div class="story-text">
                            Saat SMA, kami masih berada di sekolah yang sama.
                            Banyak momen yang kami lalui bersama, mulai dari hal-hal kecil
                            hingga kenangan yang terasa begitu berarti. Namun seperti kebanyakan cerita,
                            tidak semuanya berjalan mulus. Ada banyak masalah yang perlahan menguji hubungan kami.
                            Sampai akhirnya, di kelas 10 SMA, kami sepakat untuk tidak melanjutkan hubungan tersebut.
                        </div>
                    </div>

                    <div class="story-item">
                        <div class="story-year">2025</div>
                        <div class="story-heading">Dipertemukan Kembali</div>
                        <div class="story-text">
                            Sejak saat itu, kami benar-benar kehilangan kontak.
                            Tidak ada kabar dan tidak ada komunikasi, seolah kami berjalan
                            di kehidupan masing-masing tanpa saling tahu.
                            Hingga akhirnya, di akhir bulan Juni tahun 2025,
                            takdir mempertemukan kami kembali.
                            Kami mulai berbicara lagi dan perlahan membuka kembali
                            cerita yang sempat terhenti.
                        </div>
                    </div>

                    <div class="story-item">
                        <div class="story-year">Selamanya</div>
                        <div class="story-heading">Menuju Masa Depan Bersama</div>
                        <div class="story-text">
                            Dan sejak saat itu, kami kembali bersama.
                            Kali ini dengan perasaan yang lebih dewasa,
                            lebih memahami satu sama lain,
                            serta berharap hubungan ini dapat bertahan lebih lama,
                            bukan hanya untuk hari ini, tetapi untuk selamanya.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- COUNTDOWN + EVENTS -->
        <section class="section-dark" id="section-events">
            <div class="container">
                <div class="reveal">
                    <div class="section-tag" style="color:var(--gold)">Hitung Mundur</div>
                    <div class="section-title light">Menuju Hari Bahagia</div>
                </div>
                <div class="countdown reveal" id="countdown">
                    <div class="countdown-item">
                        <span class="countdown-num" id="cd-days">00</span>
                        <div class="countdown-label">Hari</div>
                    </div>
                    <div class="countdown-sep">:</div>
                    <div class="countdown-item">
                        <span class="countdown-num" id="cd-hours">00</span>
                        <div class="countdown-label">Jam</div>
                    </div>
                    <div class="countdown-sep">:</div>
                    <div class="countdown-item">
                        <span class="countdown-num" id="cd-mins">00</span>
                        <div class="countdown-label">Menit</div>
                    </div>
                    <div class="countdown-sep">:</div>
                    <div class="countdown-item">
                        <span class="countdown-num" id="cd-secs">00</span>
                        <div class="countdown-label">Detik</div>
                    </div>
                </div>

                <div style="margin-top:50px;">
                    <!-- AKAD NIKAH -->
                    <div class="event-card reveal">
                        <div class="event-type">Akad Nikah</div>
                        <div class="event-title">Ijab Kabul</div>
                        <div class="event-info">
                            <div class="event-info-row">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c9a96e"
                                    stroke-width="1.5">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                                Jum'at, 29 Mei 2026 · 14.00 – 15.00 WIB
                            </div>
                            <div class="event-info-row">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c9a96e"
                                    stroke-width="1.5">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                Kediaman Zaneta, Jl. Manyar Sabrangan No. 141, Surabaya
                            </div>
                        </div>
                        <div class="maps-block">
                            <a class="maps-btn" href="https://maps.app.goo.gl/XC6QnChqsYpn64JG8" target="_blank"
                                rel="noopener">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                Buka Google Maps
                            </a>
                            <div class="qr-wrap">
                                <div class="qr-code">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=https://maps.app.goo.gl/XC6QnChqsYpn64JG8&color=1a1209&bgcolor=ffffff"
                                        alt="QR Maps" width="68" height="68">
                                </div>
                                <span class="qr-label">Scan QR</span>
                            </div>
                        </div>
                    </div>

                    <!-- RESEPSI -->
                    <div class="event-card reveal">
                        <div class="event-type">Syukuran</div>
                        <div class="event-title">Resepsi Pernikahan</div>
                        <div class="event-info">
                            <div class="event-info-row">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c9a96e"
                                    stroke-width="1.5">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                                Jum'at, 29 Mei 2026 · 15.00 WIB – Selesai
                            </div>
                            <div class="event-info-row">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#c9a96e"
                                    stroke-width="1.5">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                Kediaman Zaneta, Jl. Manyar Sabrangan No. 141, Surabaya
                            </div>
                        </div>
                        <div class="maps-block">
                            <a class="maps-btn" href="https://maps.app.goo.gl/XC6QnChqsYpn64JG8" target="_blank"
                                rel="noopener">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                Buka Google Maps
                            </a>
                            <div class="qr-wrap">
                                <div class="qr-code">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=https://maps.app.goo.gl/XC6QnChqsYpn64JG8&color=1a1209&bgcolor=ffffff"
                                        alt="QR Maps" width="68" height="68">
                                </div>
                                <span class="qr-label">Scan QR</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RSVP -->
        @if($guest)
            <section class="section-dark" id="section-rsvp">
                <div class="container">
                    <div class="reveal">
                        <div class="section-tag" style="color:var(--gold)">Konfirmasi</div>
                        <div class="section-title light">Kehadiran Anda</div>
                    </div>
                    <div class="rsvp-form reveal">
                        @if(!$guest->is_confirmed)
                            <div id="rsvp-form-wrap">
                                <div class="form-group">
                                    <label class="form-label">Nama Tamu</label>
                                    <div
                                        style="padding:14px 0;color:var(--cream);font-family:'Cormorant Garamond',serif;font-size:20px;border-bottom:1px solid rgba(201,169,110,0.3);">
                                        {{ $guest->name }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Kehadiran</label>
                                    <div class="radio-group">
                                        <label class="radio-label">
                                            <input type="radio" name="is_confirmed" value="1" checked>
                                            <span class="radio-custom"></span>
                                            Hadir 🎉
                                        </label>
                                        <label class="radio-label">
                                            <input type="radio" name="is_confirmed" value="0">
                                            <span class="radio-custom"></span>
                                            Tidak Hadir
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="count-group">
                                    <label class="form-label">Jumlah Tamu</label>
                                    <select class="form-control" id="guest_count">
                                        <option value="1">1 orang</option>
                                        <option value="2">2 orang</option>
                                        <option value="3">3 orang</option>
                                        <option value="4">4 orang</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ucapan &amp; Doa</label>
                                    <textarea class="form-control" id="message" rows="3" style="resize:none"
                                        placeholder="Tulis ucapan untuk kedua mempelai..."></textarea>
                                </div>
                                <button class="submit-btn" id="rsvp-btn" onclick="submitRsvp()">
                                    Kirim Konfirmasi
                                </button>
                            </div>
                            <div class="rsvp-success" id="rsvp-success">
                                <div class="check">✦</div>
                                <h3>Terima Kasih!</h3>
                                <p>Konfirmasi kehadiran Anda telah kami terima. Kami sangat menantikan kehadiran Anda!</p>
                            </div>
                        @else
                            <div class="rsvp-success" style="display:block;">
                                <div class="check">✦</div>
                                <h3>Sudah Dikonfirmasi</h3>
                                <p>Terima kasih, {{ $guest->name }}! Anda telah mengkonfirmasi kehadiran. Kami menantikan Anda!
                                    🎉</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            <div id="autoscroll-stop"></div>
        @endif

        <!-- THANK YOU -->
        <section class="thankyou-section" id="section-thankyou">
            <div class="container" style="position:relative">
                <div class="reveal">
                    <svg class="thankyou-ornament" width="80" height="80" viewBox="0 0 120 120" fill="none">
                        <circle cx="60" cy="60" r="55" stroke="#c9a96e" stroke-width="0.5" opacity="0.4" />
                        <circle cx="60" cy="60" r="38" stroke="#c9a96e" stroke-width="0.5" opacity="0.25" />
                        <path d="M60 20 L64 50 L60 55 L56 50 Z" fill="#c9a96e" opacity="0.5" />
                        <path d="M60 100 L64 70 L60 65 L56 70 Z" fill="#c9a96e" opacity="0.5" />
                        <path d="M20 60 L50 64 L55 60 L50 56 Z" fill="#c9a96e" opacity="0.5" />
                        <path d="M100 60 L70 64 L65 60 L70 56 Z" fill="#c9a96e" opacity="0.5" />
                        <circle cx="60" cy="60" r="6" fill="none" stroke="#c9a96e" stroke-width="0.8" />
                        <circle cx="60" cy="60" r="2.5" fill="#c9a96e" />
                    </svg>

                    <div class="section-tag" style="color:var(--gold)">Terima Kasih</div>
                    <div class="thankyou-title">Jazakumullahu Khairan</div>

                    <p class="thankyou-text">
                        Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan
                        hadir untuk memberikan doa restu kepada kami. Kehadiran Anda adalah hadiah terbesar
                        yang tidak ternilai bagi kami berdua dan keluarga.
                    </p>

                    <p class="thankyou-text" style="margin-bottom:0">
                        Kami memohon maaf apabila terdapat kekurangan dalam penyampaian undangan ini.
                        Semoga Allah SWT senantiasa memberikan keberkahan kepada kita semua. Aamiin.
                    </p>

                    <div style="margin-top:40px;">
                        <p
                            style="font-family:'Cormorant Garamond',serif;font-size:13px;color:rgba(250,246,239,0.4);letter-spacing:3px;text-transform:uppercase;margin-bottom:8px;">
                            Hormat Kami</p>
                        <p
                            style="font-family:'Cormorant Garamond',serif;font-size:32px;font-weight:300;font-style:italic;color:var(--gold);">
                            Nauval &amp; Zaneta
                        </p>
                        <p style="font-size:12px;color:rgba(250,246,239,0.3);letter-spacing:2px;margin-top:8px;">Beserta
                            Keluarga</p>
                    </div>
                </div>

                <div class="madeby reveal">
                    <div style="margin-bottom:8px;">﷽ &nbsp; بَارَكَ اللهُ لَكُمَا &nbsp; ﷽</div>
                    Made with ❤ by <a href="#">Nauval</a>
                </div>
            </div>
        </section>

    </div>

    <!-- MUSIC TOGGLE -->
    <button class="music-toggle" id="musicToggle" onclick="toggleMusic()" title="Putar musik">♪</button>

    {{-- Expose PHP values to JS via window variables --}}
    <script>
        window.WEDDING_MUSIC_SRC = "{{ asset('music/wedding_echa_faris.mp3') }}";
        window.CSRF_TOKEN = "{{ csrf_token() }}";
        @if($guest)
            window.RSVP_ROUTE = "{{ route('invitation.rsvp', $guest->slug) }}";
        @else
            window.RSVP_ROUTE = "#";
        @endif
    </script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>