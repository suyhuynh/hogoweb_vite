import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vitePluginRequire from "vite-plugin-require";
import inject from '@rollup/plugin-inject';

export default defineConfig({
    // base: 'public',
    resolve: {
        mainFields: [],
    },
    plugins: [
        // inject({
        //     jQuery: "jquery",
        //     jquery: "jquery",
        //     "window.jQuery": "jquery",
        //     $: "jquery",
        //     "window.moment": "moment",
        //     moment: "moment"
        // }),
        vitePluginRequire.default(),
        laravel({
            input: ['resources/assets/backend/scss/app.scss', 'resources/assets/backend/app.js'],
            detectTls: 'hogoweb_vite.local',
            refresh: true
        }),
    ],
    
});
