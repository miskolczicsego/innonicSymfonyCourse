<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 11. 19.
 * Time: 23:02
 */

namespace Blog\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TagListerController extends Controller
{
    /**
     * Give back all tags to posts
     *
     * @Template("CoreBundle:TagLister:index.html.twig")
     * @Route("\")
     * @return array
     */

    public function indexAction()
    {
        $tags = $this->getDoctrine()->getRepository('ModelBundle:Tag')->getTagsWhichHasLeastOnePost();

        return array(
            'tags' => $tags
        );
    }

    /**
     * Show action to tags
     *
     * @param $slug
     * @return array
     *
     * @Route("/tag/{slug}")
     *
     * @throws NotFoundHttpException
     * @Template()
     */
    public function showAction($slug)
    {
        $tag = $this->getDoctrine()->getRepository('ModelBundle:Tag')->findOneBy(array(
          'slug' => $slug
        ));

        if (null === $tag) {
            throw $this->createNotFoundException('Tag was not found');
        }

        $postsToTag = $this->getDoctrine()->getRepository('ModelBundle:Post')->findPostToTag($tag);

        dump($postsToTag);
        return array(
            'tag' => $tag,
            'posts' => $postsToTag
        );
    }
}