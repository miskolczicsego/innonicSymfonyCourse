<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 04.
 * Time: 9:29
 */

namespace Blog\CoreBundle\Services;

use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Form\CommentType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostManager
{
    private $em;
    private $formFactory;

    public function __construct(EntityManager $em, FormFactory $formFactory)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
    }

    /**
     * @return array|Post[]
     */
    public function getAllPosts()
    {
        $posts = $this->em->getRepository('ModelBundle:Post')->findAll();

        return $posts;
    }

    /**
     * @param $num
     * @return array
     */
    public function getLatestPosts($num)
    {
        $latestPosts = $this->em->getRepository('ModelBundle:Post')->findLatest($num);

        return $latestPosts;
    }

    /**
     * @param string $slug
     * @return Post|object
     *
     * @throws NotFoundHttpException
     */
    public function findBySlug($slug)
    {
        $post = $this->em->getRepository('ModelBundle:Post')->findOneBy(
            array('slug' => $slug)
        );

        if (null === $post) {
            throw new NotFoundHttpException('Post not found');
        }

        return $post;
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return bool|\Symfony\Component\Form\FormInterface
     */
    public function createComment(Post $post, Request $request)
    {
        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->formFactory->create(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->em->persist($comment);
            $this->em->flush();
            return true;
        }
        return $form;
    }
}