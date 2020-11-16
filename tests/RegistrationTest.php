<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class RegistrationTest extends WebTestCase
{

    public function testIfRegistrationSuccess()
    {
        $client = static::createClient();

        /** @var RouterInterface */
        $router = $client->getContainer()->get('router');
        $crawler = $client->request(Request::METHOD_GET, $router->generate('security_register'));

        $form = $crawler->filter('form[name=registration]')->form([
            'registration[email]' => 'test@email.com',
            'registration[firstname]' => 'test',
            'registration[lastname]' => 'test',
            'registration[plainPassword]' => 'password',
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();
        
        $this->assertRouteSame('app_home');
    }

    /** 
     * @dataProvider provideInvalidForm
    */
    public function testIfFormInvalid(array $data, string $errorMessage)
    {
        $client = static::createClient();

        /** @var RouterInterface */
        $router = $client->getContainer()->get('router');
        $crawler = $client->request(Request::METHOD_GET, $router->generate('security_register'));

        $form = $crawler->filter('form[name=registration]')->form($data);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        
        $this->assertSelectorTextContains('.form-error-message', $errorMessage);
    }

    public function provideInvalidForm(): iterable
    {
        yield [
            [
                'registration[email]' => 'email',
                'registration[firstname]' => 'test',
                'registration[lastname]' => 'test',
                'registration[plainPassword]' => 'password',
            ],
            'Cette valeur n\'est pas une adresse email valide.'
        ];

        yield [
            [
                'registration[email]' => 'email@email.com',
                'registration[firstname]' => 'test',
                'registration[lastname]' => 'test',
                'registration[plainPassword]' => '',
            ],
            'Cette valeur ne doit pas être nulle.'
        ];

        yield [
            [
                'registration[email]' => 'email@email.com',
                'registration[firstname]' => 'test',
                'registration[lastname]' => 'test',
                'registration[plainPassword]' => 'aaz',
            ],
            'Cette chaîne est trop courte. Elle doit avoir au minimum 6 caractères.'
        ];
    }

}