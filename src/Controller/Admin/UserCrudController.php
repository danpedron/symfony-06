<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Usuários')
            ->setEntityLabelInSingular('Usuário')
            ->setPageTitle('index','Gerenciamento de usuários')
            ->setPaginatorPageSize(3)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return [];
        }
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email')->setFormTypeOption('disabled','disabled'),
            ArrayField::new('roles')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return parent::configureActions($actions)
                ->disable(Action::EDIT)
                ->disable(Action::DELETE)
                ->disable(Action::BATCH_DELETE)
                ->disable(Crud::PAGE_INDEX);
        }
        return parent::configureActions($actions);
    }


}
