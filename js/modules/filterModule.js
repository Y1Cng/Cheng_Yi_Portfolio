// js/modules/filterModule.js (ES6 Module)
export function initFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    // Return if no elements found
    if (!filterBtns.length || !portfolioItems.length) return;

    // Set active button style
    function setActiveBtn(activeBtn) {
        filterBtns.forEach(btn => {
            btn.classList.remove('active');
            btn.style.backgroundColor = '';  // Reset to default
            btn.style.color = '';  // Reset text color
        });
        activeBtn.classList.add('active');
        activeBtn.style.backgroundColor = '#FF8A7A';  // Deep orange
        activeBtn.style.color = '#FFFFFF';  // White text
    }

    // Filter projects by category
    function filterProjects(category) {
        console.log('Filtering for:', category);
        portfolioItems.forEach(item => {
            const itemCategory = item.dataset.category;
            console.log('Item category:', itemCategory);
            if (category === 'all' || itemCategory === category) {
                item.style.display = 'block';
                item.style.opacity = '1';
                // Animate visible items
                gsap.from(item, {
                    opacity: 0,
                    y: 10,
                    duration: 0.3
                });
            } else {
                item.style.display = 'none';
                item.style.opacity = '0';
            }
        });
    }

    // Add click event to filter buttons
    filterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const category = e.target.dataset.filter;
            setActiveBtn(e.target);
            filterProjects(category);
        });
    });

    // Initialize with all projects
    setActiveBtn(filterBtns[0]);
    filterProjects('all');
}