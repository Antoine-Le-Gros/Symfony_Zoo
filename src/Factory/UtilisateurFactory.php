<?php

namespace App\Factory;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Utilisateur>
 *
 * @method        Utilisateur|Proxy                     create(array|callable $attributes = [])
 * @method static Utilisateur|Proxy                     createOne(array $attributes = [])
 * @method static Utilisateur|Proxy                     find(object|array|mixed $criteria)
 * @method static Utilisateur|Proxy                     findOrCreate(array $attributes)
 * @method static Utilisateur|Proxy                     first(string $sortedField = 'id')
 * @method static Utilisateur|Proxy                     last(string $sortedField = 'id')
 * @method static Utilisateur|Proxy                     random(array $attributes = [])
 * @method static Utilisateur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UtilisateurRepository|RepositoryProxy repository()
 * @method static Utilisateur[]|Proxy[]                 all()
 * @method static Utilisateur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Utilisateur[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Utilisateur[]|Proxy[]                 findBy(array $attributes)
 * @method static Utilisateur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Utilisateur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UtilisateurFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {


        return [
            'dateNaisUser' => self::faker()->datetime(),
            'email' => self::faker()->unique()->numerify('user-###').'@example.com',
            'nomUser' => self::faker()->lastName(),
            'password' => 'test',
            'dateVisiteur'=>self::faker()->datetime(),
            'pnomUser' => self::faker()->firstName(),
            'roles' => [],
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (Utilisateur $utilisateur) {
                $utilisateur->setPassword($this->passwordHasher->hashPassword($utilisateur, $utilisateur->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return Utilisateur::class;
    }
}
