export function initMobileMenu() {
    const mobileMenuBtn = document.querySelector('#mobileMenuBtn');
    const mobileMenu = document.querySelector('#mobileMenu');
    const closeMobileMenu = document.querySelector('#closeMobileMenu');

    if (!mobileMenuBtn || !mobileMenu || !closeMobileMenu) {
        return;
    }

    if (mobileMenu.parentElement !== document.body) {
        document.body.appendChild(mobileMenu);
    }

    function openMobileMenu() {
        mobileMenu.style.display = 'block';
        mobileMenu.style.position = 'fixed';
        mobileMenu.style.top = '0';
        mobileMenu.style.left = '0';
        mobileMenu.style.width = '100vw';
        mobileMenu.style.height = '100vh';
        mobileMenu.style.backgroundColor = '#F8F8F8';
        mobileMenu.style.zIndex = '9999';
    }

    function closeMenu() {
        mobileMenu.style.display = 'none';
    }

    function handleLinkClick() {
        closeMenu();
    }

    mobileMenuBtn.addEventListener('click', openMobileMenu);
    closeMobileMenu.addEventListener('click', closeMenu);

    const mobileLinks = mobileMenu.querySelectorAll('.nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', handleLinkClick);
    });
}