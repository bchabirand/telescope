import domReady from '@roots/sage/client/dom-ready';
import Swiper, { Navigation } from 'swiper';

/**
 * Application entrypoint
 */
domReady(async () => {

  // Nav mobile
  const header = document.querySelector('.header');
  const toggleNavElements = document.querySelectorAll('[data-toggle-nav]');

  if (toggleNavElements) {
    toggleNavElements.forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();
        header.classList.toggle('is-active');
        document.body.style.overflow = document.body.style.overflow === 'hidden' ? 'auto' : 'hidden';
      });
    });
  }

  // Swiper last news
  const lastNewsSwipers = document.querySelectorAll('.wp-block-last-news-swiper');

  if (lastNewsSwipers) {
    lastNewsSwipers.forEach((lastNewsSwiper) => {
      new Swiper(lastNewsSwiper, {
        modules: [Navigation],
        slidesPerView: 'auto',
        spaceBetween: 20,

        navigation: {
          nextEl: lastNewsSwiper.querySelector('.swiper-button-next'),
          prevEl: lastNewsSwiper.querySelector('.swiper-button-prev'),
        }
      });
    });
  }

});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
import.meta.webpackHot?.accept(console.error);
