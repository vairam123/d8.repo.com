<?php
namespace Drupal\custom_configuration\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'd8 custom' block.
 *
 * @Block(
 *   id = "d8_custom_block",
 *   admin_label = @Translation("D8 Custom Block"),
 *
 * )
 */
class D8Block extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
  // do something
    return array(
      '#title' => 'D8 Custom block test',
      '#description' => 'needs pto show custom digital clock on region'
    );
  }
}