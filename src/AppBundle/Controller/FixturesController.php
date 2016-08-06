<?php

//src/AppBundle/Controller/ShopController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Shop;
class FixturesController extends Controller
{
    /**
     * @Route("/install")
     */
    public function fixturesAction()
    {

      $manager = $this->get('shop_manager');
      $manager->addShop("The Bubbles Company at Paris", "53 rue du cocher 7008 Paris");
      $manager->addShop("Epicerie", "11, rue du Général");
      $manager->addShop("Supermarché", "91, rue de la Mare aux Carats");
      $manager->addShop("Leclerc", "97, rue de Penthièvre");
      $manager->addShop("Jean-Monnet", "99, rue Goya");
      $manager->addShop("Montague Josseaume", "18, avenue de l'Amandier");
      $manager->addShop("Rabican Abril", "49, rue Beauvau");
      $manager->addShop("Arridano Mouet", "67, rue Reine Elisabeth");

      return new Response(
    '<html><body>Fixtures importées.</body></html>'
    );

    }

}
