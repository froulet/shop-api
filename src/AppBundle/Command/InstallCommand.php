<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class InstallCommand extends ContainerAwareCommand {

    protected function configure()
    {

        $this->setName("shop:install")
             ->setDescription("Display the fibonacci numbers between 2 given numbers");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

      $manager = $this->getContainer()->get('shop_manager');
      $manager->addShop("The Bubbles Company at Paris", "53 rue du cocher 7008 Paris");
      $manager->addShop("Epicerie", "11, rue du Général");
      $manager->addShop("Supermarché", "91, rue de la Mare aux Carats");
      $manager->addShop("Leclerc", "97, rue de Penthièvre");
      $manager->addShop("Jean-Monnet", "99, rue Goya");
      $manager->addShop("Montague Josseaume", "18, avenue de l'Amandier");
      $manager->addShop("Rabican Abril", "49, rue Beauvau");
      $manager->addShop("Arridano Mouet", "67, rue Reine Elisabeth");

      echo "OK";
  }
}
