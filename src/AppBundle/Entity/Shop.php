<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Shop
*
* @ORM\Table()
* @ORM\Entity(repositoryClass="AppBundle\Entity\ShopRepository")
*/
class Shop
{
  /**
  * @var integer
  *
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;

  /**
  * @var string
  *
  * @ORM\Column(name="name", type="string", length=400)
  */
  private $name;

  /**
  * @var string
  *
  * @ORM\Column(name="address", type="string", length=400)
  */
  private $address;


  /**
  * Get id
  *
  * @return integer
  */
  public function getId()
  {
    return $this->id;
  }

  /**
  * Set name
  *
  * @param string $name
  * @return Shop
  */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
  * Get name
  *
  * @return string
  */
  public function getName()
  {
    return $this->name;
  }

  /**
  * Set address
  *
  * @param string $address
  * @return Shop
  */
  public function setAddress($address)
  {
    $this->address = $address;

    return $this;
  }

  /**
  * Get address
  *
  * @return string
  */
  public function getAddress()
  {
    return $this->address;
  }

  public function jsonSerialize($id=false)
  {
    $array = array();
    if($id)
    {$array["id"] = $this->id;}

    $array["name"] = $this->name;
    $array["address"] = $this->address;
    return $array;

  }

}
