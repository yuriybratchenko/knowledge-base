window.onload = function() {
	const customOffsetListingGrid = document.querySelectorAll('.custom-offset-listing-grid .jet-listing-grid__item');

	customOffsetListingGrid.forEach( item => {
		if (!(item.style.left === '0px')) {
			item.style.left = 'calc(50% + 10px)';
		}
	})
};