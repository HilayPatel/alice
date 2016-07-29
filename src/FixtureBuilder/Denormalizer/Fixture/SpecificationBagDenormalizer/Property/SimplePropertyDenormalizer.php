<?php

/*
 * This file is part of the Alice package.
 *
 * (c) Nelmio <hello@nelm.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\Property;

use Nelmio\Alice\Definition\FlagBag;
use Nelmio\Alice\Definition\Property;
use Nelmio\Alice\ExpressionLanguage\ParserInterface;
use Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\PropertyDenormalizerInterface;
use Nelmio\Alice\FixtureBuilder\Denormalizer\Fixture\SpecificationBagDenormalizer\ValueDenormalizerInterface;
use Nelmio\Alice\FixtureInterface;
use Nelmio\Alice\NotClonableTrait;

final class SimplePropertyDenormalizer implements PropertyDenormalizerInterface
{
    use NotClonableTrait;

    /**
     * @var ParserInterface
     */
    private $valueDenormalizer;

    public function __construct(ValueDenormalizerInterface $valueDenormalizer)
    {
        $this->valueDenormalizer = $valueDenormalizer;
    }

    /**
     * @inheritdoc
     */
    public function denormalize(FixtureInterface $scope, string $name, $value, FlagBag $flags): Property
    {
        $value = $this->valueDenormalizer->denormalize($scope, $flags, $value);

        return new Property($name, $value);
    }
}
