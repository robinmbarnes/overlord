<?php

namespace Overlord\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Admin extends User
{    
    public function getType() 
    {
        return 'Admin';
    }
}