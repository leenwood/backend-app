<?php

namespace App\AdminBundle\Controller\Admin;

use App\AccountBundle\Entity\Account;
use App\AdminBundle\Controller\Admin\CRUD\AccountCrudController;
use App\AdminBundle\Service\DjangoBackendService\DTO\VacancySkillStat;
use App\AdminBundle\Service\DjangoBackendService\RequestService;
use App\AdminBundle\Service\SpreedSheetService\DownloadVacanciesStatsService;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MainAdminPanelController extends AbstractDashboardController
{
    public function __construct(
         private RequestService $requestService,
        private DownloadVacanciesStatsService $downloadVacanciesStatsService
    )
    {
    }


    #[Route('/admin', name: 'admin_panel')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(AccountCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin panel')
            ->setFaviconPath(''); //TODO указать ссылку на favicon
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Symfony backend', 'fas fa-angle-double-down');
        yield MenuItem::LinkToCrud('Accounts', 'fas fa-list', Account::class);
        yield MenuItem::section('Other backend', 'fas fa-angle-double-down');
        yield MenuItem::linkToRoute("HH analytics", 'fas fa-arrow-alt-circle-right', 'admin_analytics_search_page');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    #[Route(path: '/admin/analytics/hh', name: 'admin_analytics_hh', )]
    public function analyticsFromHH(
        Request $request
    ): Response
    {
        if($request->get('queryName') === null or $request->get('queryName') === "") {
            throw new \Exception("need query Name");
        }

        $vacanciesList = $this->requestService->getVacanciesListByName($request->get('queryName'));

        return $this->render('admin\layouts\analyticsPage.html.twig',
            [
                'queryName' => $request->get('queryName'),
                'vacanciesFound' => $vacanciesList->getVacanciesFound(),
                'vacanciesStats' => $vacanciesList->getVacanciesStats(),
                'vacanciesName' => $vacanciesList->getVacanciesNames()
            ]);
    }

    #[Route(path: '/admin/analytics', name: 'admin_analytics_search_page', )]
    public function analyticsFormPageSearch(): Response
    {
        return $this->render('admin\layouts\searchPage.html.twig');
    }

    #[Route(path: '/admin/analytics/download', name: 'admin_analytics_download', )]
    public function downloadFileAnalytics(
        Request $request
    ): Response
    {
        if($request->get('queryName') === null) {
            throw new \Exception("need query Name");
        }

        $vacanciesList = $this->requestService->getVacanciesListByName($request->get('queryName'));
        $response = $this->downloadVacanciesStatsService->get("HH", $vacanciesList->getVacanciesFound(), $vacanciesList->getVacanciesStats(), $vacanciesList->getVacanciesNames());
        ob_start();
        $response->save('php://output');
        return new Response(
            ob_get_clean(),  // read from output buffer
            200,
            array(
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename='.sprintf("analytics_%s.xlsx", time()),
            )
        );
    }
}
