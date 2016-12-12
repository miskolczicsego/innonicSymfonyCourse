<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 12.
 * Time: 19:45
 */

namespace Blog\CoreBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('blog_core_post_index'));
    }
}