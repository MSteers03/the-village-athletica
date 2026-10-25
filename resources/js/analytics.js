import { onCLS, onFCP, onINP, onLCP, onTTFB } from 'web-vitals';

// Umami's tracker is loaded async by partials/umami.blade.php. Events raised before it
// has loaded are queued and sent once it's ready. With no tracker configured, nothing is sent.
const script = document.getElementById('umami-script');
const queue = [];

export function track(name, data) {
    if (!script) return;
    if (window.umami) {
        window.umami.track(name, data);
    } else {
        queue.push([name, data]);
    }
}

// Inline Alpine handlers in the Blade views call this.
window.trackEvent = track;

if (script) {
    script.addEventListener('load', () => {
        queue.splice(0).forEach(([name, data]) => window.umami?.track(name, data));
    });

    // Speed Insights replacement: one event per Core Web Vital. CLS is unitless, the rest are ms.
    const reportVital = ({ name, value, rating, navigationType }) => {
        track('web-vitals', {
            metric: name,
            value: name === 'CLS' ? Math.round(value * 1000) / 1000 : Math.round(value),
            rating,
            navigation: navigationType,
        });
    };
    onCLS(reportVital);
    onFCP(reportVital);
    onINP(reportVital);
    onLCP(reportVital);
    onTTFB(reportVital);

    // Menu use, phone, email and links off the site. Links with their own data-umami-event are left to Umami.
    document.addEventListener('click', (event) => {
        const link = event.target.closest?.('a[href]');
        if (!link || link.closest('[data-umami-event]')) return;

        const label = link.textContent.trim().replace(/\s+/g, ' ').slice(0, 100) || link.getAttribute('aria-label') || '';
        const menu = link.closest('nav[aria-label]');
        if (menu) {
            track('nav-click', { menu: menu.getAttribute('aria-label'), to: link.pathname, from: window.location.pathname });
        } else if (link.protocol === 'tel:') {
            track('phone-click', { label });
        } else if (link.protocol === 'mailto:') {
            track('email-click', { label });
        } else if (link.host && link.host !== window.location.host) {
            track('outbound-link', { url: link.href, host: link.hostname, label });
        }
    });

    // How far down each page visitors get, once per threshold per page view.
    const thresholds = [25, 50, 75, 100];
    let reached = 0;
    let ticking = false;
    const checkScroll = () => {
        ticking = false;
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const percent = scrollable <= 0 ? 100 : ((window.scrollY + 1) / scrollable) * 100;
        while (reached < thresholds.length && percent >= thresholds[reached]) {
            track('scroll-depth', { percent: thresholds[reached] });
            reached++;
        }
        if (reached === thresholds.length) window.removeEventListener('scroll', onScroll);
    };
    const onScroll = () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(checkScroll);
        }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
}
