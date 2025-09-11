// resources/js/flipbook.js
import './jquery.js';
import './turn.js';

// Pastikan jQuery tersedia global
window.$ = window.jQuery = $;

export function initFlipbook(selector = '#flipbook', options = {}) {
    const flipbookElement = $(selector);
    
    if (flipbookElement.length === 0) {
        console.warn(`Element ${selector} tidak ditemukan`);
        return false;
    }

    if (typeof $.fn.turn === 'undefined') {
        console.error('Turn.js belum dimuat');
        return false;
    }

    const defaultOptions = {
        width: 800,
        height: 600,
        autoCenter: true,
        gradients: true,
        elevation: 50,
        pages: flipbookElement.find('.page').length || 2
    };

    const finalOptions = { ...defaultOptions, ...options };

    try {
        // Destroy existing instance if any
        if (flipbookElement.turn('is')) {
            flipbookElement.turn('destroy');
        }

        // Initialize flipbook
        flipbookElement.turn(finalOptions);
        
        console.log('Flipbook berhasil diinisialisasi');
        return true;
        
    } catch (error) {
        console.error('Error saat inisialisasi flipbook:', error);
        return false;
    }
}

export function destroyFlipbook(selector = '#flipbook') {
    const flipbookElement = $(selector);
    if (flipbookElement.length > 0 && flipbookElement.turn('is')) {
        flipbookElement.turn('destroy');
        console.log('Flipbook destroyed');
        return true;
    }
    return false;
}

// Auto-init jika element ada
$(document).ready(function() {
    setTimeout(function() {
        if ($('#flipbook').length > 0) {
            initFlipbook();
        }
    }, 100);
});