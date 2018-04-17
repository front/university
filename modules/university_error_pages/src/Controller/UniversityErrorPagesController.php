<?php

namespace Drupal\university_error_pages\Controller;

class UniversityErrorPagesController {

  public function index() {
    $config = \Drupal::config('university_error_pages.admin_config');
    $output['content'] = [
      '#markup' => t($config->get('text')),
    ];
    if ($config->get('login_form') && \Drupal::currentUser()
        ->isAnonymous()) {
      /** @var \Drupal\Core\Block\BlockManager $block_manager */
      $block_manager = \Drupal::service('plugin.manager.block');
      /** @var \Drupal\user\Plugin\Block\UserLoginBlock $login_form */
      $login_form = $block_manager->createInstance('user_login_block');
      $output['form'] = $login_form->build();
    }

    return $output;
  }

  public function title() {
    $config = \Drupal::config('university_error_pages.admin_config');

    return t($config->get('title'));
  }

}
