<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\Type\ShopType;
use AppBundle\Entity\Shop;


class ShopController extends Controller
{
  /**
  * @Route("/rest/shop/get")
  * @Method("POST")
  */
  public function getShopAction()
  {
    $manager = $this->get('shop_manager');
    $res = $manager->getShop($this->get('request')->getContent());
    return $res;
  }

  /**
  * @Route("/shop/get")
  * @Method("GET|POST")
  */
  public function getShopGetAction()
  {

    $shop = new Shop();

    $form = $this->createFormBuilder()
        ->add('id', 'text')
        ->add('save', 'submit')
        ->getForm();

  return $this->render('default/new.html.twig', array(
          'form' => $form->createView(),
        ));

    $manager = $this->get('shop_manager');
    $res = $manager->checkFormAndPersist($form, $this->get('request'), $shop);

    if($res != null)
    {return $res;}



  }

  /**
  * @Route("/shop/create")
  * @Method("GET|POST")
  */
  public function createShopAction()
  {

    $shop = new Shop();

    $form = $this->createForm(new ShopType(), $shop);
    $manager = $this->get('shop_manager');
    $res = $manager->checkFormAndPersist($form, $this->get('request'), $shop);

    if($res != null)
    {return $res;}

    return $this->render('default/new.html.twig', array(
      'form' => $form->createView(),
    ));

  }


  /**
  * @Route("/rest/shop/create")
  * @Method("POST")
  */
  public function apicreateShopAction()
  {
    $manager = $this->get('shop_manager');
    $res = $manager->createShop($this->get('request')->getContent());
    return $res;
  }

  /**
  * @Route("/shop/set")
  * @Method("POST")
  */
  public function setShopAction()
  {
    $manager = $this->get('shop_manager');
    $res = $manager->setShop($this->get('request')->getContent());
    return $res;
  }


}
