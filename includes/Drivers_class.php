<?php

require_once(__DIR__."/connection.php");

class Drivers
{
   
    function list()
    {

        $db = new DB();
        $con = $db->connect();
        if ($con) {
            $results = [];

            $stmt = $con->prepare("CALL GetDrivers()");
            $stmt->execute();

            while ($row = $stmt->fetch())
                $results[] = [$row["driver_id"], $row["first_name"], $row["last_name"], $row["email"], $row["CPR"], $row["salary"], $row["truck_number"]];

            $stmt = null;
            $db->disconnect($con);

            return $results;
        } else
            return false;
    }
    function addDriver($sFirstName, $sLastName, $sEmail, $sTruckNumber, $sCpr, $sSalary){
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            $stmt = $con->prepare("CALL AddDriver(?,?,?,?,?,?)");

            $stmt->execute([$sFirstName, $sLastName, $sEmail, $sTruckNumber, $sCpr, $sSalary]);

            $stmt = null;
            $db->disconnect($con);
            
            
        } else
            return false;
    }



}
