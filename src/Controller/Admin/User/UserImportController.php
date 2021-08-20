<?php

declare(strict_types=1);

namespace App\Controller\Admin\User;

use App\Service\User\UserImportService;
use Symfony\Component\HttpFoundation\Request;

class UserImportController
{
    private UserImportService $userImportService;

    public function __construct(UserImportService $userImportService)
    {
        $this->userImportService = $userImportService;
    }

    public function __invoke(Request $request)
    {
        $this->userImportService->import($request->files->get('path'));
    }
}
