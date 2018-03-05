/**
 * @file
 * script.js
 *
 * Defines the behaviors needed for University administration theme.
 */

(function ($, Drupal, drupalSettings) {
  'use strict';

  Drupal.behaviors.universityAdmin = {
    attach: function (context) {
      $('form.node-form', context).each(function () {
        var $nodeForm = $(this);

        if (!$('.field--name-title .form-text', $nodeForm).val()) {
          $('.field--name-title .form-text', $nodeForm).focus();
        }
      });
    }
  };

}(jQuery, Drupal, drupalSettings));