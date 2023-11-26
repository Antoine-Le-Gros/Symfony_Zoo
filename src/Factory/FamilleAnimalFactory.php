<?php

namespace App\Factory;

use App\Entity\FamilleAnimal;
use App\Repository\FamilleAnimalRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<FamilleAnimal>
 *
 * @method        FamilleAnimal|Proxy create(array|callable $attributes = [])
 * @method static FamilleAnimal|Proxy createOne(array $attributes = [])
 * @method static FamilleAnimal|Proxy find(object|array|mixed $criteria)
 * @method static FamilleAnimal|Proxy findOrCreate(array $attributes)
 * @method static FamilleAnimal|Proxy first(string $sortedField = 'id')
 * @method static FamilleAnimal|Proxy last(string $sortedField = 'id')
 * @method static FamilleAnimal|Proxy random(array $attributes = [])
 * @method static FamilleAnimal|Proxy randomOrCreate(array $attributes = [])
 * @method static FamilleAnimalRepository|RepositoryProxy repository()
 * @method static FamilleAnimal[]|Proxy[] all()
 * @method static FamilleAnimal[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static FamilleAnimal[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static FamilleAnimal[]|Proxy[] findBy(array $attributes)
 * @method static FamilleAnimal[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static FamilleAnimal[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FamilleAnimalFactory extends ModelFactory
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
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'categorie' => CategorieAnimalFactory::random(),
            'descriptionFamille' => self::faker()->text(50),
            'nomFamille' => self::faker()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(FamilleAnimal $familleAnimal): void {})
        ;
    }

    protected static function getClass(): string
    {
        return FamilleAnimal::class;
    }
}
