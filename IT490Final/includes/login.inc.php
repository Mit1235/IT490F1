  
  <?php 
  
  require_once('../rabbitmqphp_example/path.inc');
    require_once('../rabbitmqphp_example/get_host_info.inc');
    require_once('../rabbitmqphp_example/rabbitMQLib.inc');
    require_once('testRabbitMQClient.php');


    $username = $_POST['username'];
    $password = $_POST['password'];
   

    function gateway(){
        if (!$_SESSION["logged"]){
            header("Location: ../html/index.html");
        }
    }

    function login($username, $password){        
        $request = array();
        $request['type'] = "Login";
        $request['username'] = $username;
        $request['email'] = $email;
        $request['password'] = $password;
        $data = Client($request);
        
        if($data == 1){
            $_SESSION["username"] = $username;
            $_SESSION["logged"] = true;
        }else{
            session_destroy();
        }
        return $data;
    }
    ?>
