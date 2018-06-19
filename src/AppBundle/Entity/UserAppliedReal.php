<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAppliedReal
 *
 * @ORM\Table(name="user_applied_real")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserAppliedRealRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class UserAppliedReal
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="realApplied")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="EmpBundle\Entity\ReList", inversedBy="realApplied")
     * @ORM\JoinColumn(name="reality_id", referencedColumnName="id", onDelete="cascade")
     */
    private $reality;


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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getReality()
    {
        return $this->reality;
    }

    /**
     * @param mixed $reality
     */
    public function setReality($reality)
    {
        $this->reality = $reality;
    }


}
