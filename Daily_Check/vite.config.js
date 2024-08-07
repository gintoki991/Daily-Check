import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/flatpickr.js',
            ],
            refresh: true,
        }),
    ],
    base: process.env.NODE_ENV === 'production' ? 'https://daily-check.click/' : '/', // ベースURLをHTTPSに設定
});
