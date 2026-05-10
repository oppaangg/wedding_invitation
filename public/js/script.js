function openInvitation() {
    document.getElementById("cover").classList.add("open");
    setTimeout(() => {
        document.getElementById("main").classList.add("visible");
        startPetals();
        startCountdown();
        autoPlayMusic();
        setTimeout(startAutoScroll, 1000);
    }, 600);
}

/* ===================== AUTO SCROLL ===================== */
let autoScrollInterval = null;
let userInteracting = false;
let lastTouchY = 0;
let touchMoved = false;

function startAutoScroll() {
    stopAutoScroll();
    autoScrollInterval = setInterval(() => {
        if (!userInteracting) {
            window.scrollBy({ top: 1.0, behavior: "instant" });
            if (
                window.innerHeight + window.scrollY >=
                document.body.offsetHeight - 10
            ) {
                stopAutoScroll();
            }
        }
    }, 20);
}

function stopAutoScroll() {
    clearInterval(autoScrollInterval);
    autoScrollInterval = null;
}

document.addEventListener("mousedown", () => {
    userInteracting = true;
});
document.addEventListener("mouseup", () => {
    userInteracting = false;
});

document.addEventListener(
    "touchstart",
    (e) => {
        lastTouchY = e.touches[0].clientY;
        touchMoved = false;
        userInteracting = true;
    },
    { passive: true },
);

document.addEventListener(
    "touchmove",
    (e) => {
        touchMoved = true;
        userInteracting = true;
    },
    { passive: true },
);

document.addEventListener(
    "touchend",
    (e) => {
        if (!touchMoved) {
            userInteracting = false;
        } else {
            setTimeout(() => {
                userInteracting = false;
            }, 1200);
        }
        touchMoved = false;
    },
    { passive: true },
);

/* ===================== PETALS ===================== */
function startPetals() {
    const container = document.getElementById("petals");
    const symbols = ["🌸", "🌺", "✿", "❀", "🌷", "🏵️"];
    for (let i = 0; i < 20; i++) {
        const p = document.createElement("div");
        p.className = "petal";
        p.textContent = symbols[Math.floor(Math.random() * symbols.length)];
        p.style.left = Math.random() * 100 + "%";
        p.style.fontSize = 10 + Math.random() * 12 + "px";
        p.style.animationDuration = 6 + Math.random() * 8 + "s";
        p.style.animationDelay = Math.random() * 8 + "s";
        container.appendChild(p);
    }
}

/* ===================== COUNTDOWN ===================== */
function startCountdown() {
    const target = new Date("2026-05-29T08:00:00");
    function update() {
        const now = new Date();
        const diff = target - now;
        if (diff <= 0) {
            document.getElementById("countdown").innerHTML =
                '<div style="color:var(--gold);font-family:Cormorant Garamond,serif;font-size:32px;font-style:italic;">Hari Bahagia Telah Tiba! 🎉</div>';
            return;
        }
        const d = Math.floor(diff / 86400000);
        const h = Math.floor((diff % 86400000) / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        document.getElementById("cd-days").textContent = String(d).padStart(
            2,
            "0",
        );
        document.getElementById("cd-hours").textContent = String(h).padStart(
            2,
            "0",
        );
        document.getElementById("cd-mins").textContent = String(m).padStart(
            2,
            "0",
        );
        document.getElementById("cd-secs").textContent = String(s).padStart(
            2,
            "0",
        );
    }
    update();
    setInterval(update, 1000);
}

/* ===================== SCROLL REVEAL ===================== */
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((e) => {
            if (!e.isIntersecting) return;

            const el = e.target;

            if (el.classList.contains("couple-groom")) {
                // Groom muncul duluan
                el.classList.add("in-view");

                // Sep muncul 1 detik setelah groom
                const sep = document.querySelector(".couple-sep");
                setTimeout(() => sep?.classList.add("in-view"), 1000);

                // Bride muncul 2.5 detik setelah sep (total 3.5 detik)
                const bride = document.querySelector(".couple-bride");
                setTimeout(() => bride?.classList.add("in-view"), 3500);

                observer.unobserve(el);
            } else if (
                el.classList.contains("couple-sep") ||
                el.classList.contains("couple-bride")
            ) {
                // Jangan langsung muncul — dikontrol dari groom trigger
                // Tapi tetap unobserve agar tidak double-trigger
                observer.unobserve(el);
            } else {
                el.classList.add("in-view");
            }
        });
    },
    { threshold: 0.15 },
);

document.querySelectorAll(".reveal").forEach((el) => observer.observe(el));

/* ===================== MUSIC ===================== */
let audio = null,
    playing = false;

function autoPlayMusic() {
    if (!audio) {
        audio = new Audio(window.WEDDING_MUSIC_SRC);
        audio.loop = true;
        audio.volume = 0.4;
    }
    audio
        .play()
        .then(() => {
            playing = true;
            document.getElementById("musicToggle").textContent = "♫";
            document.getElementById("musicToggle").classList.add("playing");
        })
        .catch(() => {
            document.addEventListener(
                "click",
                function startOnClick() {
                    audio.play();
                    playing = true;
                    document.getElementById("musicToggle").textContent = "♫";
                    document
                        .getElementById("musicToggle")
                        .classList.add("playing");
                    document.removeEventListener("click", startOnClick);
                },
                { once: true },
            );
        });
}

function toggleMusic() {
    if (!audio) {
        audio = new Audio(window.WEDDING_MUSIC_SRC);
        audio.loop = true;
        audio.volume = 0.4;
    }
    if (playing) {
        audio.pause();
        document.getElementById("musicToggle").textContent = "♪";
        document.getElementById("musicToggle").classList.remove("playing");
    } else {
        audio.play().catch(() => {});
        document.getElementById("musicToggle").textContent = "♫";
        document.getElementById("musicToggle").classList.add("playing");
    }
    playing = !playing;
}

/* ===================== RSVP ===================== */
function submitRsvp() {
    const btn = document.getElementById("rsvp-btn");
    const isConfirmed = document.querySelector(
        "input[name=is_confirmed]:checked",
    )?.value;
    const guestCount = document.getElementById("guest_count")?.value;
    const message = document.getElementById("message")?.value;

    btn.disabled = true;
    btn.textContent = "Mengirim...";

    fetch(window.RSVP_ROUTE, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": window.CSRF_TOKEN,
        },
        body: JSON.stringify({
            is_confirmed: isConfirmed,
            guest_count: guestCount,
            message,
        }),
    })
        .then((r) => r.json())
        .then(() => {
            document.getElementById("rsvp-form-wrap").style.display = "none";
            document.getElementById("rsvp-success").style.display = "block";
        })
        .catch(() => {
            btn.disabled = false;
            btn.textContent = "Coba Lagi";
        });
}

/* Toggle jumlah tamu berdasarkan pilihan hadir/tidak */
document.querySelectorAll("input[name=is_confirmed]").forEach((r) => {
    r.addEventListener("change", () => {
        const cg = document.getElementById("count-group");
        if (cg) cg.style.display = r.value === "1" ? "block" : "none";
    });
});

/* Stop auto-scroll ketika RSVP section terlihat */
const stopMarker = document.getElementById("autoscroll-stop");
if (stopMarker) {
    const stopObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    stopAutoScroll();
                    stopObserver.disconnect();
                }
            });
        },
        { threshold: 0.1 },
    );
    stopObserver.observe(stopMarker);
}
/* ===================== PAUSE MUSIC ON HIDDEN (MOBILE) ===================== */
document.addEventListener('visibilitychange', () => {
    if (!audio) return;
    if (document.hidden) {
        audio.pause();
        playing = false;
        document.getElementById('musicToggle').textContent = '♪';
        document.getElementById('musicToggle').classList.remove('playing');
    } else {
        // Kembali ke browser → resume otomatis
        audio.play().then(() => {
            playing = true;
            document.getElementById('musicToggle').textContent = '♫';
            document.getElementById('musicToggle').classList.add('playing');
        }).catch(() => {
            // Browser blokir autoplay → biarkan user tap manual
        });
    }
});