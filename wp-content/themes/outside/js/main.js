document.addEventListener('DOMContentLoaded', function () {
    const announcementBar = document.querySelector('.announcement-bar');
    function closeAnnouncement() {
        announcementBar.style.display = 'none';
    }
    if (announcementBar) {
        document.querySelector('.announcement-bar .close-btn').addEventListener('click', closeAnnouncement, false);
    }

    // Mobile Navigation
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    const menu = document.querySelector('.mobile-menu .menu');

    hamburgerBtn.addEventListener('click', function () {
        hamburgerBtn.classList.toggle('cross');
        menu.classList.toggle('active');
    });

    document.querySelectorAll('.mobile-menu .menu .menu-item').forEach(menuItem => {
        menuItem.addEventListener('click', () => {
            const megaMenu = menuItem.querySelector('.mega-menu');

            if (menuItem.classList.contains('active') || menuItem.classList.contains('inactive')) {
                menuItem.classList.toggle('active');
                menuItem.classList.toggle('inactive');
            } else {
                menuItem.classList.add('active');
            }
            megaMenu.classList.toggle('active');
        });
    });

    const parentElement = document.querySelectorAll('.desk-nav .menu .menu-item');
    
    parentElement.forEach(deskmenuItem => {
        const megaMenu = deskmenuItem.querySelector('.mega-menu');
        deskmenuItem.addEventListener('mouseenter', function () {
            megaMenu.classList.add('hovered');
        });

        deskmenuItem.addEventListener('mouseleave', function () {
            megaMenu.classList.remove('hovered');
        });
    });

    const slides = document.querySelectorAll('.swiper-slide');
    const accordionItems = document.querySelectorAll('.accordion-item');
    const slideDuration = 5000;
    let swiperInstance;
    let userInteracted = false;

    function initializeSwiper() {
        swiperInstance = new Swiper('.swiper-container', {
            loop: true,
            slidesPerView: 1,
            autoplay: {
                delay: slideDuration,
                disableOnInteraction: false,
            },
            on: {
                slideChange: function () {
                    const currentIndex = this.realIndex;
                    activateAccordion(currentIndex);
                    updateProgressBar(currentIndex);
                },
            },
        });

        const prodSwiper = new Swiper('.desk-nav .products', {
            slidesPerView: 3,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    function isSwiperInitialized() {
        const swiperContainer = document.querySelector('.swiper-container');
        return swiperContainer && swiperContainer.swiper !== undefined;
    }

    function activateAccordion(index) {
        accordionItems.forEach((item, i) => {
            item.classList.toggle('active', i === index);
        });
    }

    function updateProgressBar(index) {
        const progressBar = accordionItems[index].querySelector('.progress-bar');
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.transition = `width ${slideDuration}ms linear`;
            progressBar.style.width = '100%';
        }, 50);
    }

    accordionItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            if (isSwiperInitialized()) {
                userInteracted = true;
                swiperInstance.slideToLoop(index);
                activateAccordion(index);
                updateProgressBar(index);
            } else {
                console.error('Swiper is not initialized.');
            }
        });
    });

    document.addEventListener('click', () => {
        userInteracted = true;
    });

    initializeSwiper();
    updateProgressBar(swiperInstance.realIndex);


    const tabs = document.querySelectorAll('.nav-link');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', (event) => {
                    event.preventDefault();
                    const target = document.querySelector(tab.getAttribute('data-bs-target'));

                    // Remove active class from all tabs and tab panes
                    tabs.forEach(t => t.classList.remove('active'));
                    tabPanes.forEach(tp => tp.classList.remove('active', 'show'));

                    // Add active class to the clicked tab and corresponding tab pane
                    tab.classList.add('active');
                    target.classList.add('active', 'show');
                });
            });


});