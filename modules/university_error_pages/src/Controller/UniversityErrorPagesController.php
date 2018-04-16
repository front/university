<?php

namespace Drupal\university_error_pages\Controller;

class UniversityErrorPagesController {

  public function index() {
    /** @var \Drupal\Core\Block\BlockManager $block_manager */
    $block_manager = \Drupal::service('plugin.manager.block');
    /** @var \Drupal\user\Plugin\Block\UserLoginBlock $login_form */
    $login_form = $block_manager->createInstance('user_login_block');
    $config = \Drupal::config('university_error_pages.admin_config');

    $output['content'] = array(
      '#markup' => $config->get('text'),
    );

    if ($config->get('login_form') === 1 && \Drupal::currentUser()->isAnonymous()) {
      $output['form'] = $login_form->build();
    }

    return $output;
  }

  public function title() {
    $config = \Drupal::config('university_error_pages.admin_config');

    return $config->get('title');
  }

}
