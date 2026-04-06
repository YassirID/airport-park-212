import './bootstrap';

// ============================================
// SIDEBAR MOBILE TOGGLE
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggleBtn = document.getElementById('sidebar-toggle');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay?.classList.toggle('active');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar?.classList.add('-translate-x-full');
            overlay.classList.remove('active');
        });
    }

    // ============================================
    // FLASH MESSAGES AUTO-DISMISS
    // ============================================
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(msg => {
        setTimeout(() => {
            msg.style.transition = 'all 0.5s ease-out';
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-10px)';
            msg.style.maxHeight = '0';
            msg.style.padding = '0';
            msg.style.margin = '0';
            msg.style.borderWidth = '0';
            setTimeout(() => msg.remove(), 500);
        }, 4000);
    });

    // ============================================
    // STAGGERED ANIMATION ON CARDS
    // ============================================
    const animatedCards = document.querySelectorAll('.animate-stagger');
    animatedCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // ============================================
    // LIVE CLOCK IN HEADER
    // ============================================
    const clockEl = document.getElementById('live-clock');
    if (clockEl) {
        const updateClock = () => {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            clockEl.textContent = now.toLocaleDateString('id-ID', options);
        };
        updateClock();
        setInterval(updateClock, 1000);
    }

    // ============================================
    // BUTTON LOADING STATE
    // ============================================
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const btn = form.querySelector('button[type="submit"]');
            if (btn && !btn.dataset.noLoading) {
                btn.disabled = true;
                btn.style.opacity = '0.75';
                const originalContent = btn.innerHTML;
                btn.innerHTML = `<svg class="animate-spin-slow" style="width:1rem;height:1rem" fill="none" viewBox="0 0 24 24"><circle style="opacity:0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path style="opacity:0.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memproses...`;
                
                // Re-enable after 5s in case of error
                setTimeout(() => {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                    btn.innerHTML = originalContent;
                }, 5000);
            }
        });
    });

    // ============================================
    // SMOOTH FLASH MESSAGE DISMISS ON CLICK
    // ============================================
    document.querySelectorAll('.flash-dismiss-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const msg = btn.closest('.flash-message');
            if (msg) {
                msg.style.transition = 'all 0.3s ease-out';
                msg.style.opacity = '0';
                msg.style.transform = 'translateX(20px)';
                setTimeout(() => msg.remove(), 300);
            }
        });
    });
});
