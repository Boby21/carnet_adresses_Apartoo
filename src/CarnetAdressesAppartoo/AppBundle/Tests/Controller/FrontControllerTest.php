<?php

namespace CarnetAdressesAppartoo\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class FrontControllerTest extends WebTestCase {
	
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
    }

}