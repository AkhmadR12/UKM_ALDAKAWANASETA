 
// import './bootstrap';
// import Alpine from 'alpinejs';

// window.Alpine = Alpine;
// Alpine.start();

// // Import jQuery terlebih dahulu
// import './jquery.js';

// // Pastikan jQuery sudah tersedia secara global
// window.$ = window.jQuery = $;

// // Kemudian import turn.js setelah jQuery siap
// import './turn.js';

// // Fungsi untuk inisialisasi flipbook
// function initFlipbook() {
     

//     // Pastikan turn.js sudah dimuat
//     if (typeof $.fn.turn === 'undefined') {
//         console.error('Turn.js belum dimuat');
//         return;
//     }

     
// }

// // Tunggu hingga DOM dan semua script siap
// $(document).ready(function() {
//     // Tambahkan delay kecil untuk memastikan semua script dimuat
//     setTimeout(function() {
//         initFlipbook();
//     }, 100);
// });

// // Backup: jika $(document).ready tidak bekerja
// window.addEventListener('DOMContentLoaded', function() {
//     setTimeout(function() {
//         if (typeof $ !== 'undefined' && typeof $.fn.turn !== 'undefined') {
//             initFlipbook();
//         }
//     }, 200);
// });

import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Import flipbook module (hanya akan aktif jika element ada)
import { initFlipbook, destroyFlipbook } from './flipbook.js';

// Export ke global untuk akses dari blade templates
window.initFlipbook = initFlipbook;
window.destroyFlipbook = destroyFlipbook;