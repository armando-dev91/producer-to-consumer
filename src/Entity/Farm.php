<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Farm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $description;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Producer", inversedBy="farm")
     */
    private Producer $producer;

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of producer
     */ 
    public function getProducer(): Producer
    {
        return $this->producer;
    }

    /**
     * Set the value of producer
     *
     * @return  self
     */ 
    public function setProducer(Producer $producer)
    {
        $this->producer = $producer;

        return $this;
    }
}