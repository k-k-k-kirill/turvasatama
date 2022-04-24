// Common
import { makeEmbedsResponsive } from "./common/video-embeds";

// Imports.
import $ from "jquery"; // eslint-disable-line

const pixelsThemeApp = (function main() {
	const handleResponsiveVideos = () => {
		const videos = document.querySelectorAll(
			'iframe[src*="youtube"], iframe[src*="vimeo"]'
		);
		makeEmbedsResponsive(videos);
	};

	const handleMobileNavToggleClick = () => {
		const mobileNavToggle = document.querySelector('.js-mobile-nav-toggle');


		if (mobileNavToggle) {
			mobileNavToggle.addEventListener('click', () => {
				const mobileNav = document.querySelector('.js-mobile-nav');
				mobileNav.classList.toggle('show');
			})
		}
	}

	const handleMobileDropdownToggleClick = () => {
		const mobileDropdownToggles = document.querySelectorAll('.js-mobile-dropdown-toggle');

		if (mobileDropdownToggles.length > 0) {
			mobileDropdownToggles.forEach(toggle => {
				toggle.addEventListener('click', (e) => {
					const dropdownMenuId = toggle.dataset.toggle;
					const dropdownMenu = document.getElementById(dropdownMenuId);

					if (dropdownMenu) {
						dropdownMenu.classList.toggle('show');
						e.currentTarget.classList.toggle('open');
					}
				})
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

	// Page load actions.
	const init = () => {
		handleResponsiveVideos();
		handleMobileNavToggleClick();
		handleMobileDropdownToggleClick();
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
