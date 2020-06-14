<?php

namespace Drupal\school\Services;

use Drupal\Core\Database\Connection;

/**
 * CRUD operation for the custom configuration.
 *
 * @package Drupal\school\Services
 */
class UserService {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;

  /**
   * {@inheritdoc}
   */
  public function __construct(Connection $conn) {
    $this->database = $conn;
  }

  /**
   * Save configuration.
   *
   * @param array $post
   *   It will hold the custom configuration value.
   *
   * @return array
   *   It will provide the message with the status.
   */
  public function addStudentInfo($form_state)
  {
    //echo $form_state->getValue('username');die();
    $user_list = file_get_contents('user.json');

    if($user_list && $user_list != '') {
      $user_list = json_decode($user_list);
      $uniqueId = count($user_list) + 1;
      echo '<pre>';print_r($user_list);die();
    } else { echo '<br>yes empty<br>';
      $uniqueId = 1;
      $user_list = [];
    }
     
    $user_list[] = [
      'id' => $uniqueId,
      'username' => $form_state->getValue('username'),
      'email' => $form_state->getValue('email'),
      'password' => $form_state->getValue('password')
    ];
    
    $fp = fopen('user.json', 'w');
    fwrite($fp, json_encode($user_list, JSON_PRETTY_PRINT));
    fclose($fp);
  }
 
}
