import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: 'public/',
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/assets/backend/app.js'],
            refresh: true,
            publicDir: 'public/'
        }),
    ],
});
