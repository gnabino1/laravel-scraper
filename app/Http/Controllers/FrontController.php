<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Scraping\ScraperFactory;

class FrontController extends Controller
{
    public function index(Request $request){
    	// $source = 'greythr'; // get from request if needed for now this is static
	    $source='linkedin';
	    // Dynamically get the correct scraper as per source
        $scraper = ScraperFactory::make($source);
        $data['jobs'] = $scraper->scrapeData();
        //check the data and call job(laravel Job) after certain time
    	return view('homepage.index',$data);
    }
}
