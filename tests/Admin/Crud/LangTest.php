<?php

namespace App\Tests\Admin\Crud;

use App\Repository\LangRepository;
use App\Tests\AbstractFunctionalTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LangTest extends AbstractFunctionalTest
{
    public function testDisplayPage(): void
    {
        $this->logIn();
        $this->client->request('GET', '/admin?crudAction=index&crudControllerFqcn=App%5CController%5CAdmin%5CLangCrudController');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Lang');
    }
}
