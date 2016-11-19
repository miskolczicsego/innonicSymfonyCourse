<?php

namespace Blog\AdminBundle\Controller;

use Blog\ModelBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Post controller.
 *
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     * @return array
     *
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ModelBundle:Post')->findAll();

        return $this->render('@Admin/post/index.html.twig', array('posts' => $posts,));
    }

    /**
     * Creates a new post entity.
     *
     * @param Request
     * @return Response
     *
     * @Route("/new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('Blog\ModelBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush($post);

            return $this->redirectToRoute('blog_admin_post_show', array('id' => $post->getId()));
        }

        return $this->render('@Admin/post/new.html.twig', array('post' => $post, 'form' => $form->createView(),));
    }

    /**
     * Finds and displays a post entity.
     *
     * @param Post $post
     * @return array
     *
     * @Route("/{id}")
     * @Method("GET")
     */
    public function showAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('@Admin/post/show.html.twig', array('post' => $post, 'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing post entity.
     *
     * @param Request $request
     * @param Post $post
     *
     * @return Response
     *
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('Blog\ModelBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_admin_post_edit', array('id' => $post->getId()));
        }

        return $this->render('AdminBundle:post:edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()));
    }

    /**
     * Deletes a post entity.
     *
     * @param Request $request
     * @param Post $post
     *
     * @return Response
     *
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush($post);
        }

        return $this->redirectToRoute('blog_admin_post_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()->setAction($this->generateUrl('blog_admin_post_delete', array('id' => $post->getId())
        ))->setMethod('DELETE')->getForm();
    }
}
