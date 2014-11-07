<?php

namespace Budget\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Income
 *
 * @ORM\Table(name="income")
 * @ORM\Entity
 */
class Income
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
     * @ORM\Column(name="amount", type="decimal")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_income", type="date")
     */
    private $dateIncome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity="Budget\UserBundle\Entity\User", inversedBy="incomes")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     * 
     */
    private $createBy;
    
    /**
     *
     * @var CategoryIncome
     *      
     * @ORM\ManyToOne(targetEntity="CategoryIncome", inversedBy="incomes")
     * 
     */
    private $categoryIncome;


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
     * Set amount
     *
     * @param string $amount
     * @return Income
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Income
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateIncome
     *
     * @param \DateTime $dateIncome
     * @return Income
     */
    public function setDateIncome($dateIncome)
    {
        $this->dateIncome = $dateIncome;

        return $this;
    }

    /**
     * Get dateIncome
     *
     * @return \DateTime 
     */
    public function getDateIncome()
    {
        return $this->dateIncome;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return Income
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime 
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set createBy
     *
     * @param string $createBy
     * @return Income
     */
    public function setCreateBy($createBy)
    {
        $this->createBy = $createBy;

        return $this;
    }

    /**
     * Get createBy
     *
     * @return string 
     */
    public function getCreateBy()
    {
        return $this->createBy;
    }

    /**
     * Set categoryIncome
     *
     * @param \Budget\PlanBundle\Entity\CategoryIncome $categoryIncome
     * @return Income
     */
    public function setCategoryIncome(\Budget\PlanBundle\Entity\CategoryIncome $categoryIncome = null)
    {
        $this->categoryIncome = $categoryIncome;

        return $this;
    }

    /**
     * Get categoryIncome
     *
     * @return \Budget\PlanBundle\Entity\CategoryIncome 
     */
    public function getCategoryIncome()
    {
        return $this->categoryIncome;
    }
}
