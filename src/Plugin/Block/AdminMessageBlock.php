<?php
namespace Drupal\admin_message\plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
//use Drupal\admin_message\AdminMessageRepositoryInterface;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Provides an 'AdminMessage' Block
 *
 * @Block(
 *   id = "admin_message_block",
 *   admin_label = @Translation("Admin Message block")
 * )
 */
class AdminMessageBlock extends BlockBase implements BlockPluginInterface{
   /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['admin_message_block_name'])) {
      $message = $config['admin_message_block_name'];
    }
    else {
      $message = $this->t('');
    }
    return array(
      '#markup' => $this->t('@message', array (
          '@message' => $message,
        )
      ),
    );
  }
   /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['admin_message_block_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Admin Message:'),
      '#description' => $this->t('What is your message?'),
      '#default_value' => isset($config['admin_message_block_name']) ? $config['admin_message_block_name'] : '',
    );

    return $form;
  }
    /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['admin_message_block_name'] = $values['admin_message_block_name'];
  }
    /**
   * {@inheritdoc}
   */
  /*
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['admin_message_block_name'] = $form_state->getValue('admin_message_block_name');
  }
   * 
   */
  
 
  public function defaultConfiguration() {
    $default_config = \Drupal::config('admin_message.settings');
    return array(
      'admin_message_block_name' => $default_config->get('admin_message.name'),
       'message' => $default_config->get('admin_message.message')
    );
  }
}
