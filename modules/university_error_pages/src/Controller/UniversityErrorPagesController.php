<?php

namespace Drupal\university_error_pages\Controller;

class UniversityErrorPagesController {

  public function index() {
    /** @var \Drupal\Core\Block\BlockManager $block_manager */
    $block_manager = \Drupal::service('plugin.manager.block');
    /** @var \Drupal\user\Plugin\Block\UserLoginBlock $login_form */
    $login_form = $block_manager->createInstance('user_login_block');
    $config = \Drupal::config('university_error_pages.admin_config');
    $markup = $config->get('text') != NULL
      ? $config->get('text')
      : 'Unfortunately, you don’t have permission to enter this area of the site.';
    $output['content'] = [
      '#markup' => t($markup),
    ];
    if ($config->get('login_form') && \Drupal::currentUser()
        ->isAnonymous()) {
      $output['form'] = $login_form->build();
    }

    return $output;
  }

  public function title() {
    $config = \Drupal::config('university_error_pages.admin_config');
    $title = $config->get('title') != NULL
      ? t($config->get('title'))
      : t('403 - Access denied');

    return $title;
  }

}
