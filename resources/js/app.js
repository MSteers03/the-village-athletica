import './bootstrap';
import { injectSpeedInsights } from '@vercel/speed-insights';

// Only inject in production
if (import.meta.env.PROD) {
    injectSpeedInsights();
}