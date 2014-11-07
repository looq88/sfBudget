<?php

namespace Budget\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryIncome
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CategoryIncome
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Income", mappedBy="categoryIncome")
     */
    private $incomes;  
    
    
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
     * Set name
     *
     * @param string $name
     * @return CategoryIncome
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->incomes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add incomes
     *
     * @param \Budget\PlanBundle\Entity\Income $incomes
     * @return CategoryIncome
     */
    public function addIncome(\Budget\PlanBundle\Entity\Income $incomes)
    {
        $this->incomes[] = $incomes;

        return $this;
    }

    /**
     * Remove incomes
     *
     * @param \Budget\PlanBundle\Entity\Income $incomes
     */
    public function removeIncome(\Budget\PlanBundle\Entity\Income $incomes)
    {
        $this->incomes->removeElement($incomes);
    }

    /**
     * Get incomes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIncomes()
    {
        return $this->incomes;
    }
}
