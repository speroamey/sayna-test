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

    private function computeText($text, array $data)
    {
        $quote = isset($data['quote']) && $data['quote'] instanceof Quote ? $data['quote'] : null;
        // $user = isset($data['user']) && $data['user'] instanceof User ? $data['user'] : null;
        if ($quote) {
            $_quoteFromRepository = QuoteRepository::getInstance()->getById($quote->id);
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->destination_id);
            // dd($destinationOfQuote);
            // Check if placeholders related to summary exist in the text
            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary = strpos($text, '[quote:summary]');

            if ($containsSummaryHtml !== false || $containsSummary !== false) {
                // Replace summary-related placeholders if they exist in the text
                if ($containsSummaryHtml !== false) {
                    $text = str_replace(
                        '[quote:summary_html]',
                        Quote::renderHtml($_quoteFromRepository),
                        $text
                    );
                }
                if ($containsSummary !== false) {
                    $text = str_replace(
                        '[quote:summary]',
                        Quote::renderText($_quoteFromRepository),
                        $text
                    );
                }
            }

            // Replace destination-related placeholders
            if (strpos($text, '[quote:destination_link]') !== false) {
                $text = str_replace('[quote:destination_link]', $this->getQuoteDestinationLink($quote), $text);
            }
            if (strpos($text, '[quote:destination_name]') !== false) {
                $text = str_replace('[quote:destination_name]', $destinationOfQuote->country_name, $text);
            }
        }

        $text = $this->replaceUserPlaceholders($text, $data);

        return $text;
    }



}
