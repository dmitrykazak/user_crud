<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

final class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $import = Action::new('import', 'actions.import')
            ->setIcon('fa fa-download')
            ->linkToRoute('admin_user_import')
            ->setCssClass('btn')
            ->createAsGlobalAction();

        return $actions
            ->disable(Action::NEW, Action::DELETE)
            ->add(Crud::PAGE_INDEX, $import);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            'username',
            'email',
            'firstname',
            'lastname',
        ];
    }
}
