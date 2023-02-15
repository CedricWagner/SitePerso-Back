<?php

namespace App\Controller\Admin;

use App\Entity\Experience;
use App\Entity\Hobby;
use App\Entity\Lang;
use App\Entity\ProfileInformation;
use App\Entity\Skill;
use App\Entity\SkillGroup;
use App\Entity\TextBlock;
use App\Entity\Training;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        /** @var AdminUrlGenerator */
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(TextBlockCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Interface');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Languages', 'fas fa-language', Lang::class);
        yield MenuItem::linkToCrud('Blocks', 'fa-regular fa-file-lines', TextBlock::class);
        yield MenuItem::linkToCrud('Experiences', 'fa-solid fa-signal', Experience::class);
        yield MenuItem::linkToCrud('Skill groups', 'fa-regular fa-file-code', SkillGroup::class);
        yield MenuItem::linkToCrud('Skills', 'fa-solid fa-code', Skill::class);
        yield MenuItem::linkToCrud('Trainings', 'fa-solid fa-trophy', Training::class);
        yield MenuItem::linkToCrud('Hobbies', 'fa-solid fa-heart', Hobby::class);
        yield MenuItem::linkToCrud('Profile information', 'fa-solid fa-circle-info', ProfileInformation::class);
    }
}
