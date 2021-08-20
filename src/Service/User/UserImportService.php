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

    public function import(string $path): int
    {
        $reader = Reader::createFromPath($path);

        $records = $reader->getRecords(self::HEADER);
        foreach ($records as $offset => $record) {
            $this->userFactory->create(
                $record['username'],
                $record['email'],
                $record['firstname'],
                $record['lastname']
            );
        }

        return $reader->count();
    }
}
