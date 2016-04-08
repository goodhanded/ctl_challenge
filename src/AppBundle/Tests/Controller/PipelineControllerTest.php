<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PipelineControllerTest extends WebTestCase
{
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
