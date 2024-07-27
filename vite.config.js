// import { defineConfig } from 'vite';
// import vue from '@vitejs/plugin-vue';
// import path from 'path';

// export default defineConfig({
//   plugins: [vue()],
//   resolve: {
//     alias: {
//       '@': path.resolve(__dirname, 'resources/js'),
//     },
//   },
//   server: {
//     proxy: {
//       '/api': 'http://localhost:8000',
//     },
//   },
//   build: {
//     outDir: 'public/build',
//     rollupOptions: {
//       input: 'resources/js/app.js',
//     },
//   },
// });


import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});

