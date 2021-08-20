<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;

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
            ->linkToCrudAction('import')
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

    public function import(Request $request)
    {

    }
}
