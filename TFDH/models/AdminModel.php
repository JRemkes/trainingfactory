<?php

namespace TFDH\models;
use ao\php\framework\models\AbstractModel;

class AdminModel extends AbstractModel {

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
    
    public function getTraining()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
       
        if($id===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }       
        
        $sql='SELECT `description`, `duration`, `extra_costs`
            FROM `training`
            WHERE `training`.`id`=:id';      
                          
       $stmnt = $this->dbh->prepare($sql);
       $stmnt->bindParam(':id',$id );
       $stmnt->execute();
       $training = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Training');    
       return $training[0];
    }
    
    public function getInstructeur()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
       
        if($id===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }       
        
        $sql='SELECT *
            FROM `person`
            WHERE `person`.`id`=:id';      
                          
       $stmnt = $this->dbh->prepare($sql);
       $stmnt->bindParam(':id',$id );
       $stmnt->execute();
       $instructeur = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Person');    
       return $instructeur[0];
    }
    
    public function getLid()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
       
        if($id===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }       
        
        $sql='SELECT *
            FROM `person`
            WHERE `person`.`id`=:id';      
                          
       $stmnt = $this->dbh->prepare($sql);
       $stmnt->bindParam(':id',$id );
       $stmnt->execute();
       $lid = $stmnt->fetchAll(\PDO::FETCH_CLASS,__NAMESPACE__.'\db\Person');    
       return $lid[0];
    }
    
    public function deleteInstructeur()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
       
        if($id===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }   
       
        $sql = "DELETE FROM `person` WHERE `person`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id); 
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        if($stmnt->rowCount()===1){
            
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
    public function deleteLid()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
       
        if($id===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }   
       
        $sql = "DELETE FROM `person` WHERE `person`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id); 
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        if($stmnt->rowCount()===1){
            
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
    public function deleteTraining()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
       
        if($id===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }   
       
        $sql = "DELETE FROM `training` WHERE `training`.`id`=:id";
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id); 
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        if($stmnt->rowCount()===1){
            
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
    public function addInstructeur()
    {
        $loginname= filter_input(INPUT_POST, 'loginname');
        $password= filter_input(INPUT_POST, 'password');
        $firstname= filter_input(INPUT_POST, 'firstname');
        $preprovision= filter_input(INPUT_POST, 'preprovision');
        $lastname= filter_input(INPUT_POST, 'lastname');
        $dateofbirth= filter_input(INPUT_POST, 'dateofbirth');
        $gender= filter_input(INPUT_POST,'gender');
        $emailaddress= filter_input(INPUT_POST, 'emailaddress', FILTER_VALIDATE_EMAIL);
        $hiring_date= filter_input(INPUT_POST, 'hiring_date');
        $salary= filter_input(INPUT_POST, 'salary');
        $street= filter_input(INPUT_POST, 'street');
        $postal_code= filter_input(INPUT_POST, 'postal_code');
        $place= filter_input(INPUT_POST, 'place');

        if($loginname===null || $password===null || $firstname===null || $lastname===null || $dateofbirth===null|| $gender===null
            || $emailaddress===null || $hiring_date===null || $salary===null || $street===null || $postal_code===null || $place===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($emailaddress===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $sql="INSERT INTO `Person`  (loginname,password,firstname,preprovision, 
            lastname,dateofbirth,gender,emailaddress,hiring_date,salary,street,postal_code,place,role) 
            VALUES (:loginname,:password,:firstname,:preprovision, 
            :lastname,:dateofbirth,:gender,:emailaddress,:hiring_date,:salary,:street,:postal_code,:place,'instructeur')"; 
        
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':loginname', $loginname);
        $stmnt->bindParam(':password', $password);
        $stmnt->bindParam(':firstname', $firstname);
        $stmnt->bindParam(':preprovision', $preprovision);
        $stmnt->bindParam(':lastname', $lastname);
        $stmnt->bindParam(':dateofbirth', $dateofbirth);
        $stmnt->bindParam(':gender', $gender);
        $stmnt->bindParam(':emailaddress', $emailaddress);
        $stmnt->bindParam(':hiring_date', $hiring_date);
        $stmnt->bindParam(':salary', $salary);
        $stmnt->bindParam(':street', $street);
        $stmnt->bindParam(':postal_code', $postal_code);
        $stmnt->bindParam(':place', $place);
        
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
    
    public function addLid()
    {
        $loginname= filter_input(INPUT_POST, 'loginname');
        $password= filter_input(INPUT_POST, 'password');
        $firstname= filter_input(INPUT_POST, 'firstname');
        $preprovision= filter_input(INPUT_POST, 'preprovision');
        $lastname= filter_input(INPUT_POST, 'lastname');
        $dateofbirth= filter_input(INPUT_POST, 'dateofbirth');
        $gender= filter_input(INPUT_POST,'gender');
        $emailaddress= filter_input(INPUT_POST, 'emailaddress', FILTER_VALIDATE_EMAIL);
        $street= filter_input(INPUT_POST, 'street');
        $postal_code= filter_input(INPUT_POST, 'postal_code');
        $place= filter_input(INPUT_POST, 'place');

        if($loginname===null || $password===null || $firstname===null || $lastname===null || $dateofbirth===null|| $gender===null
            || $emailaddress===null || $street===null || $postal_code===null || $place===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }

        if($emailaddress===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $sql="INSERT INTO `Person`  (loginname,password,firstname,preprovision, 
            lastname,dateofbirth,gender,emailaddress,street,postal_code,place,role) 
            VALUES (:loginname,:password,:firstname,:preprovision, 
            :lastname,:dateofbirth,:gender,:emailaddress,:street,:postal_code,:place,'lid')"; 
        
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':loginname', $loginname);
        $stmnt->bindParam(':password', $password);
        $stmnt->bindParam(':firstname', $firstname);
        $stmnt->bindParam(':preprovision', $preprovision);
        $stmnt->bindParam(':lastname', $lastname);
        $stmnt->bindParam(':dateofbirth', $dateofbirth);
        $stmnt->bindParam(':gender', $gender);
        $stmnt->bindParam(':emailaddress', $emailaddress);
        $stmnt->bindParam(':street', $street);
        $stmnt->bindParam(':postal_code', $postal_code);
        $stmnt->bindParam(':place', $place);
        
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
    
    public function addTraining()
    {
        $description= filter_input(INPUT_POST, 'description');
        $duration= filter_input(INPUT_POST, 'duration');
        $extra_costs=filter_input(INPUT_POST, 'extra_costs');

        if($description===null || $duration===null || $extra_costs===null )
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
 
        $sql="INSERT INTO `training` ( description, duration, extra_costs
            )VALUES (:description,:duration,:extra_costs)"; 
        
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':description', $description);
        $stmnt->bindParam(':duration', $duration);
        $stmnt->bindParam(':extra_costs', $extra_costs);
        
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
    
    public function updateTraining()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        $description= filter_input(INPUT_POST, 'description');
        $duration= filter_input(INPUT_POST, 'duration');
        $extra_costs=filter_input(INPUT_POST, 'extra_costs');
        
        if($description===null || $duration===null || $extra_costs===null )
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
 
        $sql="UPDATE `training` SET description=:description,duration=:duration"
            . ",extra_costs=:extra_costs"
            . " where `training`.`id`= :id; ";        
       
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);        
        $stmnt->bindParam(':description', $description);
        $stmnt->bindParam(':duration', $duration);
        $stmnt->bindParam(':extra_costs', $extra_costs);
           
        try
        {
            $stmnt->execute();
        }
        catch(\PDOEXception $e)
        {
            echo $e;
            return REQUEST_FAILURE_DATA_INVALID;
        }
        
        $aantalGewijzigd = $stmnt->rowCount();
        if($aantalGewijzigd===1)
        {
            return REQUEST_SUCCESS;
        }
        return REQUEST_NOTHING_CHANGED;
    }
    
    public function updateInstructeur()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        $loginname= filter_input(INPUT_POST, 'loginname');
        $password= filter_input(INPUT_POST, 'password');
        $firstname= filter_input(INPUT_POST, 'firstname');
        $preprovision= filter_input(INPUT_POST, 'preprovision');
        $lastname= filter_input(INPUT_POST, 'lastname');
        $dateofbirth= filter_input(INPUT_POST, 'dateofbirth');
        $gender= filter_input(INPUT_POST,'gender');
        $emailaddress= filter_input(INPUT_POST, 'emailaddress', FILTER_VALIDATE_EMAIL);
        $hiring_date= filter_input(INPUT_POST, 'hiring_date');
        $salary= filter_input(INPUT_POST, 'salary');
        $street= filter_input(INPUT_POST, 'street');
        $postal_code= filter_input(INPUT_POST, 'postal_code');
        $place= filter_input(INPUT_POST, 'place');
        
        if($loginname===null || $password===null || $firstname===null || $lastname===null || $dateofbirth===null|| $gender===null
            || $emailaddress===null || $hiring_date===null || $salary===null || $street===null || $postal_code===null || $place===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
 
        $sql="UPDATE `person` SET loginname=:loginname,password=:password,firstname=:firstname,preprovision=:preprovision"
            . ",lastname=:lastname,dateofbirth=:dateofbirth,gender=:gender,emailaddress=:emailaddress,hiring_date=:hiring_date"
            . ",salary=:salary,street=:street,postal_code=:postal_code,place=:place"
            . " where `person`.`id`= :id; ";        
       
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);        
        $stmnt->bindParam(':loginname', $loginname);
        $stmnt->bindParam(':password', $password);
        $stmnt->bindParam(':firstname', $firstname);
        $stmnt->bindParam(':preprovision', $preprovision);
        $stmnt->bindParam(':lastname', $lastname);
        $stmnt->bindParam(':dateofbirth', $dateofbirth);
        $stmnt->bindParam(':gender', $gender);
        $stmnt->bindParam(':emailaddress', $emailaddress);
        $stmnt->bindParam(':hiring_date', $hiring_date);
        $stmnt->bindParam(':salary', $salary);
        $stmnt->bindParam(':street', $street);
        $stmnt->bindParam(':postal_code', $postal_code);
        $stmnt->bindParam(':place', $place);
        
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
    
    public function updateLid()
    {
        $id= filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        $loginname= filter_input(INPUT_POST, 'loginname');
        $password= filter_input(INPUT_POST, 'password');
        $firstname= filter_input(INPUT_POST, 'firstname');
        $preprovision= filter_input(INPUT_POST, 'preprovision');
        $lastname= filter_input(INPUT_POST, 'lastname');
        $dateofbirth= filter_input(INPUT_POST, 'dateofbirth');
        $gender= filter_input(INPUT_POST,'gender');
        $emailaddress= filter_input(INPUT_POST, 'emailaddress', FILTER_VALIDATE_EMAIL);
        $street= filter_input(INPUT_POST, 'street');
        $postal_code= filter_input(INPUT_POST, 'postal_code');
        $place= filter_input(INPUT_POST, 'place');
        
        if($loginname===null || $password===null || $firstname===null || $lastname===null || $dateofbirth===null|| $gender===null
            || $emailaddress===null || $street===null || $postal_code===null || $place===null)
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
        
        if($id===false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
 
        $sql="UPDATE `person` SET loginname=:loginname,password=:password,firstname=:firstname,preprovision=:preprovision"
            . ",lastname=:lastname,dateofbirth=:dateofbirth,gender=:gender,emailaddress=:emailaddress"
            . ",street=:street,postal_code=:postal_code,place=:place"
            . " where `person`.`id`= :id; ";        
       
        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);        
        $stmnt->bindParam(':loginname', $loginname);
        $stmnt->bindParam(':password', $password);
        $stmnt->bindParam(':firstname', $firstname);
        $stmnt->bindParam(':preprovision', $preprovision);
        $stmnt->bindParam(':lastname', $lastname);
        $stmnt->bindParam(':dateofbirth', $dateofbirth);
        $stmnt->bindParam(':gender', $gender);
        $stmnt->bindParam(':emailaddress', $emailaddress);
        $stmnt->bindParam(':street', $street);
        $stmnt->bindParam(':postal_code', $postal_code);
        $stmnt->bindParam(':place', $place);
        
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