<?php

namespace BiciBikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;  // To hold a collection one to many

/**
 * @ORM\Entity
 * @ORM\Table(name="order")
 */
class Order {
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
    /*private $totalprice;*/  // Not sure if necessary

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="OrderBike", mappedBy="order")
     */
    private $orderlines;

    public function __construct() {
        $this->orderlines = new ArrayCollection();
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
     * @return Order
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
     * @return Order
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
     * Set user
     *
     * @param \BiciBikeBundle\Entity\User $user
     *
     * @return Order
     */
    public function setUser(\BiciBikeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BiciBikeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add orderline
     *
     * @param \BiciBikeBundle\Entity\OrderBike $orderline
     *
     * @return Order
     */
    public function addOrderline(\BiciBikeBundle\Entity\OrderBike $orderline)
    {
        $this->orderlines[] = $orderline;

        return $this;
    }

    /**
     * Remove orderline
     *
     * @param \BiciBikeBundle\Entity\OrderBike $orderline
     */
    public function removeOrderline(\BiciBikeBundle\Entity\OrderBike $orderline)
    {
        $this->orderlines->removeElement($orderline);
    }

    /**
     * Get orderlines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderlines()
    {
        return $this->orderlines;
    }
}
