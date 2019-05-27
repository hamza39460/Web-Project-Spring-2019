    <?php
    class database{
        private $servername = "localhost";
        private $userName = "root";
        private $password = "";
        private $db ="flexq";
        private $conn =null;
        
        public function __construct(){

        }
        public function __init($usr,$pwd){
            $this->userName=$usr;
            $this->password=$pwd;
        }
        public function setUsername($usr) {
            $this->userName = $usr;
        }
        public function getUsername() {
            return $this->userName;
        }
        public function setPassword($pwd) {
            $this->password = $pwd;
        }
        public function getPassword() {
            return $this->password;
        }
        public function getConnection() {
            return $this->conn;
        }
        public function startRootConnection(){
            
        }
        public function checkLogin(){
            $this->conn = mysqli_connect($this->servername, $this->userName, $this->password,$this->db);
            if (!$this->conn) {
                echo "0";
            }
            else{
            $str = "select * from student where ID='" . $this->userName . "';";
            $rs = mysqli_query($this->conn, $str);
            if (mysqli_num_rows($rs) <= 0)
                echo "0";
            else
            {
            SESSION_start();
            $_SESSION["username"]=$this->userName; 
            $_SESSION["pwd"]=$this->password;
            $qry="select profile from flexq.student where ID='$this->userName'";
            $_SESSION["profile"]=mysqli_fetch_array(mysqli_query($this->conn,$qry))["profile"];
            $_SESSION["usertype"]="student";
            echo "1";
            }
        }
        }
        public function startDBConnection(){
            $this->conn = mysqli_connect($this->servername, $this->userName, $this->password,$this->db);
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            echo (mysqli_connect_error());
            return $this->conn;
        }
        public function execQuery($str){
            if($this->conn->query($str) === false){
                echo "0";
            }
            else
                echo "1";
            
        }
        public function execQuery1($str){
            if($this->conn->query($str) === false){
                return false;
            }
            else
                return true;
            
        }
        public function execSelectQuery($str){
             return  $this->conn->query($str);
        }
    }

    ?>
