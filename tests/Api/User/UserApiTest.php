<?php

namespace App\Tests\Api\User;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UserApiTest extends ApiTestCase
{
    protected static bool|null $alwaysBootKernel = false;

    public function testResponseSchema(): void
    {
        $response = static::createClient()->request('GET', '/api/users');
        $this->assertResponseIsSuccessful();

        $data = $response->toArray();

        $this->assertJson($response->getContent());
        $this->assertArrayHasKey('items', $data);
        $this->assertArrayHasKey('meta', $data);
    }
}
