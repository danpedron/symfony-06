<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;

class NewsRepository
{
    public function findAll(): array
    {
        $news = $cache->get('news_data', function (CacheItemInterface $cacheItem) use ($httpClient) {
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/JonasPoli/array-news/6592605d783b39aa2edac63868959ded7ef700ec/arrayNews.json');
            return $response->toArray();
        });
        return $news;
    }

    public function findAllCategories(): array
    {
        $categories = $cache->get('news_data', function (CacheItemInterface $cacheItem) use ($httpClient){
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET', 'https://raw.githubusercontent.com/JonasPoli/array-news/main/arrayCategoryNews.json');
            return $response->toArray();
        });
        return $categories;
    }
}