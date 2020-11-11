<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Producer extends User
{
    
    public function getRoles(): array
    {
        return ['ROLE_PRODUCER'];
    }
    
}