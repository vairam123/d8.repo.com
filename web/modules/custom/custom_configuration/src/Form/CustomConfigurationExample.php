<?php

namespace Drupal\custom_configuration\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\custom_configuration\Helper\ConfigurationHelper;
use Drupal\Core\Link;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class CustomConfigurationExample.
 *
 * @package Drupal\custom_configuration\Form
 */
class CustomConfigurationExample extends ConfigFormBase {

  /**
   * Helper object.
   *
   * @var Drupal\custom_configuration\Helper\ConfigurationHelper
   */
  protected $configHelpler;

  /**
   * Request object.
   *
   * @var Symfony\Component\HttpFoundation\RequestStack
   */
  protected $request;

  /**
   * Construct of the Custom Configuration List.
   *
   * @param \Drupal\custom_configuration\Form\ConfigurationHelper $helper
   *   This will create an object of the ConfigurationHelper class.
   */
  public function __construct(ConfigurationHelper $helper, RequestStack $request) {
    $this->configHelpler = $helper;
    $this->request = $request;
  }

  /**
   * This will help us to achieve the dependency injection.
   *
   * @param Symfony\Component\DependencyInjection\ContainerInterface $container
   *   It will get all the services inside the container interface.
   *
   * @return \static
   *   It will return the service of the class.
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('custom.configuration'), $container->get('request_stack')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['configuration.example'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'configuration_example';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $request = $this->request->getCurrentRequest();
    // If machine name exists in current request.
    if ($request->attributes->has('machine_name')) {
      $machineName = $request->attributes->get('machine_name');
      $form = parent::buildForm($form, $form_state);
      // Fetch values.
      $values = \Drupal::service('custom.configuration')->getValues($machineName);
      $string = $this->t('Single value example:') . '<br><strong>';
      $string .= "\$value = \Drupal::service('custom.configuration')->getValue('$machineName');</strong>";
      $string .= '<br><strong>Output :</strong><br> ' . nl2br($values->value);
      $string .= '<br><br><hr><br>';
      $values = var_export($values, TRUE);
      $values = str_replace('stdClass::__set_state(array', 'stdClass Object', $values);
      $string .= $this->t('All values example:') . '<br><strong>';
      $string .= "\$values = \Drupal::service('custom.configuration')->getValues('$machineName');</strong>";
      $form['configuration_example']['markup'] = [
        '#markup' => $string . '<br>',
        '#suffix' => '<strong>Output:</strong><br><pre>' . $values . '</pre>',
      ];
    }
    $link = Link::createFromRoute(
      $this->t('<br><strong>&lt;&lt;Back</strong>'), 'custom_configuration.configuration_list')->toString();
    $form['config-list'][$list->custom_config_id]['edit'] = [
      '#markup' => $link,
    ];
    unset($form['actions']);
    return $form;
  }

}
