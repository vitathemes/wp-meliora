/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
    const siteNavigation = document.getElementById('site-navigation');

    // Return early if the navigation don't exist.
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.getElementsByTagName('button')[0];

    // Return early if the button don't exist.
    if ('undefined' === typeof button) {
        return;
    }

    const menu = siteNavigation.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    if (!menu.classList.contains('nav-menu')) {
        button.classList.add('nav-menu');
    }

    // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
    button.addEventListener('click', function () {
        siteNavigation.classList.toggle('toggled');
        button.getElementsByTagName('span')[0].classList.toggle('dashicons-menu-alt');
        button.getElementsByTagName('span')[0].classList.toggle('dashicons-no-alt');
        document.getElementsByTagName('body')[0].classList.toggle('has-no-scrollbar');

        if (button.getAttribute('aria-expanded') === 'true') {
            button.setAttribute('aria-expanded', 'false');
        } else {
            button.setAttribute('aria-expanded', 'true');
        }
    });
}());
