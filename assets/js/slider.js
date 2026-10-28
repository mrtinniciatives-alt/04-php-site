(() => {
    const slider = document.querySelector('[data-slider]');
    if (!slider) return;

    const slides = Array.from(slider.querySelectorAll('[data-slide]'));
    const dots = Array.from(slider.querySelectorAll('[data-slide-dot]'));
    const previous = slider.querySelector('[data-slider-prev]');
    const next = slider.querySelector('[data-slider-next]');
    let current = 0;
    let timer;

    function show(index) {
        current = (index + slides.length) % slides.length;
        slides.forEach((slide, position) => {
            slide.classList.toggle('is-active', position === current);
            slide.setAttribute('aria-hidden', position === current ? 'false' : 'true');
        });
        dots.forEach((dot, position) => {
            dot.classList.toggle('is-active', position === current);
            dot.setAttribute('aria-current', position === current ? 'true' : 'false');
        });
    }

    function restart() {
        window.clearInterval(timer);
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            timer = window.setInterval(() => show(current + 1), 6000);
        }
    }

    previous?.addEventListener('click', () => { show(current - 1); restart(); });
    next?.addEventListener('click', () => { show(current + 1); restart(); });
    dots.forEach((dot, index) => dot.addEventListener('click', () => { show(index); restart(); }));

    slider.addEventListener('mouseenter', () => window.clearInterval(timer));
    slider.addEventListener('mouseleave', restart);
    show(0);
    restart();
})();
