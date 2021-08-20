<?php

declare(strict_types=1);

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\UserImportType;
use App\Service\User\UserImportService;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user/import", name="admin_user_import")
 */
class IndexUserImportFormController extends AbstractController
{
    private UserImportService $userImportService;
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(UserImportService $userImportService, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->userImportService = $userImportService;
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    public function __invoke(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserImportType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $csvFile */
            $csvFile = $form->get('importcsv')->getData();

            if ($csvFile) {
                $this->userImportService->import($csvFile->getPath());
            }
        }

        return $this->redirectToRoute('admin');
    }
}
