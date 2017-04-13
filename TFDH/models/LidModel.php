<?php

namespace TFDH\models;
use ao\php\framework\models\AbstractModel;

class LidModel extends AbstractModel {

    public function __construct($control, $model) {
        parent::__construct($control, $model);
    }

    public function edit($id) {
        $firstname = filter_input(INPUT_POST, 'firstname');
        $prefix    = filter_input(INPUT_POST, 'prefix');
        $lastname  = filter_input(INPUT_POST, 'lastname');
        $email     = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $address   = filter_input(INPUT_POST, 'address');
        $postal    = filter_input(INPUT_POST, 'postal');
        $place     = filter_input(INPUT_POST, 'place');

        if( isset($firstname) && isset($lastname) && isset($email) && isset($address) && isset($postal) && isset($place) ) {
            
            $sql = "
                UPDATE person
                SET
                    firstname       = :firstname,
                    preprovision    = :prefix,
                    lastname        = :lastname,
                    emailaddress    = :email,
                    street          = :street,
                    postal_code     = :postal,
                    place           = :place 
                WHERE id = :id
            ";

            $stmnt = $this->dbh->prepare($sql);
            $stmnt->bindParam(':firstname', $firstname);
            $stmnt->bindParam(':prefix', $prefix);
            $stmnt->bindParam(':lastname', $lastname);
            $stmnt->bindParam(':email', $email);
            $stmnt->bindParam(':street', $address);
            $stmnt->bindParam(':postal', $postal);
            $stmnt->bindParam(':place', $place);
            $stmnt->bindParam(':id', $id);

            try {
                $stmnt->execute();
            }
            catch (\PDOEXception $e) {
                echo $e;
                return REQUEST_FAILURE_DATA_INVALID;
            }

            if( $stmnt->rowCount() ) {

                $this->refreshUser($id);
                return REQUEST_SUCCESS;
            }

            return REQUEST_NOTHING_CHANGED;
        }
        else {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
    }

    private function refreshUser($id) {
        
        $sql = '
            SELECT *
            FROM person
            WHERE id = :id
        ';

        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();

        $result = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\Person');

        $_SESSION['gebruiker'] = $result[0];
    }

    public function getLessons() {

        $id = $_SESSION['gebruiker']->getId();

        $sql = '
            SELECT DATE_FORMAT(l.time, "%H:%i") AS time, DATE_FORMAT(l.date, "%d-%m-%Y") AS date, l.location, l.max_persons, t.description, t.duration, t.costs
            FROM lesson AS l
            JOIN training AS t
            ON l.training_id = t.id
            WHERE l.id NOT in (SELECT lesson_id FROM registration WHERE person_id = :id)
        ';

        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();

        $result = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\lesson');
        return $result;
    }

    public function signinLesson($userId, $lessonId) {
        
        $sql = '
            INSERT INTO registration
            SET
                person_Id     = :userId,
                lesson_id   = :lessonId
        ';

        $stmnt = $this->dbh->prepare($sql);

        $stmnt->bindParam(':userId', $userId);
        $stmnt->bindParam(':lessonId', $lessonId);
        
        try {
            $stmnt->execute();
            return REQUEST_SUCCESS;
        }
        catch (\PDOEXception $e) {
            echo $e;
            return REQUEST_FAILURE_DATA_INVALID;
        }
    }

    public function getSignedLessons() {

        $id = $_SESSION['gebruiker']->getId();

        $sql = '
            SELECT DATE_FORMAT(l.time, "%H:%i") AS time, DATE_FORMAT(l.date, "%d-%m-%Y") as date, l.location, l.max_persons, t.description, t.duration, t.costs
            FROM lesson AS l
            JOIN training AS t
            ON l.training_id = t.id
            WHERE l.id in (SELECT lesson_id FROM registration WHERE person_id = :id)
        ';

        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':id', $id);
        $stmnt->execute();

        $result = $stmnt->fetchAll(\PDO::FETCH_CLASS, __NAMESPACE__ . '\db\lesson');
        return $result;
    }

    public function signoutLesson($personId, $lessonId) {

        $sql = '
            DELETE
            FROM registration
            WHERE lesson_id = :lessonId
            AND person_id = :personId
        ';

        $stmnt = $this->dbh->prepare($sql);
        $stmnt->bindParam(':lessonId', $lessonId);
        $stmnt->bindParam(':personId', $personId);
        $stmnt->execute();

        if( $stmnt->rowCount() ) {
            return REQUEST_SUCCESS;
        }
        return REQUEST_FAILURE_DATA_INVALID;
    }
}