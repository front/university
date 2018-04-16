<?php

/**
 * @file
 * Contains Drupal\university_error_pages\Form\AdminConfig.
 */

namespace Drupal\university_error_pages\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AdminConfig.
 *
 * @package Drupal\university_error_pages\Form
 */
class AdminConfig extends ConfigFormBase {

  public function getFormId() {
    return 'university_error_pages_admin_config';
  }

  protected function getEditableConfigNames() {
    return [
      'university_error_pages.admin_config',
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('university_error_pages.admin_config');
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title') ? $config->get('title') : '403 - Access denied',
    ];

    $form['text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Text'),
      '#format' => 'full_html',
      '#default_value' => $config->get('text') ? $config->get('text') : 'Unfortunately, you don’t have permission to enter this area of the site.',
    ];

    $form['login_form'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Login Form'),
      '#default_value' => $config->get('login_form') == 0 ? false : true,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save config'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('university_error_pages.admin_config')
      ->set('title', $form_state->getValue('title'))
      ->set('text', $form_state->getValue('text')['value'])
      ->set('login_form', $form_state->getValue('login_form'))
      ->save();
  }

}
