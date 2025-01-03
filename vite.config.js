import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/nexaris.css', 'resources/css/datatable.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
