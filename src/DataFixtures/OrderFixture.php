<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Currency;
use App\Entity\OrderStatus;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class OrderFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            OrderStatusFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $currency = new Currency();
        $currency->setCode('CZK');
        $currency->setName('Czech Koruna');
        $manager->persist($currency);

        $order = new Order();
        $order->setOrderId('ORD-'.uniqid());
        $order->setName('Test order');
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setAmount(1500);
        $order->setStatus($this->getReference(OrderStatusFixtures::STATUS_DELIVERED, OrderStatus::class));
        $order->setCurrency($currency);

        $item1 = new OrderItem();
        $item1->setProductName('Product 1');
        $item1->setUnitPrice(1000);
        $item1->setQuantity(1);
        $item1->setOrder($order);
        $manager->persist($item1);

        $item2 = new OrderItem();
        $item2->setProductName('Product 2');
        $item2->setUnitPrice(500);
        $item2->setQuantity(2);
        $item2->setOrder($order);
        $manager->persist($item2);

        $manager->persist($order);
        $manager->flush();

        for ($i = 1; $i <= 3; $i++) {
            $order = new Order();
            $order->setOrderId('ORD-' . uniqid());
            $order->setName('Test order ' . $i);
            $order->setCreatedAt(new \DateTimeImmutable());
            $order->setAmount(1000 + $i * 500);
            $order->setStatus($this->getReference(OrderStatusFixtures::STATUS_NEW, OrderStatus::class));
            $order->setCurrency($currency);

            $item = new OrderItem();
            $item->setProductName('Product ' . ($i + 2));
            $item->setUnitPrice(500 * $i);
            $item->setQuantity($i);
            $item->setOrder($order);
            $manager->persist($item);

            $manager->persist($order);
        }
        $manager->flush();
    }
}
