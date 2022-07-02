<nav class = 'full-vw flex-row flex-between'>
    <div class = 'logo'>H-CUBE</div>
    <div class = 'nav-links flex-row text-center'>
        <div class = 'nav-link' onclick = 'location.href = "home";'>Home</div>
        <div class = 'nav-link' onclick = 'location.href = "about";'>About</div>
        <div class = 'nav-link' onclick = 'location.href = "facilities";'>Facilities</div>
        <div class = 'nav-link' onclick = 'location.href = "login";'>Log In</div>
        <div class = 'nav-link' onclick = 'location.href = "signup";'>Sign Up</div>

        <div class = 'close-btn flex-center p-abs' onclick = 'deactivate(".nav-links")'>
            <i class = 'bi bi-x-lg'></i>
        </div>
    </div>
    <div class = 'menu-btn' onclick = 'activate(".nav-links")'>
        <i class = 'bi bi-grid-fill'></i>
    </div>
</nav>