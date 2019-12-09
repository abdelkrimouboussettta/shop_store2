<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */

class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=50, minMessage = "Votre username doit aoir plus de 2 caractères")            
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=50, minMessage = "le login doit être plus de 2 caractères")            
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=6, max=20, minMessage = "votre passe word doit avoir plus de 5 caractères")            
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassWord(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    
          /**
           * eraseCredentials
           * @return void
           */
          public function eraseCredentials()
          {
              
          }
      
      
          /**
           * getSalt
           *
           * @return string | null
           */
          public function getSalt()
          {
              return null;
      
          }
      
          
      	/** @see \Serializable::serialize() */
          public function serialize()
          {
              return serialize([
                  $this->id,
                  $this->username,
                  $this->password,
                  // see section on salt below
                  // $this->salt,
              ]);
          }
      
       
          /**
           * unserialize
           * @param  mixed $serialized
           * @return void
           */
          public function unserialize($serialized)
          {
              list (
                  $this->id,
                  $this->username,
                  $this->password,
                  // see section on salt below
                  // $this->salt
              ) = unserialize($serialized, ['allowed_classes' => false]);
          }
}

