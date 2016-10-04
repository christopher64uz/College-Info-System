<?php

/*
 * This Code has been created by Christopher Uzhuthuval
 * for the Project College Information System.
 */

/**
 * Description of Ldap
 * 
 * Used for LDAP Authenticatons
 */
session_start();
include 'conf/constants.php';
include_once 'conf/DB.php';

class Ldap {
    private $username;
    private $password;
    public $ou;

    public function setUserPass($username,$password) {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function getUserPass() {
        echo $this->username;
        echo $this->password;       
    }
    
    public function ldapAuth() {        
        $ldapconn = ldap_connect(LDAP_SERVER) or die("Could not connect to LDAP server.");

        if ($ldapconn) 
        {	
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            if(LDAP_START_TLS)
                ldap_start_tls($ldapconn);

            $r=@ldap_search($ldapconn,LDAP_BASE_DN,"uid=".$this->username);

            if($r)
            {	
                $result = @ldap_get_entries($ldapconn, $r);

                if ($result[0])
                {
                    
                    if (@ldap_bind($ldapconn, $result[0]['dn'],  $this->password))
                    {
                        $this->ou = $result[0]['ou'][0];
                        if ( $this->ou != 'CE' && $this->ou != 'EXTC' && $this->ou != 'IT' && $this->ou != 'MECH' && $this->ou != 'Staff' && $this->ou != 'FE')
                        {
                            echo "<div style='background-color:#aabbcc;color:red;text-align:center;'><b> Not Applicable </b><br /></div>";                            
                        }
                        else
                        {                            
                            $_SESSION['ou'] = $result[0]['ou'][0];
                            $_SESSION['user'] = $this->username;                           
                            echo "<span />";
                        }
                    }
                    else
                    {
                        echo "<div style='background-color:#aabbcc;color:red;text-align:center;'><b> Incorrect Password </b><br /></div>";                        
                    }
                }
                else 
                {
                    echo "<div style='background-color:#aabbcc;color:red;text-align:center;'><b> Invalid Login </b><br /></div>";                   
                }
            }
            else 
            {
                echo "<div style='background-color:#aabbcc;color:red;text-align:center;'><b> Invalid Login </b><br /></div>";                
            }
        }
        ldap_close($ldapconn);
    }
    
    public function tempStudAuth() {
        $this->password = md5($this->password);
        
        $connDB = new DB();
        $connDB->connectDB();
        
        $chk_tempstudid = mysql_query("SELECT * FROM temp_studid WHERE username = '$this->username' AND passwd = '$this->password' AND Stud_ID = ''") 
        or die ("Error : " . mysql_error());
        
        if (mysql_num_rows($chk_tempstudid) > 0)
        {
            $_SESSION['ou'] = 'FE';
            $_SESSION['user'] = $this->username;            
            echo "<span />";
        }
        else 
        {
            echo "<div style='background-color:#aabbcc;color:red;text-align:center;'><b> Invalid Login </b><br /></div>";                   
        }
    }
    
}

?>
