import Alpine from 'alpinejs';
import { injectSpeedInsights } from '@vercel/speed-insights';
import { inject } from '@vercel/analytics';

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

// Only inject in production
if (import.meta.env.PROD) {
    injectSpeedInsights();
    inject();
}
