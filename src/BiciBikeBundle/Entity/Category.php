<?php

namespace BiciBikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;  // To hold a collection one to many

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Bike", mappedBy="category")
     */
    private $bikes;

    public function __construct() {
        $this->bikes = new ArrayCollection();
    }

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
     *
     * @return Category
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
     * Add bike
     *
     * @param \BiciBikeBundle\Entity\Bike $bike
     *
     * @return Category
     */
    public function addBike(\BiciBikeBundle\Entity\Bike $bike)
    {
        $this->bikes[] = $bike;

        return $this;
    }

    /**
     * Remove bike
     *
     * @param \BiciBikeBundle\Entity\Bike $bike
     */
    public function removeBike(\BiciBikeBundle\Entity\Bike $bike)
    {
        $this->bikes->removeElement($bike);
    }

    /**
     * Get bikes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBikes()
    {
        return $this->bikes;
    }
}
