<?php

namespace Blog\ModelBundle\DataFixtures\ORM;


use Blog\ModelBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('ModelBundle:Post')->findAll();

        $comments = array(
            0 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in nulla convallis, aliquet enim vitae, vestibulum enim. Sed 
                pellentesque quam non nunc vehicula tempus. Donec finibus feugiat leo, at congue libero auctor at. Donec velit ligula, vulputate et 
                accumsan a, aliquet ac dui. Proin fringilla ullamcorper quam at ornare. Integer sem est, feugiat eget magna ac, aliquet fermentum 
                purus. Suspendisse potenti. Phasellus vel mollis eros, ut mattis lorem. Phasellus sodales tellus sem, et feugiat felis placerat nec.',

            1 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in nulla convallis, aliquet 
                    sdsadenim vitae, vestibulum enim. Sed pellentesque quam non nunc vehicula tempus. Donec finibus feugiat 
                    leo , at congue libero auctor at. Donec velit ligula, vulputate et accumsan a, aliquet ac dui. Proin 
                    fringilla  ullamcorper quam at ornare. Integer sem est, feugiat eget magna ac, aliquet fermentum purus. 
                    ',

            2 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in nulla convallis, aliquet 
                    sdsadenim vitae, vestibulum enim. Sed pellentesque quam non nunc vehicula tempus. Donec finibus feugiat 
                    leo , at congue libero auctor at. Donec velit ligula, vulputate et accumsan a, aliquet ac dui. Proin 
                    fringilla  ullamcorper quam at ornare. Integer sem est, feugiat eget magna ac, aliquet fermentum 
                    purus.',

            3=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in nulla convallis, aliquet 
                    sdsadenim vitae, vestibulum enim. Sed pellentesque quam non nunc vehicula tempus. Donec finibus feugiat 
                    leo , at congue libero auctor at. Donec velit ligula, vulputate et accumsan a, aliquet ac dui. Proin 
                    fringilla  ullamcorper quam at ornare. Integer sem est, feugiat eget magna ac, aliquet fermentum purus.'
            );

        $i = 0;

        foreach ($posts as $post) {
            $comment = new Comment();
            $comment->setAuthorName('Someone');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);
            $comment->setUser($this->getUser($manager, 'Csegő'));
            $manager->persist($comment);
        }
        $manager->flush();
    }

    private function getUser($manager, $name)
    {
        return $manager->getRepository('ModelBundle:User')->findOneBy(
            array(
                'name' => $name
            )
        );
    }
}