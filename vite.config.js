import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from '@rollup/plugin-inject';

export default defineConfig({
    // base: 'public',
    resolve: {
        mainFields: [],
    },
    plugins: [
        react(),
        inject({
            jQuery: "jquery",
            jquery: "jquery",
            "window.jQuery": "jquery",
            $: "jquery",
            "window.moment": "moment",
            moment: "moment",
        }),
        laravel({
            input: ['resources/assets/backend/scss/app.scss', 'resources/assets/backend/app.js'],
            detectTls: 'hogoweb_vite.local',
            refresh: true
        }),
    ],
    
});
