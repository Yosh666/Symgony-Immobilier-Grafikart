<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;
use App\Repository\PropertyRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 * @UniqueEntity("title")//ADD UniqueEntity
 */
class Property
{
    const HEAT=[
        0=> 'Electrique',
        1=>'Gaz'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(//BUG ne marque pas les messages
     *      min = 2,
     *      max = 100,
     *      minMessage = "faut au moins écrire {{ limit }} lettre",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false)
     */
    private $title;//ADD @Assert

    /**
     * @ORM\Column(type="text", nullable=true)
     *  
     * 
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 8,
     *      max = 400,
     *      minMessage = "On ne vend pas de cellule de prison",
     *      maxMessage = "Pour les chateaux faut aller sur l'agence à Jérémie")//BUG le message n'apparait pas
     */
    private $surface;//ADD @Assert

    /**
     * @ORM\Column(type="integer")
     */
    private $room;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $bedroom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]{5}$/")
     * 
     */
    private $postal_code;//ADD regex @Assert

    /**
     * @ORM\Column(type="boolean",options={"default":"false"})
     */
    private $sold=false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    public function __construct(){
        $this->created_at = new \DateTime();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    public function getSlug(): string //ADD slug méthode
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRoom(): ?int
    {
        return $this->room;
    }

    public function setRoom(int $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getBedroom(): ?int
    {
        return $this->bedroom;
    }

    public function setBedroom(?int $bedroom): self
    {
        $this->bedroom = $bedroom;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self 
    
    {
        $this->price = $price;

        return $this;
    }
    public function getFormattedPrice():string //ADD format prix
    {
        return  number_format($this->price,0,'',' ');
    }
    

    

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(?int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }
    public function getHeatType():string{ //ADD chauffage
        return self::HEAT[$this->heat];
    }

    public function getCity(): ?string 
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
