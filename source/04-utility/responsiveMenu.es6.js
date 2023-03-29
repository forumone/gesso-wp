const menuToggles = document.getElementsByClassName(
	'menu--responsive__hamburger'
);

for (let i = 0; i < menuToggles.length; i++) {
	menuToggles.item(i).addEventListener('click', function () {
		const menuId = menuToggles.item(i).getAttribute('data-target');
		const menu = document.getElementById(menuId);
		menu.classList.toggle('open');
		menuToggles.item(i).classList.toggle('open');
	});
}
