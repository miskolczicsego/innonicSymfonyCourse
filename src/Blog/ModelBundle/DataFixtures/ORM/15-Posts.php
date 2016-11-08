<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Post entity
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();

        $p1->setTitle('Lorem ipsum dolor set amet');
        $p1->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra interdum tellus non ullamcorper. Nullam eget metus et justo posuere commodo. Sed urna libero, consequat a interdum non, pulvinar non ligula. Proin tristique eu tortor sit amet facilisis. Sed eu tellus nec magna mollis aliquam in a massa. Nunc vel dictum elit, at feugiat ex. Donec dignissim maximus lectus non luctus. Donec egestas accumsan tincidunt. Ut quis urna sapien. Ut ut mattis mi. Ut molestie ultrices tristique. Cras euismod non leo eget consectetur. Donec purus magna, aliquet eget ex sed, suscipit elementum neque. Nunc interdum dictum odio, eu scelerisque augue consectetur ac.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at nisl justo. Aenean quis mi sed eros fringilla pulvinar in in nisi. Donec nec sem feugiat, blandit neque quis, pretium risus. Sed accumsan, justo a lacinia pretium, urna arcu ullamcorper odio, vel accumsan eros eros eget diam. In luctus erat in volutpat gravida. Nam sollicitudin at nibh id feugiat. Donec a lacinia leo. Maecenas ac odio quis sapien porta consequat. Nunc non ipsum vel ipsum porttitor malesuada. Sed dictum urna vitae quam fermentum faucibus. Maecenas at enim in sem pellentesque vehicula in sit amet lacus. In id nisl ante.

Donec id vehicula nulla, convallis mattis ante. Quisque nec elit et tellus sollicitudin luctus. Cras egestas congue purus, venenatis varius erat faucibus a. Aenean vulputate porta mi, vel tincidunt enim pharetra ac. Suspendisse tempor ligula eget ornare ullamcorper. Vivamus pulvinar tincidunt tincidunt. Nam id sem non dolor commodo interdum. Suspendisse eu ex sollicitudin, vestibulum justo eu, tempor mauris. Integer eleifend velit a sagittis blandit. Cras at enim sed tortor sodales laoreet sit amet dignissim sem. Sed et nulla urna. Integer vitae tortor vel odio finibus vestibulum. Integer molestie ex eget pellentesque hendrerit.');

        $p1->setAuthor($this->getAuthor($manager, 'David'));

        $p2 = new Post();
        $p2->setTitle('Lorem ipsum dolor set amet');
        $p2->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra interdum tellus non ullamcorper. Nullam eget metus et justo posuere commodo. Sed urna libero, consequat a interdum non, pulvinar non ligula. Proin tristique eu tortor sit amet facilisis. Sed eu tellus nec magna mollis aliquam in a massa. Nunc vel dictum elit, at feugiat ex. Donec dignissim maximus lectus non luctus. Donec egestas accumsan tincidunt. Ut quis urna sapien. Ut ut mattis mi. Ut molestie ultrices tristique. Cras euismod non leo eget consectetur. Donec purus magna, aliquet eget ex sed, suscipit elementum neque. Nunc interdum dictum odio, eu scelerisque augue consectetur ac.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at nisl justo. Aenean quis mi sed eros fringilla pulvinar in in nisi. Donec nec sem feugiat, blandit neque quis, pretium risus. Sed accumsan, justo a lacinia pretium, urna arcu ullamcorper odio, vel accumsan eros eros eget diam. In luctus erat in volutpat gravida. Nam sollicitudin at nibh id feugiat. Donec a lacinia leo. Maecenas ac odio quis sapien porta consequat. Nunc non ipsum vel ipsum porttitor malesuada. Sed dictum urna vitae quam fermentum faucibus. Maecenas at enim in sem pellentesque vehicula in sit amet lacus. In id nisl ante.

Donec id vehicula nulla, convallis mattis ante. Quisque nec elit et tellus sollicitudin luctus. Cras egestas congue purus, venenatis varius erat faucibus a. Aenean vulputate porta mi, vel tincidunt enim pharetra ac. Suspendisse tempor ligula eget ornare ullamcorper. Vivamus pulvinar tincidunt tincidunt. Nam id sem non dolor commodo interdum. Suspendisse eu ex sollicitudin, vestibulum justo eu, tempor mauris. Integer eleifend velit a sagittis blandit. Cras at enim sed tortor sodales laoreet sit amet dignissim sem. Sed et nulla urna. Integer vitae tortor vel odio finibus vestibulum. Integer molestie ex eget pellentesque hendrerit.');

        $p2->setAuthor($this->getAuthor($manager, 'Eddie'));

        $p3 = new Post();
        $p3->setTitle('Lorem ipsum dolor set amet');
        $p3->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque viverra interdum tellus non ullamcorper. Nullam eget metus et justo posuere commodo. Sed urna libero, consequat a interdum non, pulvinar non ligula. Proin tristique eu tortor sit amet facilisis. Sed eu tellus nec magna mollis aliquam in a massa. Nunc vel dictum elit, at feugiat ex. Donec dignissim maximus lectus non luctus. Donec egestas accumsan tincidunt. Ut quis urna sapien. Ut ut mattis mi. Ut molestie ultrices tristique. Cras euismod non leo eget consectetur. Donec purus magna, aliquet eget ex sed, suscipit elementum neque. Nunc interdum dictum odio, eu scelerisque augue consectetur ac.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at nisl justo. Aenean quis mi sed eros fringilla pulvinar in in nisi. Donec nec sem feugiat, blandit neque quis, pretium risus. Sed accumsan, justo a lacinia pretium, urna arcu ullamcorper odio, vel accumsan eros eros eget diam. In luctus erat in volutpat gravida. Nam sollicitudin at nibh id feugiat. Donec a lacinia leo. Maecenas ac odio quis sapien porta consequat. Nunc non ipsum vel ipsum porttitor malesuada. Sed dictum urna vitae quam fermentum faucibus. Maecenas at enim in sem pellentesque vehicula in sit amet lacus. In id nisl ante.

Donec id vehicula nulla, convallis mattis ante. Quisque nec elit et tellus sollicitudin luctus. Cras egestas congue purus, venenatis varius erat faucibus a. Aenean vulputate porta mi, vel tincidunt enim pharetra ac. Suspendisse tempor ligula eget ornare ullamcorper. Vivamus pulvinar tincidunt tincidunt. Nam id sem non dolor commodo interdum. Suspendisse eu ex sollicitudin, vestibulum justo eu, tempor mauris. Integer eleifend velit a sagittis blandit. Cras at enim sed tortor sodales laoreet sit amet dignissim sem. Sed et nulla urna. Integer vitae tortor vel odio finibus vestibulum. Integer molestie ex eget pellentesque hendrerit.');

        $p3->setAuthor($this->getAuthor($manager, 'Eddie'));


        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getOrder()
    {
        return 15;
    }


    /**
     * Get an author
     *
     * @param ObjectManager $manager
     * @param string $name
     *
     * @return Author
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