<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string|null getTitle()
 * @method static string|null getKeywords()
 * @method static string|null getDescription()
 * @method static \App\Services\Seo\MetaDataAccessor setTitle(string $title)
 * @method static \App\Services\Seo\MetaDataAccessor setKeywords(string $keywords)
 * @method static \App\Services\Seo\MetaDataAccessor setDescription(string $description)
 *
 * @see \App\Services\Seo\MetaDataAccessor
 *
 **/
class MetaData extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'seo.metadata';
    }
}
