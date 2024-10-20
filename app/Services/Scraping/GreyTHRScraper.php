<?php
namespace App\Services\Scraping;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use App\Interfaces\Scraping\ScraperInterface;
use Carbon\Carbon;

class GreyTHRScraper implements ScraperInterface
{
    public function scrapeData()
    {
        $jobs=[];
        $tryNextPage=0;
        $offset=0;
        $page=0;
        $pageSize=100;
		do{
			$client = HttpClient::create([
    		'headers' => [
		    	'User-Agent' => '*',
		    	'Referer' => 'https://www.greythr.com'
			]
		]);
			$browser = new HttpBrowser($client);
			$cookieJar = $browser->getCookieJar();
			// sleep(2);
			// $crawler=$browser->request('GET','https://www.greythr.com/company/careers/');
			$crawler = $browser->request('GET', 'https://greythr.sensehq.com/careers/_next/data/TK7ycRVL4gYo4TPJyu687/jobs.json?page='.$page.'&pageSize='.$pageSize.'&department=&location=&title=&sortBy=id&orderBy=DESC&minExp=0&maxExp=100&jobType=&workplaceType=&isIframe=true');
			$response = $browser->getResponse();
			$jsonContent = $response->getContent();
			$response = json_decode($jsonContent, true);
			if(array_key_exists('pageProps', $response)){
				$allData=$response['pageProps'];
				if(array_key_exists('jobsData', $allData)){
					$jobsData=$allData['jobsData'];
					if(array_key_exists('rows',$jobsData)){
						$jobsDataCount=$jobsData['count'];
						if($jobsDataCount > 0){
							$jobsDatarows=$jobsData['rows'];
							// get this value from DB before starting crawling to check where the maximum value of the identifier column has been reached
							$firstJobData=$jobsDatarows[0];
							$id=53262; // get this value from identifier column DB
							if($firstJobData['id'] <= $id){
								break;
								//exit the loop
							}else{
								//update max identifier value to DB
							}
							$offset=($page+1)*$pageSize;
							if($jobsDataCount > $offset){
								$tryNextPage=1;
								$page=$page+1;
							}
							foreach($jobsDatarows as $jobData){
								$scappedJob['title']=$jobData['title'];
								$scappedJob['position']=$jobData['department'];
								$scappedJob['company']=$jobData['organization_id'];
								$scappedJob['location']=$jobData['location'];
								$scappedJob['job_type']=$jobData['job_type'];
								$scappedJob['created_at']=Carbon::createFromTimestamp($jobData['created_on']/1000)->format('Y-m-d H:i:s');
								//check if Job Already Exists in DB or Cache Mem
								array_push($jobs, $scappedJob);
							}
						}
						
					}
					
				}
			}	
        }while($tryNextPage==1);
         return $jobs;
    }
}