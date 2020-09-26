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
         groupCells: true,
         cellAlign: 'left'
     };

     if (window.matchMedia("(max-width: 720px)")) {
         categoriesCarouselOptions.groupCells = false;
     }

    const categoriesCarousel = new Flickity( '.js-categories-list', categoriesCarouselOptions);
}

