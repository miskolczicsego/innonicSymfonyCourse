<?php
namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 11. 22.
 * Time: 20:35
 */

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{

    /**
     * Redirection
     *
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('blog_admin_post_index'));
    }
}