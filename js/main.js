if (document.querySelectorAll(".js-categories-list").length) {
    let wp_meliora_initIndex = 0;
     document.querySelectorAll('.js-categories-list li').forEach(function(item, index) {
        if (item.classList.contains('current-cat')) {
            wp_meliora_initIndex = index;
        }
    });

     const wp_meliora_rtlAttr = document.querySelector('.js-categories-list').getAttribute('data-rtl');
     let wp_meliora_cellsAligment = 'left';
     if (parseInt(wp_meliora_rtlAttr)) {
         wp_meliora_cellsAligment = 'right';
     }

     const wp_meliora_categoriesCarouselOptions = {
         initialIndex: wp_meliora_initIndex,
         freeScroll: true,
         contain: true,
         pageDots: false,
         groupCells: false,
         cellAlign: wp_meliora_cellsAligment,
         rightToLeft: parseInt(wp_meliora_rtlAttr)
     };

    const categoriesCarousel = new Flickity( '.js-categories-list', wp_meliora_categoriesCarouselOptions);
}

var wp_meliora_menuToggle = document.querySelector('.js-menu-toggle');
var wp_meliora_menu = document.querySelector('.js-primary-menu');
var wp_meliora_menuLinks = wp_meliora_menu.getElementsByTagName('a');
var wp_meliora_menuListItems = wp_meliora_menu.querySelectorAll('li');

var wp_meliora_focus, wp_meliora_isToggleItem, wp_meliora_isBackward;
var wp_meliora_lastIndex = wp_meliora_menuListItems.length - 1;
var wp_meliora_lastParentIndex = document.querySelectorAll('.c-header__navigation > ul > li').length - 1;
document.addEventListener('focusin', function () {
    wp_meliora_focus = document.activeElement;
    if (wp_meliora_isToggleItem && wp_meliora_focus !== wp_meliora_menuLinks[0]) {
        document.querySelectorAll('.c-header__navigation > ul > li')[wp_meliora_lastParentIndex].querySelector('a').wp_meliora_focus();
    }

    if (wp_meliora_focus === wp_meliora_menuToggle) {
        wp_meliora_isToggleItem = true;
    } else {
        wp_meliora_isToggleItem = false;
    }
}, true);

document.addEventListener('keydown', function (e) {
    if (e.shiftKey && e.keyCode == 9) {
        wp_meliora_isBackward = true;
    } else {
        wp_meliora_isBackward = false;
    }
});

for (el of wp_meliora_menuLinks) {
    el.addEventListener('blur', function (e) {
        if (!wp_meliora_isBackward) {
            if (e.target === wp_meliora_menuLinks[wp_meliora_lastIndex]) {
                wp_meliora_menuToggle.focus();
            }
        }
    });
}

wp_meliora_menuToggle.addEventListener('blur', function (e) {
    if (wp_meliora_isBackward) {
        wp_meliora_menuLinks[wp_meliora_lastIndex].focus();
    }
});
