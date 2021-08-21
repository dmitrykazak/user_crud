<?php

declare(strict_types=1);

namespace App\Tests\Functional\Service\User;

use App\Doctrine\Transaction\TransactionManagerInterface;
use App\Factory\User\UserFactory;
use App\Service\User\UserImportService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class UserImportServiceTest extends WebTestCase
{
    /**
     * @var UserFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    private $userFactory;

    /**
     * @var TransactionManagerInterface|\PHPUnit\Framework\MockObject\Stub
     */
    private $transactionManager;
    private UserImportService $userImportService;

    public function setUp(): void
    {
        $this->userFactory = $this->createStub(UserFactory::class);
        $this->transactionManager = $this->createStub(TransactionManagerInterface::class);

        $this->userImportService = new UserImportService(
            $this->userFactory,
            $this->transactionManager
        );
    }

    public function testUserImportService(): void
    {
        $uploadedFile = new UploadedFile(
            __DIR__.'/../fixtures/upload.csv',
            'upload.csv'
        );

        $this->userFactory->expects(self::once())->method('create');

        $result = $this->userImportService->import($uploadedFile->getPathname());

        self::assertCount(1, $result);
    }
}
