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

