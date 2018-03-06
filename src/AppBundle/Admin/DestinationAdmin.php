<?php

namespace AppBundle\Admin;



use AppBundle\Entity\Sticker;
use AppBundle\Form\Type\DestinationStickerType;
use AppBundle\Form\Type\ImageType;
use Doctrine\DBAL\Types\BooleanType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class DestinationAdmin extends AbstractAdmin
{
    //Function servirai pour charger les Files
    /**
     * DestinationAdmin constructor.
     */
    public function LoadFiles($infofile, $em){

        // $file stores the uploaded PDF file
        /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

        //ON recuper info file qui vien aec Symfony
        $file = $infofile;
        // Generate a unique name for the file before saving it

        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        // Move the file to the directory where brochures are stored
        $file->move(
            $em->getParameter('images_load_directory'),
            $fileName
        );

        return $fileName;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $builder = $formMapper->getFormBuilder();
        $em = $this->getConfigurationPool()->getContainer();

        //REcuperation tous les Images et Idis
        $slideimages = $em->get('doctrine')->getManager()->getRepository('AppBundle:Image')->findAll();
        $arrayFiles = [];


        //Conversation sur Array id => file
        foreach ($slideimages as $key=>$value){
                $arrayFiles[$value->getId()] = $value->getImage();
        }

        //  Ruben 30/10/2017
        // Pres bumit pour verificatiob si le client (societe exist oui pas)

        // REcuperation l'id du element a l'aide du POST_SUBMIT
        // $arrayFiles returnerai tous les ArrayFiles avec id
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use($em,$arrayFiles) {

            //REcuperation Data du Fromulaire
            $data = $event->getForm()->getData();
            //Passer pas tous les Images du Firmulaire


            foreach ($data->getImagetype()->getValues() as $key => $value){

                //Charger les images sur le serveur
                //Si l'image exist;
                if($value->getImage()!=null)
                {
                    $filename = $this->LoadFiles($value->getImage(),$em);

                    //Nomrlment Symfony gard comme valeur son PathName qui ne correspond pas a son bon chemai
                    //Apres avoir charge les images sur le serveur on recuper son nouvelle Filename
                    // FileName sera definir sur setImage
                    $data->getImagetype()->getValues()[$key]->setImage($filename);


                    if(count($arrayFiles)>0 && $value->getId() !=null && $arrayFiles[$value->getId()]!=null)
                    {
                        //REcuparation chemain tous nos Images
                        //images_load_directory defini sur config.yml
                        $oldfilename = $em->getParameter('images_load_directory').'/'.$arrayFiles[$value->getId()];
                        //Si le fishier l'exist
                        if(file_exists($oldfilename) && strlen($arrayFiles[$value->getId()])>0)
                        {
                            //Suprim l'ancienne
                            unlink($oldfilename);
                        }
                    }
                }
                else if($arrayFiles[$value->getId()]!=null){
                    $data->getImagetype()->getValues()[$key]->setImage($arrayFiles[$value->getId()]);
                }
            }
        });


        $formMapper
            ->tab($this->trans('Info destination'))
            ->with('General', ['class' => 'col-md-3'])
                ->add('nameDestination', TextType::class,array(
                    'label' => $this->trans('Destination'),
                    'attr' => array(
                        'class' => 'col-md-8',
                    ),
                ))
            ->add('description', TextType::class, array(
                'label' => $this->trans('Code description'),
                'attr' => array(
                    'maxlength' => 10,
                     'class' => 'col-xs-3',

                ),
            ))
            ->end()
            ->with('Settings',['class' => 'col-md-3'])
                ->add('activeDestination',CheckboxType::class,array(
                    'label' => $this->trans('Active'),
                    'required' => false,
                ))
                ->add('inbound', CheckboxType::class,array(
                    'label' => $this->trans('inboundtours'),
                    'required' => false,
                ))
            ->end()
            ->with('Data',['class' => 'col-md-3'])
                ->add('StartDateDestination',DatePickerType::class,array(
                    'label' => $this->trans('Start Action'),
                    'format' => 'd/M/y'
                ))
                ->add('EndDateDestination',DatePickerType::class,array(
                    'label' => $this->trans('End Action'),
                    'format' => 'd/M/y'
                ))

            ->end()

            ->with('Stickers')

            ->add('destinationsticker',CollectionType::class,array(
                'label' => $this->trans('Sticker'),
                'entry_type' => DestinationStickerType::class,
                'allow_add' => true,
                'allow_delete' => true,

            ))
            ->end()
            ->with('Images')
            ->add('imagetype',CollectionType::class,array(
                'label' => $this->trans('Image'),
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype'    => true,
            ))
            ->end()
            ->end()
            ->tab($this->trans('Days Planing'))
            ->end()
            ->tab($this->trans('SEO'))
            ->end()
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nameDestination')
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nameDestination')
            ->add('inbound')
            ->add('description')
            ->add('imagetype')
            ->add('StartDateDestination')
            ->add('EndDateDestination')
            ->add('destinationsticker')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('activeDestination')
            ->add('nameDestination')
            ->add('inbound')
            ->addIdentifier('_action','actions',array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }


    public function getFormTheme()
    {
        return array_merge(
            parent::getFormTheme(),
            array('myfield_edit.html.twig')
        );

     ///   return
      ///      array('myfield_edit.html.twig');
    }

}