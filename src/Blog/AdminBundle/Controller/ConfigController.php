<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 12. 13.
 * Time: 19:21
 */

namespace Blog\AdminBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfigController
 * @package Blog\AdminBundle\Controller
 *
 * @Route("setting")
 */
class ConfigController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('@Admin/Config/index.html.twig');
    }

    /**
     * @Route("/modify")
     */
    public function modifyAction(Request $request)
    {
        $config = $this->get('configuration');
        $em = $this->getDoctrine()->getManager();
        $settings = $request->get('settings', array());
        foreach ($settings as $key => $value) {
            $setting = $config->findByKey($key);
            $setting->setValue($value);
            $em->persist($setting);
        }
        $em->flush();
        return $this->redirect(
            $this->generateUrl('blog_admin_config_index')
        );
    }
}