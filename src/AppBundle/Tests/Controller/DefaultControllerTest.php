<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testTrack()
    {
    	$client = static::createClient();
        $this->statusCheck($client, 'GET', '/tracker/bananas/3/up', 200);
        $this->statusCheck($client, 'GET', '/tracker/kiwi/3/down', 200);
        $this->statusCheck($client, 'GET', '/tracker/bananas/3/left', 404);
        $this->statusCheck($client, 'GET', '/tracker/bananas/invalid/up', 404);
        $this->statusCheck($client, 'POST', '/tracker/bananas/3/up', 200);
        $this->statusCheck($client, 'POST', '/tracker/kiwi/3/down', 200);
        $this->statusCheck($client, 'POST', '/tracker/bananas/3/left', 404);
        $this->statusCheck($client, 'POST', '/tracker/bananas/invalid/up', 404);    
    }

    /**
     * Check the return status of a request.
     */ 
    private function statusCheck($client, $method, $path, $expectedStatus)
    {
    	$crawler = $client->request($method, $path);
        $this->assertEquals($expectedStatus, $client->getResponse()->getStatusCode());
    }
}
