// Common
import { makeEmbedsResponsive } from "./common/video-embeds";
import Splide from "@splidejs/splide";

// Imports.
import $ from "jquery"; // eslint-disable-line
import MagneticButton from "./MagneticButton";

const pixelsThemeApp = (function main() {
	const handleResponsiveVideos = () => {
		const videos = document.querySelectorAll(
			'iframe[src*="youtube"], iframe[src*="vimeo"]'
		);
		makeEmbedsResponsive(videos);
	};

	const handleDropdownToggleClick = () => {
		const desktopDropdownToggles = document.querySelectorAll(
			".js-desktop-dropdown-toggle"
		);
		const mobileDropdownToggles = document.querySelectorAll(
			".js-mobile-dropdown-toggle"
		);
		const allToggles = [...desktopDropdownToggles, ...mobileDropdownToggles];

		if (allToggles.length > 0) {
			allToggles.forEach((toggle) => {
				toggle.addEventListener("click", (e) => {
					const dropdownMenuId = toggle.dataset.toggle;
					const dropdownMenu = document.getElementById(dropdownMenuId);

					if (dropdownMenu) {
						hideAllDropdowns(dropdownMenuId);
						dropdownMenu.classList.toggle("show");
					}
				});
			});
		}
	};

	const hideAllDropdowns = (currentDropdownId = null) => {
		const dropdowns = document.querySelectorAll(".js-dropdown-menu");

		if (dropdowns.length > 0) {
			dropdowns.forEach((dropdown) => {
				if (currentDropdownId !== dropdown.id) {
					dropdown.classList.remove("show");
				}
			});
		}
	};

	const lockScroll = () => {
		document.body.classList.add("scroll-lock");
		document.documentElement.classList.add("scroll-lock");
	};

	const unlockScroll = () => {
		document.body.classList.remove("scroll-lock");
		document.documentElement.classList.remove("scroll-lock");
	};

	const handleMobileNavToggleClick = () => {
		const mobileNavToggle = document.querySelector(".js-mobile-nav-toggle");

		if (mobileNavToggle) {
			mobileNavToggle.addEventListener("click", (e) => {
				mobileNavToggle.classList.toggle("open");
				const mobileNav = document.querySelector(".js-mobile-nav");
				mobileNav.classList.toggle("show");

				if (mobileNavToggle.classList.contains("open")) {
					lockScroll();
				} else {
					unlockScroll();
				}
			});
		}
	};

	const handleMobileNavClosingOnResize = () => {
		const mobileNav = document.querySelector(".js-mobile-nav");

		if (mobileNav) {
			if (window.innerWidth > 768) {
				mobileNav.classList.remove("show");
			}
		}
	};

	const initCasesSlider = () => {
		const element = document.querySelector(".js-cases-slider");
		const isMobile = document.documentElement.clientWidth < 768;

		if (element) {
			if (isMobile) {
				const mobileArrowsContainer = document.querySelector(
					".js-mobile-cases-arrows"
				);

				mobileArrowsContainer.append(
					...document.querySelector(".js-arrows-desktop").childNodes
				);
			}

			new Splide(element, {
				type: "loop",
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
					},
				},
			}).mount();
		}
	};

	const initServicesSlider = () => {
		const element = document.querySelector(".js-services-slider");

		if (element) {
			new Splide(".js-services-slider", {
				type: "loop",
				perPage: 2,
				perMove: 1,
				gap: 30,
				pagination: false,
				arrows: false,
				autoplay: true,
				fixedWidth: 289,
			}).mount();
		}
	};

	const displayActiveBubbleContent = () => {
		const activeBubble = document.querySelector(".js-bubble.active");

		if (activeBubble) {
			const bubbleDisplayTitle = document.querySelector(".js-bubble-title");
			const bubbleDisplayContent = document.querySelector(".js-bubble-content");

			const activeBubbleId = activeBubble.id;
			const activeBubbleTitle = document.getElementById(
				`${activeBubbleId}-title`
			);
			const activeBubbleContent = document.getElementById(
				`${activeBubbleId}-content`
			);

			bubbleDisplayTitle.innerHTML = activeBubbleTitle.innerHTML;
			bubbleDisplayContent.innerHTML = activeBubbleContent.innerHTML;
		}
	};

	const displayActiveSliderBubbleContent = () => {
		const activeBubble = document.querySelector(".js-slider-bubble.active");

		if (activeBubble) {
			const bubbleDisplayTitle = document.querySelector(
				".js-slider-bubble-title"
			);
			const bubbleDisplayContent = document.querySelector(
				".js-slider-bubble-content"
			);

			const activeBubbleId = activeBubble.id.replace("-slider", "");
			const activeBubbleTitle = document.getElementById(
				`${activeBubbleId}-title`
			);
			const activeBubbleContent = document.getElementById(
				`${activeBubbleId}-content`
			);

			bubbleDisplayTitle.innerHTML = activeBubbleTitle.innerHTML;
			bubbleDisplayContent.innerHTML = activeBubbleContent.innerHTML;
		}
	};

	const initBubbles = () => {
		displayActiveBubbleContent();

		const bubbles = document.querySelectorAll(".js-bubble");

		if (bubbles) {
			bubbles.forEach((bubble) => {
				bubble.addEventListener("click", (e) => {
					const activeBubbles = document.querySelectorAll(".js-bubble.active");
					activeBubbles.forEach((activeBubble) =>
						activeBubble.classList.remove("active")
					);

					e.target.classList.add("active");
					displayActiveBubbleContent();
				});
			});
		}
	};

	const initMagneticBubbles = () => {
		const magneticBubbles = document.querySelectorAll(".js-bubble");

		if (magneticBubbles) {
			magneticBubbles.forEach((bubble) => {
				new MagneticButton(bubble);
			});
		}
	};

	const initBubblesSlider = () => {
		const element = document.querySelector(".js-bubbles-slider");

		if (element) {
			const bubblesSlider = new Splide(".js-bubbles-slider", {
				type: "loop",
				perPage: 1,
				perMove: 1,
				gap: 30,
				pagination: false,
				arrows: false,
				autoplay: true,
				fixedWidth: 240,
				fixedHeight: 240,
			}).mount();

			displayActiveSliderBubbleContent();

			bubblesSlider.on("active", (slide) => {
				slide.slide.querySelector(".js-slider-bubble").classList.add("active");
				displayActiveSliderBubbleContent();
			});

			bubblesSlider.on("inactive", (slide) => {
				slide.slide
					.querySelector(".js-slider-bubble")
					.classList.remove("active");
			});
		}
	};

	const initAuthorAboutToggle = () => {
		const aboutToggle = document.querySelector('.author__about__toggle');
		const aboutContainer = document.querySelector('.author__about--collapsible');
		const aboutContent = document.querySelector('.author__about__content');
		const toggleText = document.querySelector('.author__about__toggle-text');

		if (aboutToggle && aboutContainer && aboutContent && toggleText) {
			// Temporarily remove collapsed state to measure actual content height
			aboutContainer.setAttribute('data-collapsed', 'false');
			
			// Wait for next frame to ensure styles are applied
			requestAnimationFrame(() => {
				const contentHeight = aboutContent.scrollHeight;
				
				// If content is less than or equal to 245px, hide toggle and keep expanded
				if (contentHeight <= 245) {
					aboutToggle.style.display = 'none';
					aboutContainer.setAttribute('data-collapsed', 'false');
				} else {
					// Content is taller than 245px, show toggle and set initial collapsed state
					aboutToggle.style.display = 'inline-block';
					aboutContainer.setAttribute('data-collapsed', 'true');
				}
				
				// Add processed class to show content with smooth transition
				aboutContainer.classList.add('js-processed');
				
				aboutToggle.addEventListener('click', (e) => {
					e.preventDefault(); // Prevent default anchor behavior
					
					const isCollapsed = aboutContainer.getAttribute('data-collapsed') === 'true';
					const textMore = aboutToggle.getAttribute('data-text-more');
					const textLess = aboutToggle.getAttribute('data-text-less');
					
					if (isCollapsed) {
						aboutContainer.setAttribute('data-collapsed', 'false');
						toggleText.textContent = textLess;
					} else {
						aboutContainer.setAttribute('data-collapsed', 'true');
						toggleText.textContent = textMore;
						
						// Scroll to the author__about div when collapsing
						setTimeout(() => {
							aboutContainer.scrollIntoView({ 
								behavior: 'smooth', 
								block: 'start' 
							});
						}, 100); // Small delay to ensure collapse animation starts
					}
				});
			});
		}
	};

	// Page load actions.
	const init = () => {
		handleResponsiveVideos();
		handleMobileNavToggleClick();
		handleDropdownToggleClick();
		initCasesSlider();
		initServicesSlider();
		initBubbles();
		initMagneticBubbles();
		initBubblesSlider();
		initAuthorAboutToggle();
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
