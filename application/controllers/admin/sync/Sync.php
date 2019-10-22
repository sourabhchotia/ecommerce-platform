<?php
    class Sync extends CI_Controller {
        private $tables;
        private $Checktables;
        function __construct() {
            parent::__construct();

            $tabel_check = $this->db->query("SHOW TABLES FROM `wholesale`");

            if($tabel_check->num_rows() > 0){
                $tables = array();
                foreach ($tabel_check->result() as $value) {
                    $col_check = "SHOW COLUMNS FROM `{$value->Tables_in_wholesale}`";
                    $col_exists = $this->db->query($col_check);
                    if ( $col_exists->num_rows() > 0 ) {
                        foreach ($col_exists->result() as $colname) {
                            $tables[$value->Tables_in_wholesale][] = $colname->Field;
                            $Checktables[$value->Tables_in_wholesale][] = $colname;
                        }
                    }
                }
                $this->tables = $tables;
                $this->Checktables = $Checktables;
            }
        }

        function index() {
            $newLine = "\r\n";
            $output = $update = "";

            foreach($this->tables as $table_name => $columns ){

                $col_check = "SHOW COLUMNS FROM `{$table_name}`";
                $col_exists = $this->db->query($col_check);

                
                if ( $col_exists->num_rows() > 0 ) {
                    $sql = "SELECT * FROM {$table_name} LIMIT 500" ;
                    $rows = $this->db->query($sql);

                    
                    if ( $rows->num_rows() > 0 ) {
                        foreach ( $rows->result_array() as $row ) {
                            $col_val = $update_col_val = $already_exists = array();
                            foreach($row as $name => $val) {
                                if ( is_null( $val ) ) {
                                    continue;
                                }
                                $val = $this->db->escape($val);
                                $update_col_val[] = " `{$name}` = {$val} ";
                                if ( "is_sync" === $name ) {
                                    $val = 1;
                                }
                                $col_val[] = " `{$name}` = {$val} ";
                                if ( $name === $columns[0] ){
                                    $already_exists[] = " `$columns[0]` = {$val}";
                                }
                            }
                            if ( is_array($col_val) && count($col_val) > 0 ) {
                                $output .= "SELECT * FROM `{$table_name}` WHERE " . implode(" AND ", $already_exists) . " ||";
                                $output .= "INSERT INTO `{$table_name}` SET " . implode(",", $col_val) . " ||";
                                $output .= "UPDATE `{$table_name}` SET " . implode(",", $col_val) . " WHERE " . implode(" AND ", $already_exists);
                                $output .= " ;; ";

                                // $update .= "UPDATE {$table_name} SET is_sync = 1 WHERE " . implode(" AND ", $update_col_val) . " ;; ";
                            }
                        }
                    }

                }
            }
            if ( !empty($output) && $this->post_data($output) ) {
                $update = explode(" ;; ", $update);
                foreach($update as $upq){
                    if (!empty($upq) ) {
                        $this->db->query($upq);
                    }
                }
            } else {
                echo $this->post_data($output);
            }

        }


        function online_data_sync() {

            if (isset( $_POST['qry'] ) ) {
                $tables = json_decode($_POST['tables']);
                foreach($tables as $tabel => $columns){
                    if($this->db->table_exists($tabel)){
                       foreach($columns as $column){
                           if($this->db->field_exists($column->Field, $tabel)){  
                           }else{
                               $columnname = $column->Field;
                               $type = $column->Type;
                               $Null = $column->Null;
                               $key = $column->Key;
                               $Default = $column->Default;
                               $Extra = $column->Extra;
                               if($Null == 'NO'){
                                   $null = 'NOT NULL';
                               }else{
                                   $null = 'NULL';
                               }
                               if($key == 'PRI'){
                                   $key = 'PRIMARY KEY';
                               }
                               $query = " ALTER TABLE {$tabel} ADD `{$columnname}` {$type} {$null} {$Extra} {$key}";
                               $this->db->query($query);
                           }
                       }
                    }else{
                        
                        $query = "create table {$tabel}(";
                        foreach($columns as $column){
                           if($this->db->field_exists($column->Field, $tabel)){ 
                           }else{
                               $columnname = $column->Field;
                               $type = $column->Type;
                               $Null = $column->Null;
                               $key = $column->Key;
                               $Default = $column->Default;
                               $Extra = $column->Extra;
                               if($Null == 'NO'){
                                   $null = 'NOT NULL';
                               }else{
                                   $null = 'NULL';
                               }
                               if($key == 'PRI'){
                                   $key = 'PRIMARY KEY';
                               }
                               $query .= "`{$columnname}` {$type} {$null} {$Extra} {$key},"; 
                           }
                       }
                       $query .= ");";
                       $this->db->query($query);
                    }
                }

                $qry = htmlspecialchars_decode( urldecode( $_POST['qry']));
                $qry = explode(" ;; ", $qry);
                foreach($qry as $q) {
                    $q = explode( "||", $q );
                    $exists = $this->db->query($q[0] ) or die ("<hr/>" . $this->db->error() ."<br/>" . $q[0]);

                    if ( $exists && $exists->num_rows() ) {
                        $this->db->query($q[2] ) or die ("<hr/>" . $this->db->error()."<br />".$q[2]);
                    } else{
                        $this->db->query($q[1] ) or die ("<hr/>" . $this->db->error()."<br />".$q[1]);
                    }
                }
                echo "hello";
            } else {
                echo "qry not found";
            }
        }

        function post_data($qry){
            $qry = htmlspecialchars(urlencode($qry));
            $data = "qry=" . $qry;
            $data .= "&tables=".json_encode($this->Checktables);
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, SERVER_SYNC );
            curl_setopt( $ch, CURLOPT_AUTOREFERER, 1);
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, array ( 'Content-length: ' . strlen($data) ) );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt( $ch, CURLOPT_POST,1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS,$data);
            curl_setopt( $ch, CURLOPT_CRLF, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            if ( 1 === intval($result) ) {
                return TRUE;
            } else {
                echo $result;
                return $result;
            }
        }
    }
?>