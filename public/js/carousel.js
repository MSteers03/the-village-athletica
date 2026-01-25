document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('athlete-carousel');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const indicators = document.querySelectorAll('.indicator');
    const originalItems = Array.from(carousel.children);
    let currentIndex = 0;
    let autoScrollInterval;
    let isTransitioning = false;

    // Clone items for infinite loop
    function setupInfiniteLoop() {
        // Clone all items and append to the end
        originalItems.forEach(item => {
            const clone = item.cloneNode(true);
            carousel.appendChild(clone);
        });
        
        // Clone all items and prepend to the beginning
        originalItems.slice().reverse().forEach(item => {
            const clone = item.cloneNode(true);
            carousel.insertBefore(clone, carousel.firstChild);
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
        
        if (smooth) {
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
        autoScrollInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoScroll() {
        clearInterval(autoScrollInterval);
        startAutoScroll();
    }

    // Initialize
    setupInfiniteLoop();
    startAutoScroll();

    // Pause on hover
    carousel.parentElement.addEventListener('mouseenter', () => {
        clearInterval(autoScrollInterval);
    });

    carousel.parentElement.addEventListener('mouseleave', () => {
        startAutoScroll();
    });
});