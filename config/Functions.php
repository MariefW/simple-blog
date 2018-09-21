<?php
//including the database connection file
// include_once("config/dbConnect.php");

include_once("Sessions.php") ;

class Functions extends Session {
    private $db;

    function __construct(){
        include_once("dbConnect.php");

        session_start();
        $this->db = $dbConn;
    }

    function fetchAll($table, $column = null, $order = "id DESC"){
        if($column != null) {
            if(is_array($column)){
                $columns = implode(",",$column);
            }
            $result = $this->db->query("SELECT {$columns} FROM {$table} ORDER BY {$order}");
        }else{
            $result = $this->db->query("SELECT * FROM {$table} ORDER BY {$order}");
        }
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch($table, $id){
      $id = $_GET['id'];
      $stmt = $this->db->prepare("SELECT * FROM blogs WHERE id=:id");
      $stmt->execute(array(':id' => $id));
    }

    function createpost($title="", $desc="", $postedDate="", $postedBy=""){

      $title = filter_var($title, FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS );
      $desc = filter_var($desc, FILTER_SANITIZE_SPECIAL_CHARS);
      $postedDate = filter_var($postedDate, FILTER_SANITIZE_SPECIAL_CHARS);
      $postedBy = filter_var($postedBy, FILTER_SANITIZE_SPECIAL_CHARS);

      $stmt = $this->db->prepare("INSERT INTO blogs(title,description,postedDate,postedBy) VALUES(:title, :desc, :postedDate, :postedBy)");
      $stmt->bindparam(':title', $title, PDO::PARAM_STR);
      $stmt->bindparam(':desc', $desc, PDO::PARAM_STR);
      $stmt->bindparam(':postedDate', $postedDate, PDO::PARAM_STR);
      $stmt->bindparam(':postedBy', $postedBy, PDO::PARAM_STR);
      $stmt->execute();
      header('Location: index.php');
      exit();
    }

    function deletepost($id){
      $stmt = $this->db->prepare("DELETE FROM blogs WHERE id=:id");
      $stmt->execute(array(':id'=>$id));
      header('Location: index.php');
      exit();

    }

    // function editpost(){
    //   $stmt = $this->db->prepare("UPDATE blogs SET title=:title, description=:desc, postedDate=:postedDate , postedBy=:postedBy WHERE id=:id");
    //   $stmt->bindparam(':title', $title);
    //   $stmt->bindparam(':desc', $desc);
    //   $stmt->bindparam(':postedDate', $postedDate);
    //   $stmt->bindparam(':postedBy', $postedBy);
    //   $stmt->execute();
    //   header('Location: index.php');
    //   exit();
    //
    // }

    function rowCount($table){
        return $this->db->query("SELECT * FROM {$table}")->rowCount();
    }

    function signIn($username, $password, $hash = 'sha256'){
        try{
            $hash_password = hash($hash, $password);
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:var1 AND password=:var2");
            $stmt->bindParam("var1", $username,PDO::PARAM_STR) ;
            $stmt->bindParam("var2", $hash_password,PDO::PARAM_STR) ;
            $stmt->execute();
            $data_user = $stmt->fetch(PDO::FETCH_OBJ);
            if($stmt->rowCount() > 0){
                $data_session = array("login" => true, "fullname" => $data_user->fullname, "userType" => $data_user->userType);
                $this-> createSession($data_session);

                return array("success" => true, "error" => '');
            }else{
                return array("success" => false, "error" => 'Kombinasi Username dan Password salah');
            }
        }catch(PDOException $e){
            echo '{"error":{"text":'. $e->getMessage() .'}}';
            return false;
        }
    }

    function signOut(){
        $this->deleteSession();
        return true;
    }

}

?>
