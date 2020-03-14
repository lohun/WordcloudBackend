<?php 
namespace App\Tools;

use Goutte\Client;

class WebScraper{
    private $url;

    public function __construct($url = null) {
        $this->load($url);
    }

    public function load($url)
    {
        $this->url = $url;
    }

    public function webScraper()
    {
            $url = $this->url;
            $client = new Client();
            $crawler =  $client->request('GET', $url);
            $content = $crawler->filter('title')->each(function ($node) {
                return $node->text();
            });
            $data = [];

            $data = array_merge($data, $content);
    
            $content = $crawler->filter('p')->each(function ($node) {
                return $node->text();
            });
            $data = array_merge($data, $content);
            
            $content = $crawler->filter('h1')->each(function ($node) {
                return $node->text();
            });
            $data = array_merge($data, $content);
            
            $content = $crawler->filter('h2')->each(function ($node) {
                return $node->text();
            });
            $data = array_merge($data, $content);
            
            $content = $crawler->filter('h3')->each(function ($node) {
                return $node->text();
            });
            $data = array_merge($data, $content);
            
            $content = $crawler->filter('h4')->each(function ($node) {
                return $node->text();
            });
            $data = array_merge($data, $content);
            
            $content = $crawler->filter('h5')->each(function ($node) {
                return $node->text();
            });
            $data = array_merge($data, $content);
            return $data;
        }
}