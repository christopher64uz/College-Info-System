<?php

/*
 * This Code has been created by Christopher Uzhuthuval
 * for the Project College Information System.
 */

/**
 * Description of DB
 *
 * The instance of this which is used for DB connectivity 
 */

class DB {
    private $databaseHost; 
    private $databaseUname;
    private $databasePword;
    private $databaseName;
    
    function __construct() {
        $this->databaseHost = "localhost";
        $this->databaseUname = "root";
        $this->databasePword = "christopher";        
    }
    
    public function connectDB() {
        $this->databaseName = "College_Automation";
        
        $conn = mysql_connect($this->databaseHost, $this->databaseUname, $this->databasePword);
        if (!$conn)
        {
            die("DB Connectivity failed ".mysql_error());
        }
        mysql_select_db($this->databaseName, $conn);        
    }

}

?>



