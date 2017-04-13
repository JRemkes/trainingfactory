<?php

namespace TFDH\controls;
use ao\php\framework\controls\abstractController;

class InstructeurController extends AbstractController {

    public function __construct($control, $model) {
        parent::__construct($control, $model);
    }

    public function defaultAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set("gebruiker",$gebruiker);
    }
    
    public function uitloggenAction()
    {
        $this->model->uitloggen();
        $this->forward('default','bezoeker');
    }

    public function lesToevoegenAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set("gebruiker",$gebruiker);

        if($this->model->isPostLeeg())
        {
           $this->view->set("boodschap","Vul uw gegevens in");
        }
        else
        {   
            
            $result=$this->model->addLesson();
            switch($result)
            {
                case REQUEST_SUCCESS:
                     $this->view->set("boodschap","U bent successvol geregistreerd!");                     
                     $this->forward("default");
                     break;
                case REQUEST_FAILURE_DATA_INVALID:
                     $this->view->set('form_data',$_POST);
                     $this->view->set("boodschap","Een van de velden heeft een ongeldige data, controlleer de velden."); 
                     break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                     $this->view->set('form_data',$_POST);
                     $this->view->set("boodschap","Niet alle gegevens ingevuld");
                     break;
            }
        }  
    }

    public function lesOverzichtAction()
    {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set("gebruiker", $gebruiker);

        $lessen = $this->model->getLessen();
        $this->view->set("lessen", $lessen);
    }

}