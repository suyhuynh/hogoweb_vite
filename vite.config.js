import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from '@rollup/plugin-inject';

export default defineConfig({
    base: '',
    plugins: [
        inject({
            jQuery: "jquery",
            require: "require",
            "window.jQuery": "jquery",
            $: "jquery",
            "window.moment": "moment"
        }),
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
