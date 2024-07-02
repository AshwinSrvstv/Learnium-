<?php

class DBMySql
{
    public  $servername = "localhost";    public $username = "root";    public $password = "";    public $dbname = "careerguide";


    //public  $servername = "mysql5046.site4now.net";public $username = "a88a62_carguid";public $password = "Freepwd123#";public $dbname = "db_a88a62_carguid";

    public function GetActiveConnection()
    {
       $conn= new mysqli($this->servername, $this->username, $this->password, $this->dbname);
       $conn->set_charset('utf8');
       return $conn;
    }
    public function GetResult($SqlQuery)
    {
        try{
        $conn = $this->GetActiveConnection();
        $result= $conn->query($SqlQuery);
        $conn->close();
        return $result;
        }
        catch(Exception $e) {
            return null;
        }
    }
    public function GetResultOnConnection($SqlQuery,$DBConnection)
    {
        return $DBConnection->query($SqlQuery);
    }
    public function NonQuery($SqlQuery)
    {
        try{
            $conn = $this->GetActiveConnection();
            if( $conn->query($SqlQuery)){       
                $conn->close(); return true;}
            else{return false;}
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function NonQueryOnConnection($SqlQuery,$DBConnection)
    {
        try{
           
            $DBConnection->query($SqlQuery);
            $DBConnection->close();
            return true;
        }
        catch(Exception $e) {
            $DBConnection->close();
            return false;
        }
    }

    public function ScalerQuery($SqlQuery)
    {
        $conn = $this->GetActiveConnection();
        $result =   $conn->query($SqlQuery);

        $row = mysqli_fetch_array($result);
        return $row[0];
    }
    
    public function GetSingleRow($SqlQuery)
    {
        try{
            $conn = $this->GetActiveConnection();
            $row = $this->GetSingleRowOnConnection($SqlQuery,$conn);
            $conn->close();
            return $row;
        }
        catch(Exception $e) {return null;}
    }
    public function GetSingleRowOnConnection($SqlQuery,$conn)
    {
        try{
            
            $result= $conn->query($SqlQuery);
            $row=null;
            while($row = $result->fetch_assoc()) {
                return $row;
            }
            return $row;
        }
        catch(Exception $e) {
            $conn->close();
            return null;
        }
    }

    public function GetSingleRowArray($SqlQuery)
    {
        try{
            $conn = $this->GetActiveConnection();
            $result= $conn->query($SqlQuery);
            $conn->close();
            $row=null;
            while($row = $result->fetch_assoc()) { break; }
            $Array=array();

            foreach($row as $field=>$value)  
            {
                array_push($Array,$value);
            }
            return $Array;
        }
        catch(Exception $e) {
            return null;
        }
    }
    public function GetSingleRowAssociativeArray($SqlQuery)
    {
        try{
            $conn = $this->GetActiveConnection();
            $result= $conn->query($SqlQuery);
            $conn->close();
            $row=null;
            while($row = $result->fetch_assoc()) { break; }
            $Array=array();

            foreach($row as $field=>$value)  
            {
                $Array=array_merge($Array,array($field=>$value));   
            }
            return $Array;
        }
        catch(Exception $e) {
            return null;
        }
    }
    public function GetSingleColumnArray($SqlQuery)
    {
        try{
            $conn = $this->GetActiveConnection();
            $result= $conn->query($SqlQuery);
            $conn->close();
            $row=null;
            $Array=array();

            while($row=mysqli_fetch_array($result))
            {
                 array_push($Array,$row[0]);
            }
            return $Array;
        }
        catch(Exception $e) {return null;}
        
    }
    public function GetDoubleColumnAssociativeArray($SqlQuery)
    {
        try{
            $conn = $this->GetActiveConnection();
            $result= $conn->query($SqlQuery);
            $conn->close();
            $row=null;
            $Array=array();

            while($row=mysqli_fetch_array($result))
            {
                $Key = $row[0];
                $Value=$row[1];
                $Temp=array($Key=>$Value);
                $Array=array_merge($Array,$Temp);
                //array_push($Array,$row[0]);
            }
            return $Array;
        }
        catch(Exception $e) {return null;}
    }

    public function GetDateTimeNow(){return date("Y-m-d H:i:s");}
    public function GetMidNightDateTime(){return date("Y-m-d") . " 00:00:01";;}



    
    //
}
