<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Producer extends User
{
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Farm", mappedBy="producer", orphanRemoval=true, cascade="persist")
     */
    private ?Farm $farm = null;
    
    public function getRoles(): array
    {
        return ['ROLE_PRODUCER'];
    }
    
    /**
     * Get the value of farm
     */ 
    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    /**
     * Set the value of farm
     *
     * @return  self
     */ 
    public function setFarm($farm)
    {
        $this->farm = $farm;

        return $this;
    }
}