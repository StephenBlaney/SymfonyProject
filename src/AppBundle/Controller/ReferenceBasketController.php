<?php

/**
 * Created by PhpStorm.
 * User: Stephen
 * Date: 21/04/2017
 * Time: 16:29
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Basket;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Elective controller.
 *
 * @Route("/basket")
 */
class ReferenceBasketController extends Controller

{
    /**
     * @Route("/", name="reference_basket_index")
     */
    public function indexAction()
    {
        // no need to put electives array in Twig argument array - Twig can get data direct from session
        $argsArray = [
        ];
        $templateName = 'reference/index';
        return $this->render($templateName . '.html.twig', $argsArray);
    }
    /**
     * @Route("/add/{id}", name="reference_basket_add")
     */
    public function addToReferenceCart(Basket $basket)
    {
        // default - new empty array
        $baskets = [];
        // if no 'electives' array in the session, add an empty array
        $session = new Session();
        if($session->has('basket')){
            $baskets = $session->get('basket');
        }
        // get ID of elective
        $id = $basket->getId();

        // only try to add to array if not already in the array
        if(!array_key_exists($id, $baskets)){
            // append $elective to our list
            $baskets[$id] = $basket;
            // store updated array back into the session
            $session->set('basket', $baskets);
        }
        return $this->redirectToRoute('reference_basket_index');
    }
    /**
     * @Route("/clear", name="reference_basket_clear")
     */
    public function clearAction()
    {
        $session = new Session();
//        $session->clear();
        $session->remove('basket');
        return $this->redirectToRoute('reference_basket_index');
    }
    /**
     * @Route("/delete/{id}", name="reference_basket_delete")
     */
    public function deleteAction(int $id)
    {
        // default - new empty array
        $basket = [];
        // if no 'electives' array in the session, add an empty array
        $session = new Session();
        if($session->has('basket')){
            $basket = $session->get('basket');
        }
        // only try to remove if it's in the array
        if(array_key_exists($id, $basket)){
            // remove entry with $id
            unset($basket[$id]);
            if(sizeof($basket) < 1){
                return $this->redirectToRoute('reference_basket_clear');
            }
            // store updated array back into the session
            $session->set('basket', $basket);
        }
        return $this->redirectToRoute('reference_basket_index');
    }

}