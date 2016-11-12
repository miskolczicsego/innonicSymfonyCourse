<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Post entity
 */
class Tags extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $t1 = new Tag();
        $p1->setTitle('mdsamldaksd');
        $p1->setBody('léfflsédflésdf');
        $p1->setAuthor($this->getAuthor($manager, 'David'));
        $t1->setName('körte');

        $t1->addPost($p1);
        $p1->addTag($t1);

        $manager->persist($t1);
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getOrder()
    {
        return 20;
    }


    /**
     * Get a post
     *
     * @param ObjectManager $manager
     * @param int $id
     *
     * @return Post
     */
    private function getAuthor($manager, $name)
    {
        return $manager->getRepository('ModelBundle:Author')->findOneBy(
            array(
                'name' => $name
            )
        );
    }
}