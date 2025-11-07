document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.pg-about-values-slider').forEach((slider) => {
    if (slider.classList.contains('pg-about-values-slider--static')) {
      return;
    }

    const track = slider.querySelector('.pg-about-values');
    const cards = track ? Array.from(track.children) : [];
    const prevBtn = slider.querySelector('.pg-about-values__nav--prev');
    const nextBtn = slider.querySelector('.pg-about-values__nav--next');

    if (!track || cards.length === 0) {
      return;
    }

    const getVisibleCount = () => {
      if (window.innerWidth <= 640) return 1;
      if (window.innerWidth <= 1024) return 2;
      return Math.min(3, cards.length);
    };

    const getCardWidth = () => (cards[0]?.getBoundingClientRect().width ?? 0);
    const getGap = () => {
      const style = window.getComputedStyle(track);
      return parseFloat(style.columnGap || style.gap || 0);
    };

    let currentIndex = 0;

    const applyState = () => {
      const perView = getVisibleCount();
      const maxIndex = Math.max(cards.length - perView, 0);
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
      currentIndex = Math.min(currentIndex + getVisibleCount(), cards.length - getVisibleCount());
      applyState();
    });

    const handleResize = () => {
      track.style.transition = 'none';
      applyState();
      requestAnimationFrame(() => {
        track.style.transition = '';
      });
    };

    window.addEventListener('resize', debounce(handleResize, 150), { passive: true });

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