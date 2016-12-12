<?php

namespace Blog\AdminBundle\Controller;

use Blog\ModelBundle\Entity\Author;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Author CRUD controller
 *
 * @Route("/author")
 */
class AuthorController extends Controller
{
    /**
     * Lists all author entities.
     *
     * @return Response
     *
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $authors = $em->getRepository('ModelBundle:Author')->findAll();

        return $this->render('AdminBundle:author:index.html.twig', array('authors' => $authors,));
    }

    /**
     * Creates a new author entity.
     *
     * @param Request $request
     * @return Response
     *
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm('Blog\ModelBundle\Form\AuthorType', $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush($author);

            return $this->redirectToRoute('blog_admin_author_show', array('id' => $author->getId()));
        }

        return $this->render(
            'AdminBundle:author:new.html.twig',
            array('author' => $author, 'form' => $form->createView())
        );
    }

    /**
     * Finds and displays an author entity.
     *
     * @param Author $author
     * @return Response
     *
     * @Route("/{id}")
     * @Method("GET")
     */
    public function showAction(Author $author)
    {
        $deleteForm = $this->createDeleteForm($author);

        return $this->render(
            'AdminBundle:author:show.html.twig',
            array('author' => $author, 'delete_form' => $deleteForm->createView())
        );
    }

    /**
     * Displays a form to edit an existing author entity.
     *
     * @param Request $request
     * @param Author $author
     * @return Response
     *
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Author $author)
    {
        $deleteForm = $this->createDeleteForm($author);
        $editForm = $this->createForm('Blog\ModelBundle\Form\AuthorType', $author);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_admin_author_edit', array('id' => $author->getId()));
        }

        return $this->render(
            'AdminBundle:author:edit.html.twig',
            array('author' => $author, 'edit_form' => $editForm->createView(), 'delete_form' => $deleteForm->createView())
        );
    }

    /**
     * Deletes a author entity.
     *
     * @param Request $request
     * @param Author $author
     * @return Response
     *
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Author $author)
    {
        $form = $this->createDeleteForm($author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($author);
            $em->flush($author);
        }

        return $this->redirectToRoute('blog_admin_author_index');
    }

    /**
     * Creates a form to delete a author entity.
     *
     * @param Author $author The author entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Author $author)
    {
        return $this->createFormBuilder()->setAction(
            $this->generateUrl('blog_admin_author_delete', array('id' => $author->getId()))
        )->setMethod('DELETE')->getForm();
    }

    public function __toString()
    {
        return 'My string version of UserCategory'; // if you have a name property you can do $this->getName();
    }
}
