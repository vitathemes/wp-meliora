if (document.querySelectorAll(".js-categories-list").length) {
    var initIndex = 0;
     document.querySelectorAll('.js-categories-list li').forEach(function(item, index) {
        if (item.classList.contains('current-cat')) {
            initIndex = index;
        }
    });
    console.log(initIndex);
    var categoriesCarousel = new Flickity( '.js-categories-list', {
        initialIndex: initIndex,
        freeScroll: true,
        contain: true,
        pageDots: false,
        groupCells: false,
        cellAlign: 'left'
    });
}

