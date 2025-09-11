import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "0.0.0.0",
        // host: '192.168.0.106', // ganti ini sesuai IP yang sedang aktif
        port: 5173,
        strictPort: true,
        hmr: {
            // host: '192.168.0.106', // Ganti dengan IP lokal Anda
            host: "0.0.0.0",
        },
        cors: {
            origin: "*", // Atau spesifikkan origin: 'http://192.168.0.103:8000'
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/style_majalah.css",
                "resources/js/jquery.js",
                "resources/js/turn.js",
                "resources/js/magazine_viewer.js",
            ],
            // refresh: true,
            refresh: false,
        }),
    ],
});
