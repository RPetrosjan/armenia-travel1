<?php
/**
 * Created by PhpStorm.
 * User: Win10
 * Date: 28.02.2018
 * Time: 12:15
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StickerAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->add('nameSticker',TextType::class,array(
                'label' => $this->trans('Name Sticker'),
            ))
            ->add('codeSticker',TextType::class,array(
                'label' => $this->trans('Code Sticker'),
            ))


        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){

        $datagridMapper
            ->add('nameSticker')
            ;
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('nameSticker')
            ->add('codeSticker','html')
            ->addIdentifier('_action','actions',array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
}