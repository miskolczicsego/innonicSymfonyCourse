<?php

namespace Blog\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AuthorController
 * @package Blog\CoreBundle\Controller
 */
class AuthorController extends Controller
{
    /**
     * Show posts by author
     *
     * @Route("/author/{slug}")
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Template()
     */
    public function showAction($slug)
    {
        $author = $this->getDoctrine()->getRepository('ModelBundle:Author')->findOneBy(
            array(
                'slug' => $slug
            )
        );

        if (null === $author) {
            throw $this->createNotFoundException('author was not found');
        }

        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findBy(
            array(
                'author' => $author
            )
        );

        return array(
            'author' => $author,
            'posts' => $posts
        );
    }

}
