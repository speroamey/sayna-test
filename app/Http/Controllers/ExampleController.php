<?php
namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Quote;
use App\Models\User;
use App\Repositories\DestinationRepository;
use App\Repositories\QuoteRepository;
use App\Repositories\SiteRepository;
use App\Services\TemplateManagerService;
use Illuminate\Http\Request;
use App\Repositories\TemplateRepository;

class ExampleController extends Controller
{
    protected $templateManagerService;

    public function __construct(
        QuoteRepository $quoteRepository,
        DestinationRepository $destinationRepository,
        SiteRepository $siteRepository
    ) {
        $this->templateManagerService = new TemplateManagerService(
            $quoteRepository,
            $destinationRepository,
            $siteRepository
        );
    }

    public function index()
    {
        $faker = \Faker\Factory::create();

        $template = new Template([
            'id' => 1,
            'subject' => 'Your delivery to [quote:destination_name]',
            'content' => "
                Hi [user:first_name],
                Thanks for contacting us to deliver to [quote:destination_name].
                Regards,

                SAYNA team
            "
        ]);
        $quoteData = ['id' =>1,'site_id' => $faker ->randomNumber(), 'destination_id' => $faker->randomNumber(), 'date_quoted' => $faker->date() ];
        $userData = ['id' =>1,'firstname' => $faker->userName(),'firstname' => $faker->lastName()];
        $message =  $this->templateManagerService->getTemplateComputed(
            $template,
            [
                'quote' => new Quote($quoteData),
                'user'  => new User($userData)
            ]
        );

        return response()->json([
            'subject' => $message->subject,
            'content' => $message->content
        ]);
    }
}

