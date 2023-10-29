<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;

    public const COUCHES = 1;
    public const CHAIR = 2;
    public const DINNING = 3;

    /**
     * static methods
     */

    public static function getLists()
    {
        $cacheKey = 'catalogs';

        return Cache::rememberForever($cacheKey, function () {
            return static::select('id', 'name', 'slug', 'description')
                ->orderBy('order', 'asc')
                ->get()
            ;
        });
    }

    public static function getDefault()
    {
        $cacheKey = 'default_catalog';

        return Cache::rememberForever($cacheKey, function () {
            return static::select('id', 'name', 'slug', 'description')
                ->where('is_default', true)
                ->first()
            ;
        });
    }

    /**
     * end static methods
     */

    /**
     * relations
     */

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * end relations
     */
}
