<?php 
namespace App\Services\Scraping;

use InvalidArgumentException;
use App\Interfaces\Scraping\ScraperInterface;

class ScraperFactory
{
    public static function make($source): ScraperInterface
    {
        switch ($source) {
            case 'greythr':
                return new GreyTHRScraper();
            case 'linkedin':
            	return new LinkedInScraper();
            default:
                throw new InvalidArgumentException("Invalid job source provided.");
        }
    }
}