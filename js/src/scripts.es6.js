/**
 * @file
 * Global scripts.
 */
import MobileMenu from './modules/MobileMenu.js';

(function() {
  'use strict';

  // Mobile menu
  const mobileMenu = new MobileMenu();
  mobileMenu.init();

  // Generic function that runs on window resize.
  // An empty function is allowed here because it's meant as a placeholder,
  // but you should remove this functionality if you aren't using it!
  // eslint-disable-next-line no-empty-function
  function resizeStuff() {}

  // Runs function once on window resize.
  let timeOut = false;
  window.addEventListener('resize', () => {
    if (timeOut !== false) {
      clearTimeout(timeOut);
    }

    // 200 is time in miliseconds.
    timeOut = setTimeout(resizeStuff, 200);
  });
})();
