<?php

namespace Blog\CoreBundle\Controller;

use Blog\CoreBundle\Services\AuthorManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AuthorController
 * @Route("/{_locale}/author", requirements={"_locale" = "en|hu"}, defaults={"_locale"="en"})
 * @package Blog\CoreBundle\Controller
 */

class AuthorController extends Controller
{
    /**
     * Show posts by author
     *
     * @Route("/{slug}")
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Template()
     */
    public function showAction($slug)
    {
        $author = $this->getAuthorManager()->findBySlug($slug);

        $posts = $this->getAuthorManager()->findPosts($author);

        return array(
            'author' => $author,
            'posts' => $posts
        );
    }

    /**
     * @return   AuthorManager
     */

    public function getAuthorManager()
    {
        return $this->container->get('author_manager');
    }

}
