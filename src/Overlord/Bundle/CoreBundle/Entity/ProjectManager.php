<?php

namespace Overlord\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ProjectManager extends User
{    
    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="ProjectManager")
     */
    private $projects;
    
    public function getType() 
    {
        return 'Project Manager';
    }

 
    /**
     * Add projects
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\Project $projects
     * @return ProjectManager
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