<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EmpBundle\Entity\JobList;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint;

/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\AccessorOrder("custom", custom = {"id", "username", "email", "mobile"})
 *
 */
class User extends BaseUser
{
    const ROLE_USER = 'ROLE_USER';

    /**
     *
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     *
     *
     * @ORM\Column(name="mobile", type="bigint", unique=true)
     */
    protected $mobile;


    /**
     * @var string The username of the author.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all","users_summary"})
     */
    protected $username;

    /**
     * @var string The email of the user.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\Groups({"users_all","users_summary"})
     */
    protected $email;

    /**
     * @var string Plain password. Used for model validation. Must not be persisted.
     */
    protected $plainPassword;

    /**
     * @var boolean Shows that the user is enabled
     */
    protected $enabled;

    /**
     * @var array Array, role(s) of the user
     */
    protected $roles;

    /**
     * @ORM\ManyToMany(targetEntity="EmpBundle\Entity\JobList", mappedBy="userApplied", cascade={"persist"})
     */
    private $jobApplied;

   public function __construct()
    {
        parent::__construct();
        $this->jobApplied = new ArrayCollection();

    }

    /**
     * @param JobList $jobList
     * @return $this
     */
    public function addJobApplied(JobList $jobList){
       $this->jobApplied[] = $jobList;

       return $this;
    }

    /**
     * @param JobList $jobList
     * @return $this
     */
    public function removeJobApplied(JobList $jobList){
       $this->jobApplied->removeElement($jobList);

       return $this;
    }

    /**
     * @return ArrayCollection
     *
     */
    public function getJobApplied(){
       return $this->jobApplied;
    }


    /**
     *
     */
    function jsonSerialize()
    {
        return [
            'id'       => $this->id,
            'username' => $this->username,

            'mobile'    => $this->mobile
        ];
    }



    /**
     * Set mobile
     *
     * @param integer $mobile
     *
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return integer
     */
    public function getMobile()
    {
        return $this->mobile;
    }
}
