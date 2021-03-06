<?php

namespace Overlord\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */      
    private $id;
    
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\MaxLength(100)
     */
    private $title;
    
    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="Projects")
     */
    private $company;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProjectManager", inversedBy="Projects")
     */
    private $projectManager;
    
    /**
     * @ORM\ManyToMany(targetEntity="Worker")
     */
    private $workers;
    
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/projects';
    }
    
    /**
     * Auto Generated methods
     */
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Project
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
     * Set company
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\Company $company
     * @return Project
     */
    public function setCompany(\Overlord\Bundle\CoreBundle\Entity\Company $company = null)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return \Overlord\Bundle\CoreBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set projectManager
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\ProjectManager $projectManager
     * @return Project
     */
    public function setProjectManager(\Overlord\Bundle\CoreBundle\Entity\ProjectManager $projectManager = null)
    {
        $this->projectManager = $projectManager;
    
        return $this;
    }

    /**
     * Get projectManager
     *
     * @return \Overlord\Bundle\CoreBundle\Entity\ProjectManager 
     */
    public function getProjectManager()
    {
        return $this->projectManager;
    }

    /**
     * Add workers
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\Worker $workers
     * @return Project
     */
    public function addWorker(\Overlord\Bundle\CoreBundle\Entity\Worker $workers)
    {
        $this->workers[] = $workers;
    
        return $this;
    }

    /**
     * Remove workers
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\Worker $workers
     */
    public function removeWorker(\Overlord\Bundle\CoreBundle\Entity\Worker $workers)
    {
        $this->workers->removeElement($workers);
    }

    /**
     * Get workers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWorkers()
    {
        return $this->workers;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Project
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}