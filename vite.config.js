import { defineConfig } from 'vite';
import path from 'path'; // Tambahkan ini
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    resolve: {
        alias: {
            'ziggy-js': path.resolve(__dirname, 'vendor/tightenco/ziggy'), // Pastikan __dirname digunakan
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    
    build: {
        manifest: true, // Pastikan manifest.json dihasilkan
        outDir: 'public/build', // Direktori output build
    },
});
