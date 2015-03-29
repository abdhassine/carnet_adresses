<?php

namespace CarnetAdresses\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
    }

    public function testSubscribe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/subscribe');
    }

}
