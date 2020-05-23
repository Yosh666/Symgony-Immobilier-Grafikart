<?php

namespace App\Entity;

use App\Repository\PropertySearchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PropertySearchRepository::class)
 */
class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice; 
    /**
     * 
     * @var int|null
     *  @Assert\GreaterThan(
     *  value=8,
     * message="On ne vend pas de cellule de prison")
     * @Assert\LessThan(
     *  value=400,
     * message="Pour les chateaux faut aller sur l'agence à Jérémie")
    */   
    private $minSurface;
        /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *@var ArrayCollection 
     */
    private $options;
    
    public function __construct()
    {
        $this->options= new ArrayCollection();
    }



    /**
     * Get the value of minSurface
     */ 
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @return  self
     */ 
    public function setMinSurface($minSurface):PropertySearch
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get the value of maxPrice
     *
     * @return  int|null
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @param  int|null  $maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice):PropertySearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get *@var ArrayCollection
     */ 
    public function getOptions():ArrayCollection
    {
        return $this->options;
    }

    /**
     * Set *@var ArrayCollection
     *
     * @return  self
     */ 
    public function setOptions( ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }
}
