<?php

namespace Drupal\config_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Custom configuration controller.
 *
 * @package Drupal\config_example\Controller
 */
class ConfigExampleController extends ControllerBase {

  /**
   * Database connection class.
   *
   * @var Drupal\Core\Database\Database
   */
  private $database;

  /**
   * Controller construct.
   */
  public function __construct() {
    $this->database = Database::getConnection();
  }

}
