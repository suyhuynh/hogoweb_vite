import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '',
    plugins: [
        laravel({
            input: ['resources/assets/backend/scss/app.scss', 'resources/assets/backend/app.js'],
            refresh: true,
            publicDir: 'public/',
            optimizeDeps: {
                include: ['jQuery', '$'],
            },
        }),
    ],
});
