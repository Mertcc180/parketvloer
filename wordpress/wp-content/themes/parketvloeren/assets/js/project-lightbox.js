(function () {
    'use strict';
    // Wait for DOM
    document.addEventListener('DOMContentLoaded', function () {
        var lightbox = document.getElementById('pgLightbox');
        if (!lightbox) return;
        var imgEl = document.getElementById('pgLightboxImg');
        var counterEl = document.getElementById('pgLightboxCounter');
        var closeBtn = document.getElementById('pgLightboxClose');
        var prevBtn = document.getElementById('pgLightboxPrev');
        var nextBtn = document.getElementById('pgLightboxNext');
        var items = Array.prototype.slice.call(document.querySelectorAll('.pg-project__media--click'));
        if (!items.length) return;
        var current = 0;

        function openAt(index) {
            current = (index + items.length) % items.length;
            var src = items[current].getAttribute('data-src');
            imgEl.src = src;
            counterEl.textContent = (current + 1) + '/' + items.length;
            lightbox.classList.add('pg-lightbox--visible');
            lightbox.setAttribute('aria-hidden', 'false');
            document.documentElement.style.overflow = 'hidden';
            // focus for accessibility
            closeBtn.focus();
        }

        function closeLB() {
            lightbox.classList.remove('pg-lightbox--visible');
            lightbox.setAttribute('aria-hidden', 'true');
            document.documentElement.style.overflow = '';
            imgEl.src = '';
        }

        function prev() { openAt(current - 1); }
        function next() { openAt(current + 1); }

        items.forEach(function (it, idx) {
            it.addEventListener('click', function (e) {
                e.preventDefault();
                openAt(idx);
            });
            it.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openAt(idx); }
            });
        });

        closeBtn.addEventListener('click', function (e) { e.stopPropagation(); closeLB(); });
        prevBtn.addEventListener('click', function (e) { e.stopPropagation(); prev(); });
        nextBtn.addEventListener('click', function (e) { e.stopPropagation(); next(); });

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLB();
        });

        document.addEventListener('keydown', function (e) {
            if (!lightbox.classList.contains('pg-lightbox--visible')) return;
            if (e.key === 'ArrowLeft') { e.preventDefault(); prev(); }
            if (e.key === 'ArrowRight') { e.preventDefault(); next(); }
            if (e.key === 'Escape') { e.preventDefault(); closeLB(); }
        });
    });
})();
