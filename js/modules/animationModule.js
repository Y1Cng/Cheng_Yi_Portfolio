// js/modules/animationModule.js (ES6 Module)
export function initAnimations() {
    // Initialize GSAP ScrollTrigger
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    }

    // Header animation
    if (document.querySelector('header')) {
        gsap.from('header', {
            y: -50,
            opacity: 0,
            duration: 0.8,
            ease: 'power2.out'
        });
    }

    // Portfolio items animation (only on index.php)
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    if (portfolioItems.length && typeof ScrollTrigger !== 'undefined') {
        gsap.from('.portfolio-item', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            stagger: 0.2,
            scrollTrigger: {
                trigger: '.portfolio',
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        });
    }

    // Contact form animation (only on contact.php)
    if (document.getElementById('contactForm')) {
        gsap.from('#contactForm', {
            opacity: 0,
            y: 20,
            duration: 0.8,
            ease: 'power2.out'
        });
    }
}