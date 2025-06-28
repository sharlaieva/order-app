<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Currency;

class OrderFixture extends Fixture
{
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
    }
}
