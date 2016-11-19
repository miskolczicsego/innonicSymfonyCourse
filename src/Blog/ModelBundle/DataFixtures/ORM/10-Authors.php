<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 11. 05.
 * Time: 23:20
 */

namespace Blog\ModelBundle\DataFixtures\ORM;


use Blog\ModelBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the author entity
 */
class Authors extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $a1 = new Author();
        $a1->setName('David');

        $a2 = new Author();
        $a2->setName('Eddie');

        $a3 = new Author();
        $a3->setName('Elsa');


        $manager->persist($a1);
        $manager->persist($a2);
        $manager->persist($a3);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }
}