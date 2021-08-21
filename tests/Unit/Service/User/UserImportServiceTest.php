<?php
/**
 * UserImportServiceTest
 *
 * @copyright Copyright © 2021 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace App\Tests\Unit\Service\User;

use App\Doctrine\Transaction\TransactionManagerInterface;
use App\Factory\User\UserFactory;
use App\Service\User\UserImportService;
use PHPUnit\Framework\TestCase;

final class UserImportServiceTest extends TestCase
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
        $this->userFactory->expects(self::once())->method('create');

        $this->userImportService->import('/tmo/userfile.csv');
    }
}
