<?php

namespace App\Entity;

use App\Repository\PropertySearchRepository;
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
}
