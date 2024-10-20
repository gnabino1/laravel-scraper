<?php
namespace App\Services\Scraping;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler;
use App\Interfaces\Scraping\ScraperInterface;
use Carbon\Carbon;

class LinkedInScraper implements ScraperInterface
{
    protected $browser;
    protected $client;

    public function __construct()
    {	
    	$this->client=new Client();
    }

    public function scrapeData()
    {	
    	$jobs=[];
    	// try{
    		// if(!$this->login()){
	        // 	return $jobs;
	        // }
	        $tryNextPage=0;
			do{
	        $searchUrl = "https://linkedin.com/jobs-guest/jobs/api/seeMoreJobPostings/search?keywords=developer&start=0";
	        sleep(4);
	        $response = $this->client->get($searchUrl, [
                'headers' => [
                    'User-Agent' => 'Your User Agent Here',
                ],
            ]);
             if ($response->getStatusCode() !== 200) {
             	\Log::error('Error while retrieving');
             }
            $htmlContent = $response->getBody()->getContents();
	        $crawler = new Crawler($htmlContent);
	        $elements=$crawler->filter('li');
			$jobs = $crawler->filter('li')->each(function (Crawler $node) {
	            return [
	                'title' => $node->filter('h3.base-search-card__title')->text(),
	                'company' => $node->filter('h4.base-search-card__subtitle a')->text(),
	                'location' => $node->filter('span.job-search-card__location')->text(),
	                'link' => $node->filter('a.base-card__full-link')->attr('href'),
	                'position'=>'',
	                'job_type'=>'',
	                'created_at'=>''
	            ];
	        });
	        }while($tryNextPage==1);
	    // } catch (RequestException $e) {
            
     //    }
        return $jobs;
    }

    public function login()
    {	
    	$email=env('LINKEDIN_EMAIL');
    	$password=env('LINKEDIN_PASSWORD');
    	sleep(2);
        $crawler = $this->browser->request('GET', 'https://www.linkedin.com/login');
		$csrfToken = $crawler->filter('input[name="csrfToken"]')->attr('value');
        $loginCsrfParam = $crawler->filter('input[name="loginCsrfParam"]')->attr('value');
        $this->browser->submitForm('Sign in', [
            'session_key' => $email,
            'session_password' => $password,
            'csrfToken' => $csrfToken,
            'loginCsrfParam' => $loginCsrfParam,
        ]);
        $content = $this->browser->getResponse()->getContent();
		return true;
    }
}