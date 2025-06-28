<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $statuses = [
            'Nová',
            'Zpracovává se',
            'Zaplacena',
            'Odeslána',
            'Doručena',
            'Zrušena'
        ];
        foreach ($statuses as $statusName) {
            $status = new OrderStatus($statusName);
            $manager->persist($status);
        }

        $manager->flush();
    }
}