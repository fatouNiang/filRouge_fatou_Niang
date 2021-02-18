<?php

namespace App\Tests\TestFonctionel;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\BrowserKit\AbstractBrowser;
use App\AppFixtures;

 
class ProfilTest extends WebTestCase
{
     private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

  public function Testprofils_all()
    {
        $this->client=$this->createAuthenticatedClient("bayer.carlotta","pass_1234");
        $this->client->request('GET','/api/admin/profils');
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());


    }
    //  public function testgetOneProfilSortie()
    // {
    //     $this->client=$this->createAuthenticatedClient("admin1","passe123");
    //     $this->client->request('GET','/api/admin/profilSorties/1');
    //     $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    
    // }
    // public function testAddProfilSortie()
    // {
    //     $this->client=$this->createAuthenticatedClient("admin3","passe123");
    //     $this->client->request(
    //         'POST',
    //         '/api/admin/profilSortie',
    //         [],
    //         [],
    //         ['CONTENT_TYPE' => 'application/json'],
    //         '{
    //            "libele": "libelle1"
    //          }'
    //     );
    //     $responseContent = $this->client->getResponse();
    //     $this->assertEquals(Response::HTTP_OK,$responseContent->getStatusCode());


    // }

    protected function createAuthenticatedClient(string $username, string $password)
    {
        $info=["username"=>$username, "password"=>$password];
        $this->client->request('POST','/api/login',[],[],
        ['CONTENT_TYPE'=>'application/json'],json_decode($info)
    );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $data = \json_decode($this->client->getResponse()->getContent(), true);
        $this->client->setServerParameter('HTTP_Authorization', \sprintf('Bearer %s', $data['token']));
        $this->client->setServerParameter('CONTENT_TYPE', 'application/json');

        return $this->client;
    }
    
}
