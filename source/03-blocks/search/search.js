import domReady from '@wordpress/dom-ready';

const updateVars = () => {
	const searches = document.querySelectorAll('.collapsed-search');
	const screenWidth = document.body.clientWidth;
	const scrollLeft = window.pageXOffset;
	searches.forEach((search) => {
		search.style.setProperty('--search-content-width', `${screenWidth}px`);
		const leftOffset = search.getBoundingClientRect().left + scrollLeft;
		search.style.setProperty('--search-content-left', `-${leftOffset}px`);
	});
};

domReady(() => {
	const searchToggles = document.querySelectorAll(
		'.collapsed-search__toggle'
	);
	searchToggles.forEach((toggle) => {
		toggle.addEventListener('click', (event) => {
			event.preventDefault();
			document.body.classList.toggle('has-open-search');
		});
	});
	window.addEventListener('resize', updateVars);
	updateVars();
});
