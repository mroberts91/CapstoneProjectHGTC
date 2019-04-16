<?php

namespace Core;
use \Exception;
require_once __DIR__."/_DataManager.php";
require_once __DIR__."/../dto/State.php";

class GeoManager extends _DataManager
{

    public function __construct($Connection)
    {
        parent::__construct($Connection);
    }

    /**
     * @return State[] - Returns an array of State Objects
     * @throws Exception
     */
    public function getAllStates(){
        $result = $this->Connection->SQLRequest(
            "SELECT * FROM core_States"
        );
        if (count($result) > 0) {
            $states = $this->buildStateObjectArray($result);
            return $states;
        } else{
            throw new Exception("EMPTY RESULT SET - The result set was empty.", 21);
        }
    }

    /**
     * @param $ResultSet
     * @return State[]
     * @throws Exception
     */
    private function buildStateObjectArray($ResultSet){
        $rtn = array();
        foreach ($ResultSet as $s) {
            $state = new State();
            if (!$state->buildFromArray($s)) {
                throw new Exception("DB RESULT PROPAGATION ERROR - 
                    Menu Item failed to initialize fields, OBJECT:  " . print_r($s),
                    999
                );
            }
            array_push($rtn, $state);
        }
        return $rtn;
    }

    /**
     * @param $id Location ID
     * @return string
     * @throws Exception
     */
    public function getLocationById($id){
        $result = $this->Connection->SQLRequest("SELECT Name FROM lu_Location WHERE id_Location = ?", $id);
        return $result[0];
    }
}