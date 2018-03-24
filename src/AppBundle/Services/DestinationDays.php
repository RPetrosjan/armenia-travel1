<?php

namespace AppBundle\Services;

use AppBundle\Repository\DestinationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DestinationDays extends Controller
{
    private $em;
    /**
     * DestinationDays constructor.
     */
    public function __construct()
    {

    }

    public function getDataDays(){

        /*
        $allDestinationsS = $em->getRepository('AppBundle:PostImage')->findAllActieDestinations();
        $destStickersArray = $allDestinationsS[0]->destinationsticker->toArray();

        $destinationday = array();
        $destinationdayArray = $allDestinationsS[0]->destinationdays->getSnapshot();
        foreach($allDestinationsS[0]->destinationdays->getSnapshot() as $key => $value){
            $destinationday[$key] = array(
                'filename' => $value->filename,
                'folder' => $value->path,
                'titleDays' => $value->titleDays,
                'descriptionDays' => $value->descriptionDays,
            );
        }*/


        return [0,1];
    }
}