// js/main.js (ES6 Module Entry)
// Import sub-modules
import { initContactForm } from './modules/formModule.js';
import { initMobileMenu } from './modules/mobileMenuModule.js';
import { initAnimations } from './modules/animationModule.js';
import { initFilter } from './modules/filterModule.js';

// Initialize all functions after DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize AJAX contact form
    if (document.getElementById('contactForm')) {
        initContactForm();
    }
    // Initialize mobile menu (global)
    initMobileMenu();
    // Initialize GSAP animations (global)
    initAnimations();
    // Initialize portfolio filter (only on index.php)
    if (document.querySelector('.portfolio')) {
        initFilter();
    }
});