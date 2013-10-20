<?php

namespace Overlord\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */      
    private $id;
    
    /**
     * @ORM\Column(type="string", length=250)
     */
    private $title;
    
    /**
     * @ORM\ManyToOne(targetEntity="project", inversedBy="task")
     */
    private $project;
    
    /**
     * @ORM\ManyToOne(targetEntity="task", inversedBy="subTasks")
     */
    private $parent;
    
    /**
     * @ORM\OneToMany(targetEntity="task", mappedBy="parent")
     */
    private $subTasks;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->subTasks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Task
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set project
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\project $project
     * @return Task
     */
    public function setProject(\Overlord\Bundle\CoreBundle\Entity\project $project = null)
    {
        $this->project = $project;
    
        return $this;
    }

    /**
     * Get project
     *
     * @return \Overlord\Bundle\CoreBundle\Entity\project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set parent
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\task $parent
     * @return Task
     */
    public function setParent(\Overlord\Bundle\CoreBundle\Entity\task $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Overlord\Bundle\CoreBundle\Entity\task 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add subTasks
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\task $subTasks
     * @return Task
     */
    public function addSubTask(\Overlord\Bundle\CoreBundle\Entity\task $subTasks)
    {
        $this->subTasks[] = $subTasks;
    
        return $this;
    }

    /**
     * Remove subTasks
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\task $subTasks
     */
    public function removeSubTask(\Overlord\Bundle\CoreBundle\Entity\task $subTasks)
    {
        $this->subTasks->removeElement($subTasks);
    }

    /**
     * Get subTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubTasks()
    {
        return $this->subTasks;
    }
}