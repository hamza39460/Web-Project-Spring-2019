    <?php
    class database
    {
        private $servername = "localhost";
        private $userName = "root";
        private $password = "";
        private $db = "flexq";
        private $conn = null;

        public function __construct()
        { }
        public function __init($usr, $pwd)
        {
            $this->userName = $usr;
            $this->password = $pwd;
        }
        public function setUsername($usr)
        {
            $this->userName = $usr;
        }
        public function getUsername()
        {
            return $this->userName;
        }
        public function setPassword($pwd)
        {
            $this->password = $pwd;
        }
        public function getPassword()
        {
            return $this->password;
        }
        public function startRootConnection()
        { }
        public function checkLogin()
        {
            $this->conn = mysqli_connect($this->servername, $this->userName, $this->password, $this->db);
            if (!$this->conn) {
                echo "0";
            } else {
                SESSION_start();
                $_SESSION["username"] = $this->userName;
                $_SESSION["pwd"] = $this->password;
                echo "1";
            }
        }
        public function startDBConnection()
        {
            $this->conn = mysqli_connect($this->servername, $this->userName, $this->password, $this->db);
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            echo (mysqli_connect_error());
            return $this->conn;
        }
        public function execQuery($str)
        {
            if ($this->conn->query($str) === false) {
                echo "0";
            } else
                echo "1";
        }
        public function execMultiQuery($str)
        {
            $b = true;
            for ($i = 0; $i < count($str); $i++) {
                if ($this->conn->query($str[$i]) === false) {
                    $b = false;
                } else
                    $b = true;
            }
            if ($b)
                echo "1";
            else
                echo "1";
        }
        public function execSelectQuery($str)
        {
            return  $this->conn->query($str);
        }
    }

    ?>
