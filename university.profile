<?php
/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 */

/**
 * Implements hook_modules_installed().
 */
function university_modules_installed($modules) {
  // Thunder is overriding theme config, so we need to set it again, when thunder is installed.
  if (in_array('thunder', $modules)) {
    \Drupal::service('theme_handler')
      ->setDefault('university_theme');
  }
}
