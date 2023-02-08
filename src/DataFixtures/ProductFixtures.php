<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit in ante aliquam maximus. Duis urna nisl, venenatis sit amet placerat sit amet, vestibulum eu ligula. Morbi quis sagittis urna. Phasellus euismod vitae libero quis blandit. Donec semper accumsan odio quis ornare. In et lobortis ex. In cursus, arcu hendrerit ultricies pretium, mi purus laoreet nunc, ac cursus erat ex vitae lectus. Aliquam a libero sit amet eros luctus aliquam. Curabitur euismod ultricies ante, eget pharetra nibh commodo ac.

        Sed urna sem, egestas a egestas nec, tincidunt in nibh. Ut auctor lorem nulla, vitae aliquet nibh fermentum et. Vivamus pretium, mi eu faucibus tincidunt, mi odio pretium ex, non maximus purus velit sed nisl. In sapien lorem, iaculis et sodales quis, consectetur vel diam. Aliquam sagittis, nisi sit amet accumsan faucibus, mauris enim commodo turpis, at porta sapien quam eu eros. Praesent felis tortor, vulputate ut gravida sit amet, consequat pulvinar quam. Aliquam at odio porta, maximus ex at, cursus elit. Fusce est nisl, tristique nec euismod non, facilisis a sapien. Morbi in elit lectus. Etiam non arcu leo. Integer bibendum eu ligula ut aliquam. Maecenas suscipit risus et ultricies laoreet. Curabitur sed tincidunt massa, in vehicula sapien. Vivamus nibh massa, consequat at lacus ac, bibendum rhoncus odio.";

        for ($i=0; $i < 10; $i++) {
            $product = new Product();
            $product->setName("Item ".$i."")
            ->setDescription($description)
            ->setPrice(rand(10.00, 100.00))
            ->setCode("00000".$i."");

            $manager->persist($product);
        }

        $manager->flush();
    }
}
