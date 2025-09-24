import './bootstrap';
import { injectSpeedInsights } from '@vercel/speed-insights';
import { inject } from '@vercel/analytics';

// Only inject in production
if (import.meta.env.PROD) {
    injectSpeedInsights();
    inject();
}