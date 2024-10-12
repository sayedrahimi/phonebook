<?php


class db
{
    protected $pdo;
    private $db;
    private $user;
    private $pass;
    private $tbl;

    public function __construct($db='phonebook',$user='root',$pass='')
    {
        $this->db=$db;
        $this->user=$user;
        $this->pass=$pass;
        $this->connection();
    }

    public function setTbl($tbl){
        $this->tbl = $tbl;
    }

    public function connection(){
        try{
            $this->pdo= new PDO("mysql:host=localhost;dbname={$this->db}", $this->user, $this->pass);
        }
        catch (Exception $e){
            die($e->getMessage());
        }

    }
    
    public function selectData($data){
        if(is_array($data)){
            $arr = "'".implode("','", $data)."'";
            $selectedData = $this->pdo->prepare("SELECT {$arr} FROM {$this->tbl}");
        }else{
            $selectedData = $this->pdo->prepare("SELECT {$data} FROM {$this->tbl}");
        }
        $selectedData->execute();
        $row= $selectedData->fetchAll(PDO::FETCH_OBJ);
        return$row;
    }

    public function insertData($field, $data){
        if(is_array($data)){
            $insertedData = "'".implode("','",$data)."'";
            $insertedField = implode(",",$field);
            $sql = $this->pdo->prepare("INSERT INTO {$this->tbl} ($insertedField) VALUES ($insertedData)");
            $sql->execute();
        }
    }

    public function updateData($fields, $datas, $id){
        foreach($fields as $key=>$value){
            $field[] = $value . "='" . $datas[$key]."'";
            
        }
        $query = implode(',', $field);
        $sql = $this->pdo->prepare("UPDATE {$this->tbl} SET {$query} WHERE id='$id'");
        $sql->execute();

    }

    public function deleteData($id){
        $sql = $this->pdo->prepare("DELETE FROM {$this->tbl} WHERE id='$id'");
        $sql->execute();
    }

    public function searchData($field, $value){
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tbl} WHERE $field= '$value'");
        $sql->execute();
        $row= $sql->fetchAll();
        return $row;
    }

    public function likeData($field, $value){
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tbl} WHERE $field LIKE $value");
        $sql->execute();
        $row= $sql->fetchAll();
        var_dump($row);
    }
}

$obj=new db();
$data = array("ali","sadat");
 $obj->setTbl('user_tbl');
 $obj->updateData(['name','email'],['rrrr','rrrrrrr@gmail.com'],2);