if (document.querySelectorAll(".js-categories-list").length) {
    let initIndex = 0;
     document.querySelectorAll('.js-categories-list li').forEach(function(item, index) {
        if (item.classList.contains('current-cat')) {
            initIndex = index;
        }
    });

     const categoriesCarouselOptions = {
         initialIndex: initIndex,
         freeScroll: true,
         contain: true,
         pageDots: false,
         groupCells: false,
         cellAlign: 'left'
     };

    const categoriesCarousel = new Flickity( '.js-categories-list', categoriesCarouselOptions);
}

var menuToggle = document.querySelector('.js-menu-toggle');
var menu = document.querySelector('.js-primary-menu');
var menuLinks = menu.getElementsByTagName('a');
var menuListItems = menu.querySelectorAll('li');

var focus, isToggleItem, isBackward;
var lastIndex = menuListItems.length - 1;
var lastParentIndex = document.querySelectorAll('.c-header__navigation > ul > li').length - 1;
document.addEventListener('focusin', function () {
    focus = document.activeElement;
    if (isToggleItem && focus !== menuLinks[0]) {
        document.querySelectorAll('.c-header__navigation > ul > li')[lastParentIndex].querySelector('a').focus();
    }

    if (focus === menuToggle) {
        isToggleItem = true;
    } else {
        isToggleItem = false;
    }
}, true);

document.addEventListener('keydown', function (e) {
    if (e.shiftKey && e.keyCode == 9) {
        isBackward = true;
    } else {
        isBackward = false;
    }
});

for (el of menuLinks) {
    el.addEventListener('blur', function (e) {
        if (!isBackward) {
            if (e.target === menuLinks[lastIndex]) {
                menuToggle.focus();
            }
        }
    });
}
