<?php

namespace Drupal\Tests\telephone_validation\Kernel;

use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use \Drupal\Tests\telephone\Kernel\TelephoneItemTest as BaseItemTest;
use libphonenumber\PhoneNumberFormat;


/**
 * Test entity validation.
 *
 * @package Drupal\Tests\telephone_validation\Kernel
 * @group Telephone
 */
class TelephoneItemTest extends BaseItemTest {

  /**
   * Modules to enable.
   */
  protected static $modules = ['telephone_validation'];

  /**
   * Enable validation on telephone field.
   */
  protected function setUp() : void {
    parent::setUp();

    $config = FieldConfig::loadByName('entity_test', 'entity_test', 'field_test');
    $config->setThirdPartySetting('telephone_validation', 'format', PhoneNumberFormat::NATIONAL);
    $config->setThirdPartySetting('telephone_validation', 'country', ['CA']);
    $config->save();
  }

  /**
   * Test valid Canadian phone number.
   */
  public function testTestItem(): void {
    // Valid Canadian number.
    $value = '2507638884';

    // Verify entity creation.
    $entity = EntityTest::create();
    $entity->field_test = $value;
    $entity->name->value = $this->randomMachineName();
    $this->entityValidateAndSave($entity);
  }

  /**
   * Test invalid number.
   */
  public function testInvalidTelephoneNumber(): void {
    // Invalid Canadian number.
    $value = '999999';

    // Verify entity creation.
    $entity = EntityTest::create();
    $entity->field_test = $value;
    $entity->name->value = $this->randomMachineName();
    $violations = $entity->validate();
    $this->assertEquals(count($violations), 1);
    $this->assertEquals($violations[0]->getMessage(), '999999 is not a valid phone number.');
  }

}
