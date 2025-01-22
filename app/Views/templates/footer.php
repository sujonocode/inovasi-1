</div>
<!-- Footer -->
<footer>
    <div class="container">
        <p style="margin: 0px;">&copy; 2025. Made with
            <i class="fa-solid fa-heart" style="background: linear-gradient(to right, #6a11cb, #2575fc); 
            font-size: 1.2rem;
            -webkit-background-clip: text; 
            -moz-background-clip: text; 
            -o-background-clip: text;
            background-clip: text; 
            color: transparent;"></i>
            by Tim TI BPS Kabupaten Tanggamus
        </p>
    </div>
</footer>

<script>
    // Ensure click toggles dropdowns on all devices
    document.addEventListener('DOMContentLoaded', () => {
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent event bubbling
                const menu = this.querySelector('.dropdown-menu');
                const isVisible = menu.classList.contains('show');

                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));

                // Toggle the current dropdown menu
                if (!isVisible) {
                    menu.classList.add('show');
                } else {
                    menu.classList.remove('show');
                }
            });
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll(".nav-link");

        // Get the current pathname (without query parameters or fragments)
        const currentPath = window.location.pathname.replace(/\/$/, ""); // Remove trailing slash if present

        navLinks.forEach(link => {
            // Get the href path, using new URL to ensure we get the correct path even with base_url() prefix
            const linkPath = new URL(link.href).pathname.replace(/\/$/, "");

            // If the current page is the same as the link's path, mark the link as active
            if (currentPath === linkPath || (currentPath === "/" && linkPath === "")) {
                link.classList.add("active"); // Mark this link as active
            } else {
                link.classList.remove("active"); // Remove the active class if it doesn't match
            }

            // For dropdown links, check if any of their child links match the current path
            if (link.classList.contains("dropdown-toggle")) {
                const dropdownItems = link.closest("li").querySelectorAll(".dropdown-item");
                dropdownItems.forEach(item => {
                    const itemPath = new URL(item.href).pathname.replace(/\/$/, "");
                    if (currentPath === itemPath) {
                        link.classList.add("active"); // Add active class to the parent dropdown if any child is active
                        item.classList.add("active"); // Mark the child link as active
                    } else {
                        item.classList.remove("active");
                    }
                });
            }

            // Special case for Profile and Admin Dashboard links under the user dropdown
            // Ensure both profile and admin_dashboard links get the active class
            if (currentPath === 'http://localhost:8080/profile' && link.href.includes('profile')) {
                link.classList.add('active');
            }

            if (currentPath === 'http://localhost:8080/profile' && link.href.includes('admin_dashboard')) {
                link.classList.add('active');
            }
        });
    });
</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

</body>

</html>