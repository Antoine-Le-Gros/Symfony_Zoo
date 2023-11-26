<?php

namespace App\Factory;

use App\Entity\Regime;
use App\Repository\RegimeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Regime>
 *
 * @method        Regime|Proxy                     create(array|callable $attributes = [])
 * @method static Regime|Proxy                     createOne(array $attributes = [])
 * @method static Regime|Proxy                     find(object|array|mixed $criteria)
 * @method static Regime|Proxy                     findOrCreate(array $attributes)
 * @method static Regime|Proxy                     first(string $sortedField = 'id')
 * @method static Regime|Proxy                     last(string $sortedField = 'id')
 * @method static Regime|Proxy                     random(array $attributes = [])
 * @method static Regime|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RegimeRepository|RepositoryProxy repository()
 * @method static Regime[]|Proxy[]                 all()
 * @method static Regime[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Regime[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Regime[]|Proxy[]                 findBy(array $attributes)
 * @method static Regime[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Regime[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RegimeFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function getDefaults(): array
    {
        return [
            'nomRegime' => self::faker()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Regime $regime): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Regime::class;
    }
}
