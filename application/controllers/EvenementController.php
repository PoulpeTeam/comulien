<?php

class EvenementController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $Evenement = new Application_Model_EvenementMapper();
        $this->view->entries = $Evenement->fetchAll();
    }


}

