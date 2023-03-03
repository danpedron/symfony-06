<?php

namespace App\Factory;

use App\Entity\NewsCategory;
use App\Repository\NewsCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<NewsCategory>
 *
 * @method        NewsCategory|Proxy create(array|callable $attributes = [])
 * @method static NewsCategory|Proxy createOne(array $attributes = [])
 * @method static NewsCategory|Proxy find(object|array|mixed $criteria)
 * @method static NewsCategory|Proxy findOrCreate(array $attributes)
 * @method static NewsCategory|Proxy first(string $sortedField = 'id')
 * @method static NewsCategory|Proxy last(string $sortedField = 'id')
 * @method static NewsCategory|Proxy random(array $attributes = [])
 * @method static NewsCategory|Proxy randomOrCreate(array $attributes = [])
 * @method static NewsCategoryRepository|RepositoryProxy repository()
 * @method static NewsCategory[]|Proxy[] all()
 * @method static NewsCategory[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static NewsCategory[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static NewsCategory[]|Proxy[] findBy(array $attributes)
 * @method static NewsCategory[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static NewsCategory[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class NewsCategoryFactory extends ModelFactory
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
            'title' => self::faker()->jobTitle()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(NewsCategory $newsCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return NewsCategory::class;
    }
}
