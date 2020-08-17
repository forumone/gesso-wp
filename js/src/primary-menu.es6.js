import { MenuBar } from './modules/_Menu.es6';

const callback = function () {
  'use strict';

  // The styling for this mobile menu is located in source/_patterns/04-components/menus/menu--main/.
  const menuNode = document.querySelector('.menu--main');
  if (menuNode) {
    const myMenu = new MenuBar(menuNode);
    myMenu.init();
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
