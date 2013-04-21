<?php
namespace SYSTEM\DB;

class DBInfoMYS extends \SYSTEM\DB\DBInfo {

    public function __construct($database , $user , $password, $host, $port = null){
        $this->m_database = $database;
        $this->m_user = $user;
        $this->m_password = $password;
        $this->m_host = $host;
        $this->m_port = $port;

        if( $this->m_database == null ||
            $this->m_user == null ||
            $this->m_password == null ||
            $this->m_host == null){
            throw new \Exception("DBInfo not correct, database, user, password or host are null");}
    }    
}