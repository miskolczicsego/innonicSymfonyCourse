<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PostControllerTest
 * @package Blog\CoreBundle\Tests\Controller
 */
class PostControllerTest extends WebTestCase
{
    /**
     * Tests post index
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful');

        $this->assertCount(4, $crawler->filter('h2'), 'There should be 4 posts display');
    }

    /**
     * Test show post
     */
    public function testShow()
    {
        $client = static::createClient();

        /** @var Post $post */
        $post = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Post')->findFirst();

        $crawler = $client->request('GET', '/en/'.$post->getSlug());

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful');

        $this->assertEquals($post->getTitle(), $crawler->filter('h1')->text(), 'Invalid post title');

        $this->assertGreaterThanOrEqual(1, $crawler->filter('article.comment')->count(), 'Ther should be at least 1 
        comment');
    }

    /**
     * Test create comment
     */
    public function testCreateComment()
    {
        $client = static::createClient();

        /** @var Post $post */
        $post = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Post')->findFirst();

        $crawler = $client->request('GET', '/en'.$post->getSlug());

        $buttonCrawlerNode = $crawler->selectButton('Send');

        $form = $buttonCrawlerNode->form(array(
            'blog_modelbundle_comment[authorName]' => 'A humble commenter',
            'blog_modelbundle_comment[body]' => 'Hy this is a symfony form yeeees',

        ));

        $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect('/'.$post->getSlug()), 'Ther is no redirection after submitting the form'
        );

        $crawler = $client->followRedirect();

        $this->assertCount(1, $crawler->filter('html:contains("Your comment was submitted successful")'),
            'There was not any confirmation message'
            );


    }

}
