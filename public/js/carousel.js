document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('athlete-carousel');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const pauseBtn = document.getElementById('pause-btn');
    const indicators = document.querySelectorAll('.indicator');
    if (!carousel || !prevBtn || !nextBtn) return;
    const originalItems = Array.from(carousel.children);
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    let currentIndex = 0;
    let autoScrollInterval;
    let isTransitioning = false;
    // Visitors who prefer reduced motion start paused; anyone can pause or resume with the button.
    let userPaused = reducedMotion.matches;

    // Clones only exist for the visual loop, so hide them from screen readers.
    function makeClone(item) {
        const clone = item.cloneNode(true);
        clone.setAttribute('aria-hidden', 'true');
        clone.querySelectorAll('img').forEach(img => img.setAttribute('alt', ''));
        return clone;
    }

    // Clone items for infinite loop
    function setupInfiniteLoop() {
        // Clone all items and append to the end
        originalItems.forEach(item => {
            carousel.appendChild(makeClone(item));
        });
        
        // Clone all items and prepend to the beginning
        originalItems.slice().reverse().forEach(item => {
            carousel.insertBefore(makeClone(item), carousel.firstChild);
        });
        
        // Start at the "real" first item (after prepended clones)
        currentIndex = originalItems.length;
        carousel.style.transform = `translateX(-${currentIndex * getItemWidth()}px)`;
        carousel.style.transition = 'none';
    }

    function getItemWidth() {
        return carousel.children[0].offsetWidth + 24; // width + gap
    }

    function updateIndicators(index) {
        // Map actual index to original items (0-4)
        const mappedIndex = index % originalItems.length;
        
        indicators.forEach((indicator, i) => {
            if (i === mappedIndex) {
                indicator.classList.remove('bg-gray-400');
                indicator.classList.add('bg-gray-800');
            } else {
                indicator.classList.remove('bg-gray-800');
                indicator.classList.add('bg-gray-400');
            }
        });
    }

    function scrollToIndex(index, smooth = true) {
        if (isTransitioning) return;
        
        isTransitioning = true;
        const itemWidth = getItemWidth();
        
        if (smooth && !reducedMotion.matches) {
            carousel.style.transition = 'transform 700ms ease-in-out';
        } else {
            carousel.style.transition = 'none';
        }
        
        carousel.style.transform = `translateX(-${index * itemWidth}px)`;
        currentIndex = index;
        
        updateIndicators(index);
        
        setTimeout(() => {
            isTransitioning = false;
        }, 700);
    }

    function handleInfiniteLoop() {
        const totalItems = carousel.children.length;
        const originalLength = originalItems.length;
        
        // If we're at or past the end clones, jump to real items
        if (currentIndex >= originalLength * 2) {
            currentIndex = originalLength;
            scrollToIndex(currentIndex, false);
        }
        
        // If we're at or before the start clones, jump to real items
        if (currentIndex < originalLength) {
            currentIndex = originalLength * 2 - 1;
            scrollToIndex(currentIndex, false);
        }
    }

    function nextSlide() {
        scrollToIndex(currentIndex + 1);
        setTimeout(handleInfiniteLoop, 750);
    }

    function prevSlide() {
        scrollToIndex(currentIndex - 1);
        setTimeout(handleInfiniteLoop, 750);
    }

    // Button controls
    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetAutoScroll();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetAutoScroll();
    });

    // Indicator controls
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            scrollToIndex(originalItems.length + index);
            resetAutoScroll();
        });
    });

    // Auto-scroll functionality
    function startAutoScroll() {
        clearInterval(autoScrollInterval);
        // No auto-advance for visitors who prefer reduced motion, or while the page is hidden.
        if (userPaused || document.hidden) return;
        autoScrollInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoScroll() {
        clearInterval(autoScrollInterval);
        startAutoScroll();
    }

    function updatePauseButton() {
        if (!pauseBtn) return;
        pauseBtn.setAttribute('aria-label', userPaused ? 'Play carousel' : 'Pause carousel');
        pauseBtn.querySelector('[data-icon="pause"]').classList.toggle('hidden', userPaused);
        pauseBtn.querySelector('[data-icon="play"]').classList.toggle('hidden', !userPaused);
    }

    if (pauseBtn) {
        pauseBtn.addEventListener('click', () => {
            userPaused = !userPaused;
            updatePauseButton();
            if (userPaused) {
                clearInterval(autoScrollInterval);
            }
            // When resuming, auto-advance restarts as soon as focus/hover leaves the carousel
        });
    }

    // Initialize
    updatePauseButton();
    setupInfiniteLoop();
    startAutoScroll();

    // Pause on hover
    carousel.parentElement.addEventListener('mouseenter', () => {
        clearInterval(autoScrollInterval);
    });

    carousel.parentElement.addEventListener('mouseleave', () => {
        startAutoScroll();
    });

    // Pause while a keyboard user is on the carousel controls
    carousel.parentElement.addEventListener('focusin', () => {
        clearInterval(autoScrollInterval);
    });

    carousel.parentElement.addEventListener('focusout', (event) => {
        if (!carousel.parentElement.contains(event.relatedTarget)) {
            startAutoScroll();
        }
    });

    // Stop rotating in background tabs
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            clearInterval(autoScrollInterval);
        } else {
            startAutoScroll();
        }
    });

    // Keep the current slide aligned when the viewport (and card width) changes
    let resizeFrame;
    window.addEventListener('resize', () => {
        cancelAnimationFrame(resizeFrame);
        resizeFrame = requestAnimationFrame(() => {
            carousel.style.transition = 'none';
            carousel.style.transform = `translateX(-${currentIndex * getItemWidth()}px)`;
        });
    });
});