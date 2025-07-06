<?php

/**
 * Class for ACF Settings.
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Config;

/**
 * Handles common ACF changes.
 */
class ACF {

	/**
	 * Class constructor
	 */
	public function __construct() {
		error_log( print_r( 'ACF fires', 1 ) );

		// Sets the default language for ACF options pages based on Polylang.
		if ( ! defined( 'KAI_CO_DISABLE_SET_ACF_DEFAULT_LANG_FROM_PLL' ) ) {
			add_filter( 'acf/settings/default_language', array( $this, 'set_acf_options_default_language_from_pll' ) );
		}

		// Sets the current language for ACF options pages based on Polylang.
		if ( ! defined( 'KAI_CO_DISABLE_SET_ACF_CURRENT_LANG_FROM_PLL' ) ) {
			add_filter( 'acf/settings/current_language', array( $this, 'set_acf_options_current_language_from_pll' ) );
		}
	}

	/**
	 * Sets the default language for ACF settings from Polylang.
	 *
	 * @param  string $language Existing default language.
	 * @return string           Default language according to Polylang.
	 */
	public function set_acf_options_default_language_from_pll( $language ) {
		if ( function_exists( 'pll_default_language' ) ) {
			$language = pll_default_language();
		}

		return $language;
	}

	/**
	 * Sets the current language for ACF settings from Polylang.
	 *
	 * @param  string $language Existing current language.
	 * @return string           Current language according to Polylang.
	 */
	public function set_acf_options_current_language_from_pll( $language ) {
		if ( function_exists( 'pll_current_language' ) ) {
			$language = pll_current_language();
		}

		return $language;
	}
}
