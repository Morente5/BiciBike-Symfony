<?php

namespace BiciBikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orderbike")
 */
class OrderBike {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    /*private $price;*/  // TO-DO

    
    /**
     * @ORM\ManyToOne(targetEntity="Bike")
     * @ORM\JoinColumn(name="bike_id", referencedColumnName="id")
     */
    private $bike;
    
    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="orderlines")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    public function __construct() {
      $this->date = new \DateTime();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return OrderBike
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return OrderBike
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set bike
     *
     * @param \BiciBikeBundle\Entity\Bike $bike
     *
     * @return OrderBike
     */
    public function setBike(\BiciBikeBundle\Entity\Bike $bike = null)
    {
        $this->bike = $bike;

        return $this;
    }

    /**
     * Get bike
     *
     * @return \BiciBikeBundle\Entity\Bike
     */
    public function getBike()
    {
        return $this->bike;
    }

    /**
     * Set order
     *
     * @param \BiciBikeBundle\Entity\Order $order
     *
     * @return OrderBike
     */
    public function setOrder(\BiciBikeBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \BiciBikeBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }
}
