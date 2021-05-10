<?php

namespace App\Factory;

use App\Entity\Loan;
use App\Repository\LoanRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Loan|Proxy createOne(array $attributes = [])
 * @method static Loan[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Loan|Proxy find($criteria)
 * @method static Loan|Proxy findOrCreate(array $attributes)
 * @method static Loan|Proxy first(string $sortedField = 'id')
 * @method static Loan|Proxy last(string $sortedField = 'id')
 * @method static Loan|Proxy random(array $attributes = [])
 * @method static Loan|Proxy randomOrCreate(array $attributes = [])
 * @method static Loan[]|Proxy[] all()
 * @method static Loan[]|Proxy[] findBy(array $attributes)
 * @method static Loan[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Loan[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LoanRepository|RepositoryProxy repository()
 * @method Loan|Proxy create($attributes = [])
 */
final class LoanFactory extends ModelFactory
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
            'value' => self::faker()->randomFloat(2, 1000, 50000),
            'is_active' => self::faker()->numberBetween(0,1),
            'branch' => BranchFactory::new()
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Loan $loan) {})
        ;
    }

    protected static function getClass(): string
    {
        return Loan::class;
    }
}
