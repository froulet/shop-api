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

  public function __construct( $em)
  {
    $this->em = $em;
  }

  public function getShop($content)
  {

    $json = $this->parseJson($content);
    $shop = $this->getShopById($json["id"]);
    $this->checkShop($shop);
    $response = $this->getJsonResponse($shop->jsonSerialize());
    return $response;
  }

  public function createShop($content)
  {

    $json = $this->parseJson($content);
    $shop = $this->addShop($json["name"], $json["address"]);
    $response = $this->getJsonResponse($shop->jsonSerialize(true));
    return $response;
  }

  public function setShop($content)
  {

    $json = $this->parseJson($content);
    $oldshop = $this->getShopById($json["id"], true);
    $updatedshop = $this->updateShop($oldshop,$json["name"], $json["address"]);
    $response = $this->getJsonResponse($updatedshop->jsonSerialize(true));
    return $response;
  }

  public function checkAttributesLength($name, $address)
  {
    if(strlen($name) < 3 || strlen($address) < 3 )
    { throw new \Exception('Name or Address too short !');}
  }

  public function checkShop($shop, $set=false)
  {
    //[SAFEGUARD]
    if($shop){return;}
    //403
    if($set){throw new AccessDeniedHttpException("");}
    //Autrement, 404
    throw new NotFoundHttpException("Page not found");
  }

  public function getShopById($id, $set=false)
  {
    $repository = $this->em->getRepository('AppBundle:Shop');
    //Récupération du shop
    $shop = $repository->findOneById($id);
    //On valide son existence
    $this->checkShop($shop,$set);
    return $shop;
  }

  public function parseJson($content)
  {
    $json = json_decode($content, true);
    return $json;
  }

  public function getJsonResponse($data)
  {
    return new Response(
    json_encode($data,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
    200,
    array('Content-Type' => 'application/json')
  );
}

  public function addShop($name, $address)
  {
    $this->findShopBy($name, $address);
    $shop = new Shop();
    $this->setNameAndAdress($shop, $name, $address);
    $this->persistAndFlush($shop);

    return $shop;
  }

  public function updateShop($shop, $name, $address)
  {
    $this->checkAttributesLength($name, $address);
    $this->setNameAndAdress($shop, $name, $address);
    $this->persistAndFlush($shop);
    return $shop;
  }

  public function setNameAndAdress($shop, $name, $address)
  {
    $shop->setName($name);
    $shop->setAddress($address);
    return $shop;
  }

  public function findShopBy($name, $address)
  {
    $repository = $this->em->getRepository('AppBundle:Shop');
    $shop = $repository->findOneBy(
    array('name' => $name, 'address' => $address));
    if($shop){throw new \Exception('Shop already exists !');}
  }

}
