<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 11. 21.
 * Time: 19:12
 */

namespace Blog\AdminBundle\Controller;

use Blog\ModelBundle\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class TagController
 *
 * @Route("/tag")
 */
class TagController extends Controller
{

    /**
     * Lists all tags entities.
     *
     * @return array
     *
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('ModelBundle:Tag')->findAll();

        return $this->render('AdminBundle:tag:index.html.twig', array('tags' => $tags));
    }

    /**
     * Creates a new tag entity.
     *
     * @param Request
     * @return Response
     *
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('Blog\ModelBundle\Form\TagType', $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush($tag);

            return $this->redirectToRoute('blog_admin_tag_show', array('id' => $tag->getId()));
        }

        return $this->render('AdminBundle:tag:new.html.twig', array('tag' => $tag, 'form' => $form->createView(),));
    }

    /**
     * Finds and displays a tag entity.
     *
     * @param Tag $tag
     * @return array
     *
     * @Route("/{id}")
     * @Method("GET")
     */
    public function showAction(Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);

        return $this->render('AdminBundle:tag:show.html.twig', array('tag' => $tag, 'delete_form' => $deleteForm->createView
        ()));
    }

    /**
     * Displays a form to edit an existing tag entity.
     *
     * @param Request $request
     * @param Tag $tag
     *
     * @return Response
     *
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);
        $editForm = $this->createForm('Blog\ModelBundle\Form\TagType', $tag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_admin_tag_edit', array('id' => $tag->getId()));
        }

        return $this->render('AdminBundle:tag:edit.html.twig', array('tag' => $tag, 'edit_form' =>
            $editForm->createView(),
            'delete_form' => $deleteForm->createView()));
    }

    /**
     * Deletes a tag entity.
     *
     * @param Request $request
     * @param Tag $tag
     *
     * @return Response
     *
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tag $tag)
    {
        $form = $this->createDeleteForm($tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush($tag);
        }

        return $this->redirectToRoute('blog_admin_tag_index');
    }

    /**
     * Creates a form to delete a tag entity.
     *
     * @param Tag $tag The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tag $tag)
    {
        return $this->createFormBuilder()->setAction($this->generateUrl('blog_admin_tag_delete', array('id' =>
            $tag->getId())))->setMethod('DELETE')->getForm();
    }
}
