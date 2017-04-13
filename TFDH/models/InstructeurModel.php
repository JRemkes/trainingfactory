<?php

namespace TFDH\models;
use ao\php\framework\models\AbstractModel;

class InstructeurModel extends AbstractModel {

    public function __construct($control, $model) {
        parent::__construct($control, $model);
    }
   
    public function uitloggen()
    {
        $_SESSION = array();
        session_destroy();
    }
    
    public function getLeden()
    {
       $sql = 'SELECT * FROM `person` WHERE `role` = "lid" ';
       $stmnt = $this->dbh->prepare($sql);
       $stmnt->execute();
       $leden = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Person');    
       return $leden;
    }
    
    public function getInstructeurs()
    {
       $sql = 'SELECT * FROM `person` WHERE `role` = "instructeur" ';
       $stmnt = $this->dbh->prepare($sql);
       $stmnt->execute();
       $instructeurs = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Person');    
       return $instructeurs;
    }
    
    public function getTrainingen()
    {
       $sql = 'SELECT * FROM `training` ';
       $stmnt = $this->dbh->prepare($sql);
       $stmnt->execute();
       $trainingen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Training');    
       return $trainingen;
    }

    public function getLessen()
    {
        $sql = "
            SELECT l.*, p.firstname
            FROM lesson AS l
            JOIN person AS p
            ON l.instructor_id = p.id
        ";

        $stmnt = $this->dbh->prepare($sql);
        
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            echo $e;
        }

        $lessen = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Lesson');
        return $lessen;
    }

    public function addLesson(){
        $tijd = filter_input(INPUT_POST, 'time');
        $datum = filter_input(INPUT_POST, 'date');
        $location=filter_input(INPUT_POST, 'location');
        $mp=filter_input(INPUT_POST, 'max_persons');
        $id = $_SESSION['gebruiker']->getId();

        if($tijd===null || $datum===null || $location===null || $mp===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if( $mp <= 0)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        } 
        else
        {
            $sql=   "
                INSERT INTO lesson 
                SET
                    time = :time,
                    date = :date,
                    location = :location,
                    max_persons = :max_persons,
                    instructor_id = :instructor_id
            ";
            $stmnt = $this->dbh->prepare($sql);
        }
        $stmnt->bindParam(':time', $tijd);
        $stmnt->bindParam(':date', $datum);
        $stmnt->bindParam(':location', $location);
        $stmnt->bindParam(':max_persons', $mp);
        $stmnt->bindParam(':instructor_id', $id);
        
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            echo $e;
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        if($stmnt->rowCount()===1)
        {            
            return REQUEST_SUCCESS;
        }
        return REQUEST_FAILURE_DATA_INVALID; 
    }
}