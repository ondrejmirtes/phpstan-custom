<?php declare(strict_types = 1);

namespace Taptima\PHPStan\Rules\Properties;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPStan\Type\Doctrine\ObjectMetadataResolver;

/**
 * @extends RuleTestCase<EntityPropertyHasGetterAndSetterRule>
 */
class EntityPropertyHasGetterAndSetterRuleTest extends RuleTestCase
{

    protected function getRule(): Rule
    {
        return new EntityPropertyHasGetterAndSetterRule(new ObjectMetadataResolver(__DIR__ . '/entity-manager.php', null));
    }

    public function testRule(): void
    {
        $this->analyse([__DIR__ . '/data/Entity.php'], [
            [
                'Property Taptima\PHPStan\Rules\Properties\Entity::$id must have a getter "getId".',
                19,
            ],
            [
                'Property Taptima\PHPStan\Rules\Properties\Entity::$name must have a setter "setName".',
                26,
            ],
            [
                'Property Taptima\PHPStan\Rules\Properties\Entity::$surname must have a getter "getSurname".',
                33,
            ],
            [
                'Property Taptima\PHPStan\Rules\Properties\Entity::$enabled must have one of the following methods "isEnabled", "hasEnabled".',
                40,
            ],
            [
                'Property Taptima\PHPStan\Rules\Properties\Entity::$enabled type of boolean must no have a getter "getEnabled". Instead, it should have one of the following methods "isEnabled", "hasEnabled".',
                40,
            ],
            [
                'Property Taptima\PHPStan\Rules\Properties\Entity::$items must have an adder. E.g. "addItem".',
                47,
            ],
            [
                'Property Taptima\PHPStan\Rules\Properties\Entity::$items must have an remover. E.g. "removeItem".',
                47,
            ],
        ]);
    }

    public function testHasserAsGetterForBooleanField(): void
    {
        $this->analyse([__DIR__ . '/data/EntityWithBooleanFieldHasser.php'], []);
    }

    public function testIsserAsGetterForBooleanField(): void
    {
        $this->analyse([__DIR__ . '/data/EntityWithBooleanFieldHasser.php'], []);
    }

    public function testEntityWithCollectionField(): void
    {
        $this->analyse([__DIR__ . '/data/EntityWithCollection.php'], []);
    }
}
