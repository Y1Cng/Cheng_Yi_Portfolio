export function initAnimations() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    }

    if (document.querySelector('header')) {
        gsap.from('header', {
            y: -50,
            opacity: 0,
            duration: 0.8,
            ease: 'power2.out',
            clearProps: "all"
        });
    }

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

    if (document.querySelector('#contactForm')) {
        gsap.from('#contactForm', {
            opacity: 0,
            y: 20,
            duration: 0.8,
            ease: 'power2.out'
        });
    }
}