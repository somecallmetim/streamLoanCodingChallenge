<?php

namespace App\Factory;

use App\Entity\Branch;
use App\Repository\BranchRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Branch|Proxy createOne(array $attributes = [])
 * @method static Branch[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Branch|Proxy find($criteria)
 * @method static Branch|Proxy findOrCreate(array $attributes)
 * @method static Branch|Proxy first(string $sortedField = 'id')
 * @method static Branch|Proxy last(string $sortedField = 'id')
 * @method static Branch|Proxy random(array $attributes = [])
 * @method static Branch|Proxy randomOrCreate(array $attributes = [])
 * @method static Branch[]|Proxy[] all()
 * @method static Branch[]|Proxy[] findBy(array $attributes)
 * @method static Branch[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Branch[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static BranchRepository|RepositoryProxy repository()
 * @method Branch|Proxy create($attributes = [])
 */
final class BranchFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'country' => self::faker()->countryCode(),
            'state' => self::faker()->randomElement(['CA', 'IA', 'SC', 'CT', 'VA', 'IL', 'NV', 'HI', 'MA', 'ME'])
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Branch $branch) {})
        ;
    }

    protected static function getClass(): string
    {
        return Branch::class;
    }
}
