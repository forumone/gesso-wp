import MobileMenu from './modules/_MobileMenu.es6';

const callback = function () {
  'use strict';

  // The styling for this mobile menu is located in source/_patterns/04-components/mobile-menu/_mobile-menu.scss.
  if (!document.body.classList.contains('mobile-menu-processed')) {
    const mobileMenu = new MobileMenu();
    mobileMenu.init();
    document.body.classList.add('mobile-menu-processed');
  }
};

if (
  document.readyState === 'complete' ||
  (document.readyState !== 'loading' && !document.documentElement.doScroll)
) {
  callback();
} else {
  document.addEventListener('DOMContentLoaded', callback);
}
