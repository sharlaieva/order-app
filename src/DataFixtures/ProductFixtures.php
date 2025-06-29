<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Currency;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ProductFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $productsData = [
            ['name' => 'Produkt A', 'description' => 'Popis produktu A', 'price' => '100.00'],
            ['name' => 'Produkt B', 'description' => 'Popis produktu B', 'price' => '200.00'],
            ['name' => 'Produkt C', 'description' => 'Popis produktu C', 'price' => '300.00'],
        ];

        $currency = new Currency();
        $currency->setCode('CZK');
        $currency->setName('Czech Koruna');
        $manager->persist($currency);
        
        foreach ($productsData as $key => $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setDescription($data['description']);
            $product->setPrice($data['price']);
            $product->setCurrency($currency);
            
            $manager->persist($product);
            $this->addReference('product_' . $key, $product);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['products'];
    }
}