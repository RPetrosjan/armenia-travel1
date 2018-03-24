<?php
/**
 * Created by PhpStorm.
 * User: Win10
 * Date: 27.02.2018
 * Time: 12:56
 */

namespace AppBundle\Admin;



use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\DateType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Yaml\Yaml;

class WebTranslationAdmin extends AbstractAdmin
{

    protected $datagridValues = [

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'CreatedDate',
    ];


    protected function MakeTranslatorUpdate($langue,$domain,$code,$translate){
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager()->getRepository('AppBundle:WebTranslation')
            ->findBy(array(
                'locale' => $langue,
            ));
        $reponseTrans = [];
        foreach ($em as $key=>$value)
        {
            $reponseTrans[$value->getCode()] = $value->GetText();
        }
        $reponseTrans[$code] = $translate;

        if(sizeof($reponseTrans)>0)
        {
            $translatedir = __DIR__.'/../../../app/Resources/translations';
            $yaml = Yaml::dump($reponseTrans);
            file_put_contents($translatedir.'/messages.'.$domain.'.yml', $yaml);
        }
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $langues = $this->getConfigurationPool()->getContainer()->getParameter('languages');

        $builder = $formMapper->getFormBuilder();
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($langues) {


            $data = $event->getForm()->getData();
            $domain = array_search($data->getLocale(),$langues);

            if($domain!==false)
            {
                $this->MakeTranslatorUpdate($data->getLocale(),$domain,$data->getCode(),$data->getText());
            }
        });




        $formMapper
            ->add('locale',ChoiceType::class,array(
                'label' => 'Locale',
                'choices' => $this->getConfigurationPool()->getContainer()->getParameter('languages'),
            ))
            ->add('code',TextType::class,array(
                'label' => 'Code Translation',

            ))
            ->add('text',TextareaType::class,array(
                'label' => 'Text Translation',
            ))
            ;
    }



    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('CreatedDate')
            ->add('code')
            ->add('locale')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('CreatedDate','datetime',array(
                'label' => 'Date Creation',
                'format' => 'd/m/Y H:m:s',
                'locale' => 'fr',
                'timezone' => 'Europe/Paris',
            ))
            ->addIdentifier('code',null,['editable' => true])
            ->add('locale')
            ->addIdentifier('_action','actions',array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

}