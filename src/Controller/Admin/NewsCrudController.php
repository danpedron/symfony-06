<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Notícias')
            ->setEntityLabelInSingular('Notícia')
            ->setPageTitle('index','Gerenciamento de Notícias')
            ->setPaginatorPageSize(30)
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            AssociationField::new('category')->setFormTypeOptions(
              ['choice_label'=>'title','choice_value'=>'id']
            )->setLabel('Categoria'),


            TextField::new('title')->setLabel('Título'),
            TextField::new('image')->setLabel('URL da Imagem'),
            TextareaField::new('description')->hideOnIndex()->setLabel('Chamada'),
            TextareaField::new('content')->hideOnIndex()->setLabel('Conteúdo'),
            DateTimeField::new('createAt')->setLabel('Criada em')->setFormTypeOption('disabled','disabled'),
            TextField::new('slug')->setLabel('Slug')->setFormTypeOption('disabled','disabled')->hideOnIndex(),

        ];
    }

}
