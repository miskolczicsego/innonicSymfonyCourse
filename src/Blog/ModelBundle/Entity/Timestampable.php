<?php
/**
 * Created by PhpStorm.
 * User: Csegő
 * Date: 2016. 11. 05.
 * Time: 18:15
 */

namespace Blog\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timestampable abstract class to define create behavior
 *
 * @ORM\MappedSuperclass
 * @package Blog\ModelBundle\Entity
 */
abstract class Timestampable
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    public function __construct()
    {
        $this->createAt = new \DateTime();
    }

    /**
     * Set createAt
     *
     * @param $createAt
     * @return $this
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
}
