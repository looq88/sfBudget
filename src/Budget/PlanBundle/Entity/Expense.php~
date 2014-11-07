<?php

namespace Budget\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expense
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Expense
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
     * @ORM\Column(name="dateExpense", type="date")
     */
    private $dateExpense;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity="Budget\UserBundle\Entity\User", inversedBy="expenses")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     * 
     */
    private $createBy;
    
    /**
     *
     * @var CategoryExpense
     *      
     * @ORM\ManyToOne(targetEntity="CategoryExpense", inversedBy="expenses")
     * 
     */
    private $categoryExpense;


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
     * @return Expense
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
     * @return Expense
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
     * Set dateExpense
     *
     * @param \DateTime $dateExpense
     * @return Expense
     */
    public function setDateExpense($dateExpense)
    {
        $this->dateExpense = $dateExpense;

        return $this;
    }

    /**
     * Get dateExpense
     *
     * @return \DateTime 
     */
    public function getDateExpense()
    {
        return $this->dateExpense;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     * @return Expense
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
     * @return Expense
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
     * Set categoryExpense
     *
     * @param \Budget\PlanBundle\Entity\CategoryExpense $categoryExpense
     * @return Expense
     */
    public function setCategoryExpense(\Budget\PlanBundle\Entity\CategoryExpense $categoryExpense = null)
    {
        $this->categoryExpense = $categoryExpense;

        return $this;
    }

    /**
     * Get categoryExpense
     *
     * @return \Budget\PlanBundle\Entity\CategoryExpense 
     */
    public function getCategoryExpense()
    {
        return $this->categoryExpense;
    }
}
