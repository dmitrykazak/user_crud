<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Factory\User\UserFactory;
use League\Csv\Reader;

final class UserImportService
{
    private const HEADER = ['firstname', 'lastname', 'email', 'username'];

    private UserFactory $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function import(string $path): array
    {
        $reader = Reader::createFromPath($path);

        $reader->setHeaderOffset(0);
        $records = $reader->getRecords(self::HEADER);

        $result = [];
        foreach ($records as $offset => $record) {
            try {
                $this->userFactory->create(
                    $record['username'],
                    $record['email'],
                    $record['firstname'],
                    $record['lastname']
                );
                $result['success'] = $record;
            } catch (\Exception $exception) {
                $result['error'] = $record;
            }
        }

        return $result;
    }
}
