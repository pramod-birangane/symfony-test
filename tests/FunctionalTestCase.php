<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testForbidden()
    {
      $client = static::createClient();
      $client->request('GET', '/');
      $this->assertEquals(403, $client->getResponse()->getStatusCode());
      $this->assertEquals('{"response":"Forbidden"}', $client->getResponse()->getContent());
    }

    public function testInvalidJwtToken()
    {
      $client = static::createClient();
      $client->request('GET', '/api/1');
      $this->assertEquals(401, $client->getResponse()->getStatusCode());
      $this->assertEquals('{"code":401,"message":"JWT Token not found"}', $client->getResponse()->getContent());
    }

    public function testRegisterUser()
    {
      $client = static::createClient();
      $client->request('POST', '/register', ['_username' => 'pramod', '_password' => 'pramod123']);
      $this->assertEquals(200, $client->getResponse()->getStatusCode());
      $this->assertEquals('User pramod successfully created', $client->getResponse()->getContent());
    }

    public function testFetchTeamsInLeague()
    {
      $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1MzQwMjYyMzUsImV4cCI6MTUzNDAyOTgzNSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoicHJhbW9kIn0.KI0gEhKAOV9zs5NYRVlR5Ng569EWs9tH7_5KXIclE1VJPR2jIomDSFq1R2sHN4QqE2ZGniIH1zQD0eNNQCu2O3J9VpOKJzq2r6pKM9vIl3QFfEvmYk3BhbbbYj-yDTkzsRTgfLlJCAnRXCsBW4WKFf1RoBXP_Go0ZAIbFkAzxdrR_yUTql4Cti6rv9Lzr3uUqrY3Qy-qFJ2DccUWw7Yw4wvZKl6yXs-5MwV5QHkSgarG_z7REjgimp-BtlMeib_VPf54uIms8FXdb-AoEM41EKs01O-1InjcIYXaOVyzei8O4sKgSMOhmCAowmTnR65SRodoTNJ4vc7R2IgclTtHBIr3Q03eNXKXwgj42Hgkik3bcs_ZjUk_rfW0FdOqwwzD1WFv0_PBYVjvFhA7kzCxzIUg-j_-9ZZcH08_L8mEGEjL0u9g0NcCOOaaqZ-WmnEC5gAphSE3ljpiiT4fEFJj4JhK4J2t-A1qV2H69hufifSeIDvISovLXuCnnZEmPCxWSJ5P5c6IkGa7_AfgpOwmmB6ZZtrPeFmEWXLtwx_Bwtc2hUxRgWfb4Zf_3tlBD9CReafZc2gour1kAPRmKDjEqPFHTded5aIGtSggjWz0dsJrnI2tFhw7cwzqyMqVT5gPzYWNBaOHvR1wiijYsUl9Rk8hGyGe8zCVfVGfTmktx08';
      $client = static::createClient();
      $client->request('GET', '/api/1', array(),array(),array('Authorization' => ' Bearer '.$token));
      $this->assertEquals(200, $client->getResponse()->getStatusCode());
      $this->assertEquals('["team 1 1","team 1 2"]', $client->getResponse()->getContent());
    }

    public function testDeleteLeague()
    {
      $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1MzQwMjYyMzUsImV4cCI6MTUzNDAyOTgzNSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoicHJhbW9kIn0.KI0gEhKAOV9zs5NYRVlR5Ng569EWs9tH7_5KXIclE1VJPR2jIomDSFq1R2sHN4QqE2ZGniIH1zQD0eNNQCu2O3J9VpOKJzq2r6pKM9vIl3QFfEvmYk3BhbbbYj-yDTkzsRTgfLlJCAnRXCsBW4WKFf1RoBXP_Go0ZAIbFkAzxdrR_yUTql4Cti6rv9Lzr3uUqrY3Qy-qFJ2DccUWw7Yw4wvZKl6yXs-5MwV5QHkSgarG_z7REjgimp-BtlMeib_VPf54uIms8FXdb-AoEM41EKs01O-1InjcIYXaOVyzei8O4sKgSMOhmCAowmTnR65SRodoTNJ4vc7R2IgclTtHBIr3Q03eNXKXwgj42Hgkik3bcs_ZjUk_rfW0FdOqwwzD1WFv0_PBYVjvFhA7kzCxzIUg-j_-9ZZcH08_L8mEGEjL0u9g0NcCOOaaqZ-WmnEC5gAphSE3ljpiiT4fEFJj4JhK4J2t-A1qV2H69hufifSeIDvISovLXuCnnZEmPCxWSJ5P5c6IkGa7_AfgpOwmmB6ZZtrPeFmEWXLtwx_Bwtc2hUxRgWfb4Zf_3tlBD9CReafZc2gour1kAPRmKDjEqPFHTded5aIGtSggjWz0dsJrnI2tFhw7cwzqyMqVT5gPzYWNBaOHvR1wiijYsUl9Rk8hGyGe8zCVfVGfTmktx08';
      $client = static::createClient();
      $client->request('DELETE', '/api/1', array(),array(),array('Authorization' => ' Bearer '.$token));
      $this->assertEquals(200, $client->getResponse()->getStatusCode());
      $this->assertEquals('{"response":"League deleted successfully"}', $client->getResponse()->getContent());
    }

}
