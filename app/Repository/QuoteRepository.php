<?php

// File: app/Repositories/QuoteRepository.php

namespace App\Repositories;

use Faker\Factory;
use App\Models\Quote;
use DateTime;
use App\Traits\SingletonTrait;

class QuoteRepository implements Repository
{
    use SingletonTrait;

    /**
     * Get a quote by ID.
     *
     * @param int $id
     * @return Quote
     */
    public function getById($id)
    {
        $faker = Factory::create();
        $faker->seed($id);

        return new Quote(
            [
            'id'=>$id,
            'site_id'=>$faker->numberBetween(1, 10),
            'destination_id'=>$faker->numberBetween(1, 200),
            'date_quoted'=>new DateTime()]
        );
    }
}
