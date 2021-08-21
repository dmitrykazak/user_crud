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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user/import", name="admin_user_import")
 */
final class IndexUserImportFormController extends AbstractController
{
    private UserImportService $userImportService;
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(UserImportService $userImportService, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->userImportService = $userImportService;
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    public function __invoke(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserImportType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            /** @var UploadedFile $csvFile */
            $csvFile = $form->get('importcsv')->getData();

            if ($csvFile) {
                $result = $this->userImportService->import($csvFile->getPathname());

                $this->addFlash('success', \sprintf('Successful imported user %d', isset($result['success']) ? \count($result['success']) : 0));

                if (isset($result['error'])) {
                    $this->addFlash('warning', \sprintf('Error import user %d', isset($result['error']) ? \count($result['error']) :  0));
                }
            }

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/user/import.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
