<?php

namespace Overlord\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"worker" = "Worker", "projectmanager" = "ProjectManager", "admin" = "Admin"})
 * @UniqueEntity("email")
 * @UniqueEntity(fields={"screenName", "company"})
 */
abstract class User implements \Symfony\Component\Security\Core\User\UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */  
    protected $id;
    
    /**
     * @ORM\Column(name="screenName", type="string", length=100)
     */
    protected $screenName;
    
        /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="Users")
     */
    protected $company;
    
    /**
     * @ORM\Column(type="string", length=100, name="password")
     * @Assert\NotBlank()
     */
    protected $password;
    
    /**
     * @ORM\Column(type="string", length=255, name="email")
     * @Assert\Email
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    protected $email;
    
    /**
     *
     * @ORM\Column(type="string", length=100, name="salt")
     */
    protected $salt;
    
    /**
     *
     * @ORM\Column(type="boolean")
     */
    protected $deleted = false;
    
    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }
    
    public abstract function getType();
    
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
     * Set screenName
     *
     * @param string $screenName
     * @return User
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;
    
        return $this;
    }

    /**
     * Get screenName
     *
     * @return string 
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set company
     *
     * @param \Overlord\Bundle\CoreBundle\Entity\Company $company
     * @return User
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Get salt
     *
     * @return string 
     */    
    public function getSalt()
    {
        return $this->salt;
    }
    
    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */    
    public function setSalt($salt)
    {
        $this->salt = $salt;
        
        return $this;
    }
    
    public function eraseCredentials() 
    {
        
    }
    
    public function serialize()
    {
        return serialize(array($this->id, $this->email));
    }

    public function unserialize($data) 
    {
        list($this->id, $this->email) = unserialize($data);
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return User
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}