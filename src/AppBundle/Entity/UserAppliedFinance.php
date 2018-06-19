<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAppliedFinance
 *
 * @ORM\Table(name="user_applied_finance")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserAppliedFinanceRepository")
 *  @ORM\HasLifecycleCallbacks()
 */
class UserAppliedFinance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="finApplied")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;



    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\FinList", inversedBy="userApplied")
     * @ORM\JoinColumn(name="f_plan_id", referencedColumnName="id", onDelete="cascade")
     */
    private $fPlan;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime('now');
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->modified = new \DateTime('now');
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getFPlan()
    {
        return $this->fPlan;
    }

    /**
     * @param mixed $fPlan
     */
    public function setFPlan($fPlan)
    {
        $this->fPlan = $fPlan;
    }
}
