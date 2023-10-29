<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class FeatureBaseTestCase extends TestCase
{
    public function initCategory(): void
    {
        Artisan::call('db:seed --class=CategorySeeder');
        Artisan::call('cache:clear');
    }
}
