<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Basket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Basket controller.
 *
 * @Route("basket")
 */
class BasketController extends Controller
{
    /**
     * Lists all basket entities.
     *
     * @Route("/", name="basket_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $baskets = $em->getRepository('AppBundle:Basket')->findAll();

        return $this->render('basket/index.html.twig', array(
            'baskets' => $baskets,
        ));
    }

    /**
     * Creates a new basket entity.
     *
     * @Route("/new", name="basket_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $basket = new Basket();
        $form = $this->createForm('AppBundle\Form\BasketType', $basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($basket);
            $em->flush();

            return $this->redirectToRoute('basket_show', array('id' => $basket->getId()));
        }

        return $this->render('basket/new.html.twig', array(
            'basket' => $basket,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a basket entity.
     *
     * @Route("/{id}", name="basket_show")
     * @Method("GET")
     */
    public function showAction(Basket $basket)
    {
        $deleteForm = $this->createDeleteForm($basket);

        return $this->render('basket/show.html.twig', array(
            'basket' => $basket,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing basket entity.
     *
     * @Route("/{id}/edit", name="basket_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Basket $basket)
    {
        $deleteForm = $this->createDeleteForm($basket);
        $editForm = $this->createForm('AppBundle\Form\BasketType', $basket);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('basket_edit', array('id' => $basket->getId()));
        }

        return $this->render('basket/edit.html.twig', array(
            'basket' => $basket,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a basket entity.
     *
     * @Route("/{id}", name="basket_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Basket $basket)
    {
        $form = $this->createDeleteForm($basket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($basket);
            $em->flush();
        }

        return $this->redirectToRoute('basket_index');
    }

    /**
     * Creates a form to delete a basket entity.
     *
     * @param Basket $basket The basket entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Basket $basket)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('basket_delete', array('id' => $basket->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
