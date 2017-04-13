<?php

namespace TFDH\controls;
use ao\php\framework\controls\abstractController;

class LidController extends abstractController {

    public function __construct($control, $model) {
        parent::__construct($control, $model);
    }

    protected function defaultAction() {
        $gebruiker = $this->model->getGebruiker();
        $this->view->set("gebruiker", $gebruiker);
    }

    protected function editAction() {
        if( is_numeric($_GET['id'])) {

            if( !$this->model->isPostLeeg() ) {

                $result = $this->model->edit($_GET['id']);

                switch( $result ) {
                    case REQUEST_FAILURE_DATA_INCOMPLETE:
                        $this->view->set("boodschap", "Gegevens zijn niet gewijzigd. Niet alle vereiste data zijn ingevuld.");  
                        break;
                    case REQUEST_FAILURE_DATA_INVALID:
                        $this->view->set("boodschap", "Gegevens zijn niet gewijzigd. Er is foutieve data ingestuurd.");  
                        break;
                    case REQUEST_SUCCESS:
                        $this->view->set("boodschap", "Gegevens gewijzigd"); 
                        break; 
                }
            }
            
            $gebruiker = $this->model->getGebruiker();
            $this->view->set("gebruiker", $gebruiker);
        }
        else {
            $this->forward('default');
        }
    }

    protected function lessonOverviewAction() {

        // get the information of the logged user
        $gebruiker = $this->model->getGebruiker();
        $this->view->set("gebruiker", $gebruiker);

        // get the lessons
        $lessons = $this->model->getLessons();
        $this->view->set('lessons', $lessons);
    }

    protected function signinLessonAction() {
        if( is_numeric($_GET['userId']) && is_numeric($_GET['lessonId']) ) {

            $result = $this->model->signinLesson($_GET['userId'], $_GET['lessonId']);

            switch( $result ) {
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap", "Oops er is iets verkeerd gegaan met inschrijven.");
                    $this->forward('lessonOverview');
                    break;
                case REQUEST_SUCCESS:
                    $this->view->set("boodschap", "Ingeschreven!");
                    $this->forward('lessonOverview');
                    break; 
            }
        }
        else {
            $this->forward('lessonOverview');
        }
    }

    protected function signedLessonOverviewAction() {

        // get the information of the logged user
        $gebruiker = $this->model->getGebruiker();
        $this->view->set("gebruiker", $gebruiker);

        // get the lessons
        $lessons = $this->model->getSignedLessons();
        $this->view->set('lessons', $lessons);
    }

    protected function signoutLessonAction() {
        if( is_numeric($_GET['userId']) && is_numeric($_GET['lessonId']) ) {

            $result = $this->model->signoutLesson($_GET['userId'], $_GET['lessonId']);

            switch( $result ) {
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("boodschap", "Oops er is iets verkeerd gegaan met uitschrijven.");
                    $this->forward('lessonOverview');
                    break;
                case REQUEST_SUCCESS:
                    $this->view->set("boodschap", "uitgeschreven!");
                    $this->forward('signedLessonOverview');
                    break; 
            }
        }
        else {
            $this->forward('lessonOverview');
        }
    }
}