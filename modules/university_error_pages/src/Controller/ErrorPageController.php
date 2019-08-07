<?php

namespace Drupal\university_error_pages\Controller;

use Drupal;

class ErrorPageController {

  protected function getErrorPageVariables($content, $form_block = NULL) {
    $output = ['#error_page_content' => $content];

    if ($form_block !== NULL) {
      $login_form = Drupal::service('plugin.manager.block')
        ->createInstance($form_block);
      $output['#login_form'] = $login_form->build();
    }

    return $output;
  }

  public function error403() {
    $config = Drupal::config('university_error_pages.admin_config');
    $user_anonymous = Drupal::currentUser()->isAnonymous();
    $form_shown = $config->get('login_form_403') && $user_anonymous;

    $content = t($config->get('content_403'));
    $form_block = $form_shown ? $config->get('login_form_block') : NULL;

    $variables = $this->getErrorPageVariables($content, $form_block);
    return array_merge(["#theme" => "error_page_403"], $variables);

  }

  public function title403() {
    $config = \Drupal::config('university_error_pages.admin_config');
    return t($config->get('title_403'));
  }

}
