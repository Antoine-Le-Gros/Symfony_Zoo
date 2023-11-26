<?php

namespace App\Factory;

use App\Entity\CategorieAnimal;
use App\Repository\CategorieAnimalRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CategorieAnimal>
 *
 * @method        CategorieAnimal|Proxy                     create(array|callable $attributes = [])
 * @method static CategorieAnimal|Proxy                     createOne(array $attributes = [])
 * @method static CategorieAnimal|Proxy                     find(object|array|mixed $criteria)
 * @method static CategorieAnimal|Proxy                     findOrCreate(array $attributes)
 * @method static CategorieAnimal|Proxy                     first(string $sortedField = 'id')
 * @method static CategorieAnimal|Proxy                     last(string $sortedField = 'id')
 * @method static CategorieAnimal|Proxy                     random(array $attributes = [])
 * @method static CategorieAnimal|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CategorieAnimalRepository|RepositoryProxy repository()
 * @method static CategorieAnimal[]|Proxy[]                 all()
 * @method static CategorieAnimal[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static CategorieAnimal[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static CategorieAnimal[]|Proxy[]                 findBy(array $attributes)
 * @method static CategorieAnimal[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static CategorieAnimal[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CategorieAnimalFactory extends ModelFactory
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
            'nomCategorie' => self::faker()->word(),
            'descriptionCategorie' => self::faker()->text(50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(CategorieAnimal $categorieAnimal): void {})
        ;
    }

    protected static function getClass(): string
    {
        return CategorieAnimal::class;
    }
}
