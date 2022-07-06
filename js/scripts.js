( function( $ ) {
	let
		// body = document.body,
		// isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
		plugins = {
		collapse:    document.querySelectorAll('[data-collapse-target]'),
	};

	function toggleClass(node, className = 'active', state = true) {
		let condition = node.classList.contains(className);

		if (state) {
			if (condition) {
				node.classList.remove(className);
			} else {
				node.classList.add(className);
			}
		}
	}

	// Collapse
	if (plugins.collapse.length) {
		plugins.collapse.forEach(node => {
			let
				id = node.getAttribute('data-collapse-target'),
				target = null,
				defaultText = null,
				otherText = node.getAttribute('data-toggle-text');

			if (id) {
				target = document.querySelector('#' + id);
			}

			if (otherText) {
				defaultText = node.textContent;
			}

			if (target) {
				node.addEventListener('click', function(event) {
					toggleClass(this);
					$(target).slideToggle();
					if (otherText) {
						if (this.textContent === otherText) {
							this.textContent = defaultText;
						} else {
							this.textContent = otherText;
						}
					}
				});
			}
		})
	}

})( jQuery );