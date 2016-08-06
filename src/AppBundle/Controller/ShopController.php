<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\Type\ShopType;
use AppBundle\Form\Type\GetShopType;
use AppBundle\Form\Type\SetShopType;
use AppBundle\Entity\Shop;


class ShopController extends Controller
{


  /**
  * @Route("/shop/get/{id}")
  * @Route("/shop/get")
  * @Method("GET|POST")
  */
  public function getShopFormAction($id = null)
  {

    $shop = new Shop();

    $form = $this->createForm(new GetShopType());

    $manager = $this->get('shop_manager');
    $res = $manager->getShopByForm($form, $this->get('request'), $shop, $id);

    if($res != null)
    {return $res;}

    return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
          ));

  }

  /**
  * @Route("/shop/set")
  * @Method("GET|POST")
  */
  public function setShopFormAction()
  {

    $shop = new Shop();

    $form = $this->createForm(new SetShopType(), $shop);

    $manager = $this->get('shop_manager');
    $res = $manager->setShopByForm($form, $this->get('request'), $shop);

    if($res != null)
    {return $res;}

    return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
          ));

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
    $res = $manager->addShopByForm($form, $this->get('request'), $shop);

    if($res != null)
    {return $res;}

    return $this->render('default/new.html.twig', array(
      'form' => $form->createView(),
    ));

  }


}
