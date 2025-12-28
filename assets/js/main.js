document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu
    const menuToggle = document.querySelector('.menu-toggle');
    const siteNavigation = document.querySelector('#site-navigation');

    if (menuToggle && siteNavigation) {
        menuToggle.addEventListener('click', function () {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            siteNavigation.classList.toggle('toggled');
        });
    }

    // Search Overlay
    const searchToggle = document.getElementById('search-toggle');
    const searchClose = document.getElementById('search-close');
    const searchOverlay = document.getElementById('header-search-overlay');

    if (searchToggle && searchOverlay) {
        searchToggle.addEventListener('click', function () {
            searchOverlay.classList.add('active');
            // Focus input
            const input = searchOverlay.querySelector('input[type="search"]');
            if (input) setTimeout(() => input.focus(), 100);
        });
    }

    if (searchClose && searchOverlay) {
        searchClose.addEventListener('click', function () {
            searchOverlay.classList.remove('active');
        });
    }
});
