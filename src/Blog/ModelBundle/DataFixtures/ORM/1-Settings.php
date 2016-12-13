<?php
namespace Blog\ModelBundle\DataFixtures\ORM;
use Blog\ModelBundle\Entity\Config;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Class Configurations
 * @package Blog\ModelBundle\DataFixtures\ORM
 */
class Configurations extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $setting = new Config();
        $setting
            ->setSetting('anonymous_comment')
            ->setValue(1);
        $manager->persist($setting);
        $manager->flush();
    }
    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}