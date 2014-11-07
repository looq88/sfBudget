<?php

namespace Budget\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Budget\PlanBundle\Entity\Income", mappedBy="createdBy")
     * @var ArrayCollection
     */
    private $incomes;
    
    /**
     * @ORM\OneToMany(targetEntity="Budget\PlanBundle\Entity\Expense", mappedBy="createdBy")
     * @var ArrayCollection
     */
    private $expenses;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        
    }

    
    
    
}
