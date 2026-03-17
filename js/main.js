import { initContactForm } from './modules/formModule.js';
import { initMobileMenu } from './modules/mobileMenuModule.js';
import { initAnimations } from './modules/animationModule.js';
import { initFilter } from './modules/filterModule.js';

const contactForm = document.querySelector('#contactForm');
if (contactForm) {
    initContactForm();
}

initMobileMenu();

initAnimations();

const portfolioSection = document.querySelector('.portfolio');
if (portfolioSection) {
    initFilter();
}