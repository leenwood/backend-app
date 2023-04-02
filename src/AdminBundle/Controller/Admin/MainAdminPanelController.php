<?php

namespace App\AdminBundle\Controller\Admin;

use App\AccountBundle\Entity\Account;
use App\AdminBundle\Controller\Admin\CRUD\AccountCrudController;
use App\AdminBundle\Service\DjangoBackendService\DTO\VacancySkillStat;
use App\AdminBundle\Service\DjangoBackendService\RequestService;
use App\AdminBundle\Service\DonationService\DonateUserService;
use App\AdminBundle\Service\DonationService\GoalService;
use App\AdminBundle\Service\OpenAiService\OpenAiService;
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
        private RequestService                $requestService,
        private DownloadVacanciesStatsService $downloadVacanciesStatsService,
        private DonateUserService             $donateUserService,
        private GoalService                   $goalService,
        private OpenAiService                 $openAiService
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
        yield MenuItem::linkToRoute("Donation Wall", 'fas fa-arrow-alt-circle-right', 'app_donation_wall');
        yield MenuItem::section('Other backend', 'fas fa-angle-double-down');
        yield MenuItem::linkToRoute("HH analytics", 'fas fa-arrow-alt-circle-right', 'admin_analytics_search_page');
        yield MenuItem::linkToRoute("OpenAI analytics", 'fas fa-arrow-alt-circle-right', 'admin_analytics_openai_page');

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    #[Route(path: '/admin/analytics/hh', name: 'admin_analytics_hh',)]
    public function analyticsFromHH(
        Request $request
    ): Response
    {
        if ($request->get('queryName') === null or $request->get('queryName') === "") {
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

    #[Route(path: '/admin/analytics', name: 'admin_analytics_search_page',)]
    public function analyticsFormPageSearch(): Response
    {
        return $this->render('admin\layouts\searchPage.html.twig');
    }

    #[Route(path: '/admin/analytics/download', name: 'admin_analytics_download',)]
    public function downloadFileAnalytics(
        Request $request
    ): Response
    {
        if ($request->get('queryName') === null) {
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
                'Content-Disposition' => 'attachment; filename=' . sprintf("analytics_%s.xlsx", time()),
            )
        );
    }

    #[Route(path: '/admin/donation/wall', name: 'app_donation_wall')]
    public function donationWall(): Response
    {
        $goal = $this->goalService->findById(1);
        $donationUsers = $this->donateUserService->getUserByGoal($goal);

        return $this->render('admin\layouts\donationWall.html.twig', [
            'goal' => $goal,
            'donationUsers' => $donationUsers
        ]);
    }

    #[Route(path: '/admin/analytics/openai/question', name: 'admin_analytics_openai_page',)]
    public function analyticsOpenAiPage(): Response
    {
        $previousRequests = $this->openAiService->getAll();

        return $this->render('admin\layouts\openaiPage.html.twig', [
            'previousRequests' => $previousRequests,
        ]);
    }

    #[Route(path: '/admin/analytics/openai/answer', name: 'admin_analytics_openai_action',)]
    public function analyticsOpenAiAction($request): Response
    {
        if ($request->get('queryName') === null or $request->get('queryName') === "") {
            throw new \Exception("need query Name");
        }

        $answer = $this->openAiService->getAnswerByMessage($request->get('queryName'));
        return $this->render('admin\layouts\openaiActionPage.html.twig', [
            'answer' => $answer,
        ]);
    }
}
