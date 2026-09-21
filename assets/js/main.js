document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.getElementById('site-navigation');
    const closeMenu = () => {
        navigation?.classList.remove('toggled');
        menuToggle?.setAttribute('aria-expanded', 'false');
    };
    menuToggle?.addEventListener('click', () => {
        const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', String(!expanded));
        navigation.classList.toggle('toggled', !expanded);
    });
    navigation?.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
    window.matchMedia('(min-width: 768px)').addEventListener('change', closeMenu);

    const toggle = document.getElementById('search-toggle');
    const close = document.getElementById('search-close');
    const overlay = document.getElementById('header-search-overlay');
    let previousOverflow = '';
    const closeSearch = () => {
        if (!overlay || overlay.hidden) return;
        overlay.hidden = true;
        overlay.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = previousOverflow;
        toggle.focus();
    };
    toggle?.addEventListener('click', () => {
        closeMenu();
        previousOverflow = document.body.style.overflow;
        overlay.hidden = false;
        overlay.classList.add('active');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
        overlay.querySelector('input[type="search"]')?.focus();
    });
    close?.addEventListener('click', closeSearch);
    overlay?.addEventListener('click', event => { if (event.target === overlay) closeSearch(); });
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') { closeSearch(); closeMenu(); }
        if (event.key !== 'Tab' || !overlay || overlay.hidden) return;
        const focusable = Array.from(overlay.querySelectorAll('button, input:not([type="hidden"]), a[href]')).filter(el => !el.disabled && el.getClientRects().length);
        const first = focusable[0], last = focusable[focusable.length - 1];
        if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
        else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
    });
});
