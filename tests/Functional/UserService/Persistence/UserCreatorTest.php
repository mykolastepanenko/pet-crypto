<?php

namespace App\Tests\Functional\UserService\Persistence;

use App\DataFixtures\UserFixture;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserCreatorTest extends KernelTestCase
{
    private AbstractDatabaseTool $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();

        $databaseToolCollection = static::getContainer()->get(DatabaseToolCollection::class);
        $this->databaseTool = $databaseToolCollection->get();
    }

    public function testFactory(): void
    {
        self::bootKernel();
        $this->databaseTool->loadFixtures([UserFixture::class]);

        $userRepository = static::getContainer()->get(UserRepository::class);

        $this->assertSame(10000, $userRepository->count());
    }
}
