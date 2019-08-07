<?php

namespace Drupal\university_error_pages\Form;

use Drupal;
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

    $form['label_global'] = [
      '#type' => 'html_tag',
      '#tag' => 'h3',
      '#value' => $this->t('Global error pages configuration'),
    ];

    $form['space'] = [
      '#type' => 'html_tag',
      '#tag' => 'hr',
    ];

    $form['login_form_block'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name of the login form block'),
      '#default_value' => $this->t($config->get('login_form_block')),
      '#required' => true,
    ];

    $form['403_config'] = [
      '#type' => 'container',
    ];

    $form['403_config']['label_403'] = [
      '#type' => 'html_tag',
      '#tag' => 'h3',
      '#value' => $this->t('Page 403 specific configuration'),
    ];

    $form['403_config']['space'] = [
      '#type' => 'html_tag',
      '#tag' => 'hr',
    ];

    $form['403_config']['title_403'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title (403 page)'),
      '#default_value' => $this->t($config->get('title_403')),
      '#required' => true,
    ];

    $form['403_config']['content_403'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content (403 page)'),
      '#format' => 'full_html',
      '#default_value' => $this->t($config->get('content_403')),
    ];

    $form['403_config']['login_form_403'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Login Form (403 page)'),
      '#default_value' => !!$config->get('login_form_403'),
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
      ->set('title_403', $form_state->getValue('title_403'))
      ->set('content_403', $form_state->getValue('content_403')['value'])
      ->set('login_form_403', $form_state->getValue('login_form_403'))
      ->set('login_form_block', $form_state->getValue('login_form_block'))
      ->save();

    // Remove cache so that it takes effect.
    drupal_flush_all_caches();
  }

}
