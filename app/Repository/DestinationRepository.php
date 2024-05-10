<?php
namespace App\Repositories;
use Faker\Factory;
use App\Models\Destination;
use App\Traits\SingletonTrait;

class DestinationRepository implements Repository
{
    use SingletonTrait;
    /**
     * Get a destination by ID.
     *
     * @param int $id
     * @return Destination
     */
    public function getById($id)
    {
        $faker = Factory::create();
        $faker->seed($id);

        return new Destination(
            [
            'id'=>$id,
            'country_name'=>$faker->country,
            'conjunction'=>'en',
            'computer_name'=>$faker->slug()]
        );
    }
}
