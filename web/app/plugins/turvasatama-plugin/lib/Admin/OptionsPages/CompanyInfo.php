<?php

/**
 * Class for Company Info Options Page.
 *
 * @package TurvaSatama.
 */

namespace Pixels\TurvaSatama\Admin\OptionsPages;

/**
 * Register options page for Company Info
 */
class CompanyInfo
{

  /**
   * Class constructor
   */
  public function __construct()
  {
    acf_add_options_page(
      array(
        'page_title'  => 'Company Info',
        'menu_title'  => 'Company Info',
      )
    );
  }
}
