<?php
include "../koneksi.php";
    class log
    {  
        public CONST Environment = 'developemnt';
    
        private $id;
        protected $log_action;
        protected $username;
        protected $page;
        protected $ip;
        protected $log_name;
        private $user_id;
    
        public function __construct(string $log_action, string $username, string $log_name)
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            
            if(!empty($_SESSION['id'])){
                $id = $_SESSION['id'];
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
            } else {
                $id = 0;
            }
            $this->log_action = $log_action;
            $this->username = $username;
            $this->log_name = $log_name;
            $this->user_id = $id;
            $this->page =  basename($_SERVER['PHP_SELF']);
            $this->ip = $ip;
        }
    
        public function createAction()
        {
            global $conn;
    
            if(!$conn) {
               echo mysqli_error($conn); die;
            }
            $sql = "INSERT INTO tbl_test_log ('log_action','username','log_name','page','user_id','ip') values ('".$this->log_action."','".$this->username."','".$this->log_name."','".$this->page."','".$this->user_id."','".$this->ip."')" ;
            $sql_query = mysqli_query($conn,$sql);
            if(!$sql_query){
                echo mysqli_error($conn); die;
            }
    
            // if(Environment == 'development'){
            //     $_SESSION['msg'] = 'A new log was created ' . $this->log_name;
            // }
            
        }
    } 
 ?>