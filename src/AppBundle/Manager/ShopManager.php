<?php


namespace AppBundle\Manager;
use AppBundle\Manager\BaseManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use AppBundle\Entity\Shop;

class ShopManager extends BaseManager
{

  protected $em;

  public function __construct( $em, $container)
  {
    $this->em = $em;
    $this->container = $container;
  }

  public function addShopByForm($form, $request, $shop)
  {
    $form->handleRequest($request);
    if (!$form->isValid())
    {return null;}

    $this->findShopBy($shop->getName(), $shop->getAddress());
    $this->persistAndFlush($shop);
    return $this->getJsonResponse($shop->jsonSerialize());

  }

  public function getShopByForm($form, $request, $shop)
  {
    $form->handleRequest($request);
    if (!$form->isValid())
    {return null;}
    
    $shop = $this->getShopById($form["id"]->getData());

    return $this->getJsonResponse($shop->jsonSerialize());

  }


  public function checkForm($form)
  {
    if (!$form->isValid())
    {return null;}
  }

  /**
  * Retourne un shop au format JSON
  *
  *
  * @param  	Symfony request object
  * @return 	HTTP Json Response
  */
  public function getShop($content)
  {

    $json = $this->parseJson($content);
    $shop = $this->getShopById($json["id"]);
    $this->checkShop($shop);
    $response = $this->getJsonResponse($shop->jsonSerialize());
    return $response;
  }

  /**
  * Crée un nouveau shop et le renvoie au format JSON
  *
  *
  * @param  	Symfony request object
  * @return 	HTTP Json Response
  */
  public function createShop($content)
  {

    $json = $this->parseJson($content);
    $shop = $this->addShop($json["name"], $json["address"]);
    $response = $this->getJsonResponse($shop->jsonSerialize(true));
    return $response;
  }

  /**
  * Mise à jour d'un shop et le renvoyer au format JSON
  *
  *
  * @param  	Symfony request object
  * @return 	HTTP Json Response
  */
  public function setShop($content)
  {

    $json = $this->parseJson($content);
    $oldshop = $this->getShopById($json["id"], true);
    $updatedshop = $this->updateShop($oldshop,$json["name"], $json["address"]);
    $response = $this->getJsonResponse($updatedshop->jsonSerialize(true));
    return $response;
  }


  /**
  * Vérifie l'existence d'un Shop
  *
  *
  * @param  	Objet Shop, boolean optionnal
  * @return 	nothing
  */
  public function checkShop($shop, $set=false)
  {
    //[SAFEGUARD]
    if($shop){return;}
    //403
    if($set){throw new AccessDeniedHttpException("");}
    //Autrement, 404
    throw new NotFoundHttpException("Page not found");
  }

  /**
  * Récupère un shop par son Id
  *
  *
  * @param  	id du shop, boolean optionnal
  * @return 	Objet shop
  */
  public function getShopById($id, $set=false)
  {
    $repository = $this->em->getRepository('AppBundle:Shop');
    //Récupération du shop
    $shop = $repository->findOneById($id);
    //On valide son existence
    $this->checkShop($shop,$set);
    return $shop;
  }

  /**
  * Décode une string en JSON
  *
  *
  * @param  	string JSON
  * @return 	array
  */
  public function parseJson($content)
  {
    $json = json_decode($content, true);
    return $json;
  }

  /**
  * Crée l'objet JSON de Symfony en l'encodant en JSON
  *
  *
  * @param  	array des data
  * @return 	objet Response
  */
  public function getJsonResponse($data)
  {
    return new Response(
    json_encode($data,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    200,
    array('Content-Type' => 'application/json')
  );
}

/**
* Ajouter un shop dans la database
*
*
* @param  	nom, adresse
* @return 	objet Shop nouvellement crée
*/
public function addShop($name, $address)
{
  $this->findShopBy($name, $address);
  $shop = new Shop();
  $this->setNameAndAdress($shop, $name, $address);
  $this->persistAndFlush($shop);

  return $shop;
}

/**
* Mise à jour d'un shop dans la database
*
*
* @param  	Objet shop, nom, adresse
* @return 	Objet shop mis à jour
*/
public function updateShop($shop, $name, $address)
{
  $this->checkAttributesLength($name, $address);
  $this->setNameAndAdress($shop, $name, $address);
  $this->persistAndFlush($shop);
  return $shop;
}


/**
* Fonction helper permettant de mettre à jour les champs address et name dans l'objet shop
*
*
* @param  	Objet shop, nom, adresse
* @return 	Objet shop mis à jour
*/
public function setNameAndAdress($shop, $name, $address)
{
  $shop->setName($name);
  $shop->setAddress($address);
  return $shop;
}

/**
* Vérifier si un objet shop de par son nom et son adresse, n'existe pas déjà
*
*
* @param  	nom, adresse
*/
public function findShopBy($name, $address)
{
  $repository = $this->em->getRepository('AppBundle:Shop');
  $shop = $repository->findOneBy(
  array('name' => $name, 'address' => $address));
  if($shop){throw new \Exception('Shop already exists !');}
}

/**
* Vérifie la taille des attributs nom et addresse
*
*
* @param  	nom, adresse
*/
public function checkAttributesLength($name, $address)
{
  if(strlen($name) < 3 || strlen($address) < 3 )
  { throw new \Exception('Name or Address too short !');}
}

}
