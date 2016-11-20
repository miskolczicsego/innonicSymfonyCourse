<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 11. 19.
 * Time: 8:14
 */

namespace Blog\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class SecurityController extends Controller
{
    /**
     * Login
     *
     * @return Response
     * @Route("/login")
     */
    public function loginAction()
    {
        $request = $this->container->get('request');
        $session = $this->container->get('session');

        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        }

        return $this->render(
          'AdminBundle:Security:login.html.twig',
            array(
                'last_username' => $session->get(Security::LAST_USERNAME),
                'error' => $error
            )
        );
    }

    /**
     * Login check
     *
     * @Route("/login_check")
     */
    public function loginCheckAction()
    {

    }

    /**
     * Logout action
     *
     * @Route("logout")
     */
    public function logoutAction()
    {

    }

}