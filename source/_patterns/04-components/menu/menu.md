---
el: .menu
title: Menu
---

__Variables:__
* modifier_classes: [string] Classes to modify the default component styling.
* menu_name: [string] Machine name of the menu.
* items: [array] Menu items. Each item is an object containing:
  * title: [string] Title of the menu item.
  * link: [string] URL of the menu item.
  * current: [boolean] Whether menu item is active.
  * children: [array] Child menu items.

__Usage:__
The menu components folder contains several variants including _Account Menu_,
_Footer Menu_, _Main Menu_, and _Subnav Menu_. Each variant is derived from the
menu component and uses specific data within their respective _YML_ files to
replicate the menu items.

The Subnav Menu uses the _item.children_ variable to create a submenu with a menu
item.
