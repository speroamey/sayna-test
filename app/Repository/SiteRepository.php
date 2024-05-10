<?php
// File: app/Repositories/SiteRepository.php

namespace App\Repositories;

use Faker\Factory;
use App\Models\Site;
use App\Traits\SingletonTrait;

class SiteRepository implements Repository
{
    use SingletonTrait;

    /**
     * Get a site by ID.
     *
     * @param int $id
     * @return Site
     */
    public function getById($id)
    {
        $faker = Factory::create();
        $faker->seed($id);

        return new Site(['id'=>$id, 'url'=>$faker->url]);
    }
}

