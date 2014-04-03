<?php

/**
 * @file
 * Contains Drupal\chosen\ChosenAPI.
 */


namespace Drupal\chosen;

/**
 * Defines the chosen API service.
 */
class ChosenAPI {

  /**
   * Get the location of the chosen library.
   *
   * @return
   *   The location of the library, or FALSE if the library isn't installed.
   */
  function chosen_get_chosen_path() {
    if (function_exists('libraries_get_path')) {
      return libraries_get_path('chosen');
    }

    // The following logic is taken from libraries_get_libraries()
    $searchdir = array();

    // Similar to 'modules' and 'themes' directories inside an installation
    // profile, installation profiles may want to place libraries into a
    // 'libraries' directory.
    $searchdir[] = 'profiles/' . drupal_get_profile() . '/libraries';

    // Always search sites/all/libraries.
    $searchdir[] = 'sites/all/libraries';

    // Also search sites/<domain>/*.
    $searchdir[] = conf_path() . '/libraries';

    foreach ($searchdir as $dir) {
      if (file_exists($dir . '/chosen/chosen.jquery.min.js')) {
        return $dir . '/chosen';
      }
    }

    return FALSE;
  }

}

