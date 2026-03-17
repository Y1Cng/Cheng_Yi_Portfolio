export function initFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    if (!filterBtns.length || !portfolioItems.length) return;

    function setActiveBtn(activeBtn) {
        filterBtns.forEach(btn => {
            btn.classList.remove('active');
            btn.style.backgroundColor = '#FF6F61';
        });
        activeBtn.classList.add('active');
        activeBtn.style.backgroundColor = '#FF8A7A';
    }

    function filterProjects(category) {
        portfolioItems.forEach(item => {
            const itemCategory = item.dataset.category;
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
                item.style.opacity = '0.3';
            }
        });
    }

    function handleFilterClick(event) {
        const category = event.target.dataset.filter;
        setActiveBtn(event.target);
        filterProjects(category);
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', handleFilterClick);
    });

    setActiveBtn(filterBtns[0]);
    filterProjects('all');
}