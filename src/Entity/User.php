<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()//ADD getRoles
    {
        return ['ROLE_ADMIN'];
    }

    public function getSalt() // ADD getSalt
    {/*NOTE 
        le getSalt était utilisé pr encoder les password mais symfony va le fr pr nous
        */
        return null;
    }

    public function eraseCredentials()//ADD eraseCredentials 
    {
        /*NOTES
        permet de supprimer des infos sensibles qui auraient été stockés dans l'entité
        */
    }

    public function serialize()//ADD serialize
    {
        /*NOTES
        cela va permettre de "sérializer" transformer notre objet en chaine
        car une requête HTTP ne contient que du texte
        */
       
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized)//ADD unserialize
    {
        /*NOTES
        permet de desérializer qui a été sérializé
        */
        
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized, ['allowed_classes'=>false]);
        
    }
}
