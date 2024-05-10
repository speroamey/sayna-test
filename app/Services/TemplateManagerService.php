<?php

namespace App\Services;

use App\Models\Quote;
use App\Models\Template;
use App\Repositories\QuoteRepository;
use App\Repositories\DestinationRepository;
use App\Repositories\SiteRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TemplateManagerService
{
    protected $quoteRepository;
    protected $destinationRepository;
    protected $siteRepository;

    public function __construct(
        QuoteRepository $quoteRepository,
        DestinationRepository $destinationRepository,
        SiteRepository $siteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->destinationRepository = $destinationRepository;
        $this->siteRepository = $siteRepository;
    }


    public function getTemplateComputed(Template $tpl, array $data)
    {
        if (!$tpl) {
            throw new \RuntimeException('no tpl given');
        }
        // $text = $tpl->content;
        $replaced = clone $tpl;
        // Compute the text for both subject and content properties
        $replaced->subject = $this->computeText($replaced->subject, $data);
        $replaced->content = $this->computeText($replaced->content, $data);
        return $replaced;
    }


}
