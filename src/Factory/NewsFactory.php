<?php

namespace App\Factory;

use App\Entity\News;
use App\Entity\NewsCategory;
use App\Repository\NewsRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<News>
 *
 * @method        News|Proxy create(array|callable $attributes = [])
 * @method static News|Proxy createOne(array $attributes = [])
 * @method static News|Proxy find(object|array|mixed $criteria)
 * @method static News|Proxy findOrCreate(array $attributes)
 * @method static News|Proxy first(string $sortedField = 'id')
 * @method static News|Proxy last(string $sortedField = 'id')
 * @method static News|Proxy random(array $attributes = [])
 * @method static News|Proxy randomOrCreate(array $attributes = [])
 * @method static NewsRepository|RepositoryProxy repository()
 * @method static News[]|Proxy[] all()
 * @method static News[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static News[]|Proxy[] createSequence(array|callable $sequence)
 * @method static News[]|Proxy[] findBy(array $attributes)
 * @method static News[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static News[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class NewsFactory extends ModelFactory
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
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween('-1 year')),
            'description' => self::faker()->text(),
            'image' => 'https://loremflickr.com/419/225/'.rand(1000,10000),
            'title' => self::faker()->words(5,true),
            'content' => self::faker()->sentences(30,true),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(News $news): void {})
        ;
    }

    protected static function getClass(): string
    {
        return News::class;
    }
}
