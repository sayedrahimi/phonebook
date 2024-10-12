<?php

    $name="Sayed Rahim";
    $lastName="Rahim";
    $password= 123;
    $email="F@R.com";

    $pdo = new PDO("mysql:host=localhost;dbname=phonebook","root","");
    $sql = $pdo->prepare("INSERT INTO user_tbl (name, email, password, lastname) VALUES (:name, :email, :password, :lastName)");
    
    $sql->bindParam('name',$name);
    $sql->bindParam('email',$email);
    $sql->bindParam('password',$password);
    $sql->bindParam('lastName',$lastName);

    $sql->execute();

?>