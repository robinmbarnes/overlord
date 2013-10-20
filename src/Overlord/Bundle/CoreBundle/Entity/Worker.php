<?php

namespace Overlord\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Worker extends User
{    
    /**
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="Workers")
     */
    private $projects;
    
    public function getType() 
    {
        return 'Worker';
    }

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add projects
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\Project $projects
     * @return Worker
     */
    public function addProject(\Overlord\Bundle\CoreBundle\Entity\Project $projects)
    {
        $this->projects[] = $projects;
    
        return $this;
    }

    /**
     * Remove projects
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\Project $projects
     */
    public function removeProject(\Overlord\Bundle\CoreBundle\Entity\Project $projects)
    {
        $this->projects->removeElement($projects);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProjects()
    {
        return $this->projects;
    }
}