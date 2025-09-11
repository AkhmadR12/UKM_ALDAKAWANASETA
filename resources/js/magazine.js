import $ from 'jquery';
import 'turn.js';

export function initFlipbook(selector, pages) {
    $(selector).turn({
        width: 800,
        height: 600,
        autoCenter: true,
        display: 'double',
        acceleration: true,
        pages: pages,
        when: {
            turning: function(e, page) {
                // Lazy load images
                $(this).turn('addPage', $('<div>').html(
                    `<img src="${$(this).data('page-'+page)}" class="img-fluid">`
                ), page);
            }
        }
    });
}