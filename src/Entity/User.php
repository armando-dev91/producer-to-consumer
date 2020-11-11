<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"consumer"= "Consumer", "producer"= "Producer"})
 */
abstract class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Email
     * @Assert\NotNull
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotNull
     */
    private ?string $firstname;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotNull
     */
    private ?string $lastname;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private ?string $password;

    /**
     * @Assert\NotNull
     * @Assert\Length(min=6)
     */
    private ?string $plainPassword;

    
    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of plainPassword
     */ 
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return  self
     */ 
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }
    
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
        $this->plainPassword = "";
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }
}