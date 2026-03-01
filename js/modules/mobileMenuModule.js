// js/modules/mobileMenuModule.js (ES6 Module)
export function initMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    // Return if elements don't exist
    if (!mobileMenuBtn || !mobileMenu || !closeMobileMenu) return;

    // Open mobile menu
    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.style.display = 'block';
        // Add overlay style
        mobileMenu.style.position = 'fixed';
        mobileMenu.style.top = '0';
        mobileMenu.style.left = '0';
        mobileMenu.style.width = '100%';
        mobileMenu.style.height = '100%';
        mobileMenu.style.backgroundColor = '#F8F8F8';
        mobileMenu.style.zIndex = '9999';
    });

    // Close mobile menu
    closeMobileMenu.addEventListener('click', () => {
        mobileMenu.style.display = 'none';
    });

    // Close menu when clicking links (optional)
    const mobileLinks = mobileMenu.querySelectorAll('.nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.style.display = 'none';
        });
    });
}