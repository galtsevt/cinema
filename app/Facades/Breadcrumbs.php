<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void add(string $name, string $url = null)
 * @method static void addList(array $items)
 * @method static array getAll()
 *
 * @see \App\Services\Seo\BreadcrumbsContainer
 *
 **/

class Breadcrumbs extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'seo.breadcrumbs';
    }
}
