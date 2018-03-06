<?php
/**
 * Created by PhpStorm.
 * User: Win10
 * Date: 06.03.2018
 * Time: 01:33
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;

class PageAdmin extends AbstractAdmin
{
    protected $translationDomain = 'messages'; // default is 'messages'
}