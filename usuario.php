<?php



class Usuario{
    private $id;
    private $email;
    private $senha;
    private $pdo;

    function getId(){
        return $this->id;
    }
    function getEmail(){
        return $this->email;
    }
    function getSenha(){
        return $this->senha;
    }
    function setEmail($email){
        $this->email = $email;
    }
    function setSenha($senha){
        $this->senha = $senha;
    }

    function __construct(){
      
        $dsn    = "mysql:dbname=usuarioetimpwiii;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO($dsn, $dbUser, $dbPass);
           return true;             
        } catch (\Throwable $problema) {
            return false;
               
        } 
    }

    function checkUserPass($email, $senha){
        $sql = "SELECT *FROM usuarios WHERE email = :e AND senha =:s";
        $sql = $this->pdo->prepare($sql);
        
        $sql-> bindValue(":e", $email);
        $sql-> bindValue(":s", $senha);
        $sql->execute();
        
        if( $sql->rowCount() > 0 ){
            return true;           
        }else{
            return false;
        }

    }

    
    function checkUser($email){
        $sql = "SELECT *FROM usuarios WHERE email = :e";
        $sql = $this->pdo->prepare($sql);

        $sql-> bindValue(":e", $email);
        $sql->execute();

        if( $sql->rowCount() > 0 ){
            return true;           
        }else{
            return false;
        }

        
    }
}