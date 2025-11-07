document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.pg-slider').forEach((slider) => {
        if (slider.classList.contains('pg-slider--static')) return;

        const track = slider.querySelector('.pg-slider__track');
        const slides = track ? Array.from(track.children) : [];
        const prevBtn = slider.querySelector('.pg-slider__nav--prev');
        const nextBtn = slider.querySelector('.pg-slider__nav--next');

        if (!track || slides.length === 0) return;

        const perDesktop = parseInt(slider.dataset.perDesktop || '3', 10);
        const perTablet = parseInt(slider.dataset.perTablet || '2', 10);
        const perMobile = parseInt(slider.dataset.perMobile || '1', 10);

        const getVisibleCount = () => {
            if (window.innerWidth <= 640) return Math.min(perMobile, slides.length);
            if (window.innerWidth <= 1024) return Math.min(perTablet, slides.length);
            return Math.min(perDesktop, slides.length);
        };

        const getCardWidth = () => slides[0]?.getBoundingClientRect().width ?? 0;
        const getGap = () => {
            const style = window.getComputedStyle(track);
            return parseFloat(style.columnGap || style.gap || 0);
        };

        let currentIndex = 0;

        const applyState = () => {
            const perView = getVisibleCount();
            const maxIndex = Math.max(slides.length - perView, 0);
            currentIndex = Math.min(currentIndex, maxIndex);

            const shift = currentIndex * (getCardWidth() + getGap());
            track.style.transform = `translateX(-${shift}px)`;

            if (prevBtn) {
                prevBtn.disabled = currentIndex === 0;
                prevBtn.setAttribute('aria-disabled', String(prevBtn.disabled));
            }
            if (nextBtn) {
                nextBtn.disabled = currentIndex >= maxIndex;
                nextBtn.setAttribute('aria-disabled', String(nextBtn.disabled));
            }
        };

        prevBtn?.addEventListener('click', () => {
            currentIndex = Math.max(currentIndex - getVisibleCount(), 0);
            applyState();
        });

        nextBtn?.addEventListener('click', () => {
            const perView = getVisibleCount();
            currentIndex = Math.min(currentIndex + perView, Math.max(slides.length - perView, 0));
            applyState();
        });

        window.addEventListener('resize', debounce(() => {
            track.style.transition = 'none';
            applyState();
            requestAnimationFrame(() => { track.style.transition = ''; });
        }, 150), { passive: true });

        applyState();
    });
});

function debounce(fn, delay) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn.apply(null, args), delay);
    };
}