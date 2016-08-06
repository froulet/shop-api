<?php

//src/AppBundle/Controller/ShopController.php
namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ShopController extends Controller
{
    /**
     * @Route("/shop/get")
     * @Method("POST")
     */
    public function getShopAction()
    {
      $manager = $this->get('shop_manager');
      $res = $manager->getShop($this->get('request')->getContent());
      return $res;
    }

    /**
     * @Route("/shop/create")
     * @Method("POST")
     */
    public function createShopAction()
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
