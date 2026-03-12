<?php

namespace App\Tests\Web\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserWebTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/users');

        $this->assertResponseIsSuccessful();
    }
}
