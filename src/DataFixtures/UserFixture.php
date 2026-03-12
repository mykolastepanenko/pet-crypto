<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixture extends Fixture
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

//        $this->default();
//        $this->factory();
        $this->sql();
    }

    private function sql(): void
    {
        $start = time();
        $conn = $this->manager->getConnection();
        $faker = Factory::create();

        $batchSize = 5000;
        $total = 10000000;

        for ($i = 0; $i < $total; $i += $batchSize) {
            $values = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $values[] = sprintf("('%s', %s)", str_replace("'", '', $faker->name()), $faker->numberBetween(18, 100));
            }

            $sql = "INSERT INTO user (name, age) VALUES " . implode(',', $values);
            $conn->executeStatement($sql);
        }
        dump(time() - $start);
    }

    private function factory(): void
    {
        $count = 10000;
        $i = 0;
        $batch = 5000;
        while ($i < $count) {
            UserFactory::new()->many($batch)->create();
            $i += $batch;
        }
    }

    private function default(): void
    {
        $faker = Factory::create();
        $user = new User()
            ->setName($faker->name)
            ->setAge($faker->numberBetween(18, $max = 99));
        $this->manager->persist($user);

        $this->manager->flush();
    }
}
