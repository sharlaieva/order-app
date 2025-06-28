<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderStatusFixtures extends Fixture
{
    public const STATUS_NEW = 'Nová';
    public const STATUS_PROCESSING = 'Zpracovává se';
    public const STATUS_PAID = 'Zaplaceno';
    public const STATUS_SHIPPED = 'Odesláno';
    public const STATUS_DELIVERED = 'Doručeno';
    public const STATUS_CANCELLED = 'Zrušeno';

    public function load(ObjectManager $manager): void
    {
       $statuses = [
            self::STATUS_NEW,
            self::STATUS_PROCESSING,
            self::STATUS_PAID,
            self::STATUS_SHIPPED,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED
        ];
        foreach ($statuses as $statusName) {
            $status = new OrderStatus($statusName);
            $manager->persist($status);

            $this->addReference($statusName, $status);
        }

        $manager->flush();
    }
}