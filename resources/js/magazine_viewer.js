document.addEventListener("DOMContentLoaded", function () {
    
    const flipbook = $(".flipbook");

    if (flipbook.length) {
        flipbook.turn({
            width: 800,
            height: 600,
            autoCenter: true
        });

        // Kontrol tombol
        $("#next-page").click(() => flipbook.turn("next"));
        $("#prev-page").click(() => flipbook.turn("previous"));
        $("#first-page").click(() => flipbook.turn("page", 1));
        $("#last-page").click(() => flipbook.turn("page", flipbook.turn("pages")));

        // Indikator halaman
        flipbook.bind("turned", function (event, page) {
            $("#current-page").text(page);
        });

        // Fullscreen toggle
        $("#fullscreen-toggle").click(() => {
            const elem = flipbook[0];
            if (!document.fullscreenElement) {
                elem.requestFullscreen().catch(err => {
                    alert(`Error attempting to enable full-screen mode: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        });

        // Sembunyikan loader, tampilkan flipbook
        $(".loader").hide();
        $("#flipbook-viewer").show();
    } else {
        $(".loader").hide();
        $(".error-message").show();
    }
});
