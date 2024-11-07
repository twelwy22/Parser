<?php
// coded by bloom
// download project in https://github.com/twelwy22/Parser
// open terminal and write -> composer require symfony/dom-crawler guzzlehttp/guzzle symfony/css-selector

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


function getPageContent($url) {
    $client = new Client();
    $response = $client->get($url, [
        'verify' => false  
    ]);
    return (string) $response->getBody();
}



function parseContent($html) {
    $crawler = new Crawler($html);

   
    $title = $crawler->filterXPath('//title')->text();

    
    $description = $crawler->filterXPath('//meta[@name="description"]')->attr('content');

    
    $h1Tags = $crawler->filterXPath('//h1')->each(function (Crawler $node) {
        return $node->text();
    });

    return [
        'title' => $title,
        'description' => $description,
        'h1' => $h1Tags
    ];
}


$url = '1'; # enter your url
$htmlContent = getPageContent($url);
$parsedData = parseContent($htmlContent);

echo "Title: " . $parsedData['title'] . "\n";
echo "Description: " . $parsedData['description'] . "\n";
echo "H1 Tags: \n";
foreach ($parsedData['h1'] as $h1) {
    echo "- " . $h1 . "\n";
}
