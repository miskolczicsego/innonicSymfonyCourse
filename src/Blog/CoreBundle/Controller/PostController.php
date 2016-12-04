<?php

namespace Blog\CoreBundle\Controller;

use Blog\ModelBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostController
 * @package Blog\CoreBundle\Controller
 *
 * @Route("/{_locale}", requirements={"_locale"="en|hu"}, defaults={"_locale"="en"})
 */
class PostController extends Controller
{
    /**
     * Show the posts index
     *
     * @return array
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $posts = $this->getPostManager()->getAllPosts();

        $latestPosts = $this->getPostManager()->getLatestPosts(5);

        return array('posts' => $posts, 'latestPosts' => $latestPosts);
    }

    /**
     * Show post
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @param string $slug
     * @Route("/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        $post = $this->getPostManager()->findBySlug($slug);

        $form = $this->createForm(new CommentType());

        return array('post' => $post, 'form' => $form->createView());
    }

    /**
     * Create comment
     *
     * @param Request $request
     * @param string $slug
     *
     * @return mixed
     *
     * @Route("/{slug}/create-comment")
     * @Method("POST")
     * @Template("CoreBundle:Post:show.html.twig")
     */
    public function createCommentAction(Request $request, $slug)
    {
        $post = $this->getPostManager()->findBySlug($slug);

        $form = $this->getPostManager()->createComment($post, $request);

        if (true === $form) {
            $this->get('session')->getFlashBag()->add('success', 'Your comment was sudmitted successfully');

            $this->redirect(
                $this->generateUrl(
                    'blog_core_post_show',
                    array('slug' => $post->getSlug())
                )
            );
        }
        return array(
            'post' => $post,
            'form' => $form->createView()
        );
    }

    public function getPostManager()
    {
        return $this->container->get('post_manager');
    }

}
