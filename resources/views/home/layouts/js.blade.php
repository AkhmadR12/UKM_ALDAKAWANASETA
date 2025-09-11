<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoText = document.getElementById('logo-text');
        const navbar = document.querySelector('.navbar'); // Assuming your navbar has this class

        function updateNavbarTransparency() {
            if (window.scrollY > 50) {
                navbar.classList.add("sticky-top");
            } else {
                navbar.classList.remove("sticky-top");
            }
        }

        // Panggil saat awal load
        updateNavbarTransparency();
        // Panggil saat scroll
        window.addEventListener("scroll", updateNavbarTransparency);

        window.addEventListener('scroll', function() {
            // Get all sections
            const sections = document.querySelectorAll('section');

            // Get current scroll position
            const scrollPosition = window.scrollY + navbar.offsetHeight;

            // Check which section is currently in view
            let currentSection = null;
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop +
                    sectionHeight) {
                    currentSection = section;
                }
            });

            // If we're at the top (no section in view), set to default black
            if (!currentSection || window.scrollY < 50) {
                logoText.style.color = '#000000';
            } else {
                // Get background color of current section and set logo color to complement it
                const sectionBgColor = window.getComputedStyle(currentSection).backgroundColor;

                // You might need more complex logic here to ensure good contrast
                // Simple example: if background is dark, use light text and vice versa
                const rgb = sectionBgColor.match(/\d+/g);
                if (rgb) {
                    const brightness = (parseInt(rgb[0]) * 299 + parseInt(rgb[1]) * 587 + parseInt(rgb[
                        2]) * 114) / 1000;
                    logoText.style.color = brightness > 128 ? '#000000' : '#ffffff';
                }
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const logoText = document.getElementById('logo-text');
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section');
            const scrollPosition = window.scrollY + navbar.offsetHeight;

            // Default logo color (when at top)
            if (window.scrollY < 50) {
                logoText.className = 'text-dark';
                return;
            }

            // Check which section is in view
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop +
                    sectionHeight) {
                    // Get section background class and apply corresponding text color
                    if (section.classList.contains('bg-primary')) {
                        logoText.className = 'text-primary';
                    } else if (section.classList.contains('bg-secondary')) {
                        logoText.className = 'text-secondary';
                    } else if (section.classList.contains('bg-light')) {
                        logoText.className = 'text-dark';
                    } else if (section.classList.contains('bg-dark')) {
                        logoText.className = 'text-light';
                    } else {
                        logoText.className = 'text-dark'; // Default
                    }
                }
            });
        });
    });
</script>
