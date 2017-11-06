<?php

namespace MS\GestionBibliothequeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    public function testFind()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/find');
    }

}
