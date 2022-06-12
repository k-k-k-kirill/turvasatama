// Common
import { makeEmbedsResponsive } from "./common/video-embeds";
import Splide from '@splidejs/splide';

// Imports.
import $ from "jquery"; // eslint-disable-line

const pixelsThemeApp = (function main() {
	const handleResponsiveVideos = () => {
		const videos = document.querySelectorAll(
			'iframe[src*="youtube"], iframe[src*="vimeo"]'
		);
		makeEmbedsResponsive(videos);
	};

	const handleDropdownToggleClick = () => {
		const desktopDropdownToggles = document.querySelectorAll('.js-desktop-dropdown-toggle');
		const mobileDropdownToggles = document.querySelectorAll('.js-mobile-dropdown-toggle');
		const allToggles = [...desktopDropdownToggles, ...mobileDropdownToggles];

		if (allToggles.length > 0) {
			allToggles.forEach((toggle) => {
				toggle.addEventListener('click', (e) => {
					const dropdownMenuId = toggle.dataset.toggle;
					const dropdownMenu = document.getElementById(dropdownMenuId);

					if (dropdownMenu) {
						hideAllDropdowns(dropdownMenuId);
						dropdownMenu.classList.toggle('show');
					}
				})
			})
		}
	}

	const hideAllDropdowns = (currentDropdownId = null) => {
		const dropdowns = document.querySelectorAll('.js-dropdown-menu');

		if(dropdowns.length > 0) {
			dropdowns.forEach(dropdown => {
				if (currentDropdownId !== dropdown.id) {
					dropdown.classList.remove('show');
				}
			})
		}
	}

	const handleMobileNavToggleClick = () => {
		const mobileNavToggle = document.querySelector('.js-mobile-nav-toggle');


		if (mobileNavToggle) {
			mobileNavToggle.addEventListener('click', (e) => {
				mobileNavToggle.classList.toggle('open');
				const mobileNav = document.querySelector('.js-mobile-nav');
				mobileNav.classList.toggle('show');
			})
		}
	}

	const handleMobileNavClosingOnResize = () => {
		const mobileNav = document.querySelector('.js-mobile-nav');

		if (mobileNav) {
			if (window.innerWidth > 768) {
				mobileNav.classList.remove('show');
			}
		}
	}

	const initCasesSlider = () => {
		const element = document.querySelector('.js-cases-slider');
		const isMobile = document.documentElement.clientWidth < 768;

		if (isMobile) {
			const mobileArrowsContainer = document.querySelector('.js-mobile-cases-arrows');

			mobileArrowsContainer.append(...document.querySelector('.js-arrows-desktop').childNodes);
		}

		new Splide(element, {
			type   : 'loop',
			perPage: 2,
			perMove: 1,
			gap: 30,
			pagination: false,
			arrows: true,
			autoplay: true,
			fixedWidth: 780,
			breakpoints: {
				768: {
					perPage: 1,
					fixedWidth: null,
				}
			}
		}).mount();
	}

	// Page load actions.
	const init = () => {
		handleResponsiveVideos();
		handleMobileNavToggleClick();
		handleDropdownToggleClick();
		initCasesSlider();
	};

	// Scroll actions.
	const scroll = () => {};

	// Resize screen actions.
	const resize = () => {
		handleMobileNavClosingOnResize();
	};

	// Exports to DOM binds.
	return { init, scroll, resize };
})();

/**
 * DOM listener binds
 * --> Init
 * --> Scroll
 * --> Resize
 */
document.addEventListener("DOMContentLoaded", () => {
	pixelsThemeApp.init();
});

window.addEventListener("scroll", () => {
	pixelsThemeApp.scroll();
});

window.addEventListener("resize", () => {
	pixelsThemeApp.resize();
});