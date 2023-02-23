<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Repository\NewsCategoryRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewsCrudController extends AbstractCrudController
{
    public function __construct(private NewsCategoryRepository $categoryRepository)
    {

    }
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
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('category')->setFormTypeOptions(['choice_label'=>'title','choice_value'=> 'id'] )->setLabel('Categoria'),
            TextField::new('title')->setLabel('Título'),
            ImageField::new('image')
                ->setLabel('Foto da Notícia')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired(false),
            TextareaField::new('content')->hideOnIndex()->setLabel('Conteúdo')->setFormType(CKEditorType::class),
            DateTimeField::new('createdAt')->setLabel('Criada em')->setFormTypeOption('disabled','disabled'),
            TextField::new('slug')->setLabel('Slug')->setFormTypeOption('disabled','disabled')->hideOnIndex(),

        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->disable(Action::DETAIL);
    }


}
