import Alpine from 'alpinejs';
import './analytics';

// Respect the visitor's "reduce motion" setting: don't autoplay looping background videos.
if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('video[autoplay]').forEach((video) => {
        video.removeAttribute('autoplay');
        video.pause();
    });
}

// Bundled instead of loaded from a CDN: one fewer third-party request and a pinned version.
window.Alpine = Alpine;
Alpine.start();
