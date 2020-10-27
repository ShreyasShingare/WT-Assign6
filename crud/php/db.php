<?php

function Createdb(){
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="bookstore";

    //creating connection
    $con=mysqli_connect($servername,$username,$password);


    //checking connection
    if(!$con){
        die("Connection Failed:".mysqli_connect_error());
    }

    //create database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if(mysqli_query($con,$sql)){    //creating database using mySQLi query
        $con=mysqli_connect($servername,$username,$password,$dbname);
                                    //creating table using sql query
        $sql="                       
            CREATE TABLE IF NOT EXISTS books(    
                id INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                book_name VARCHAR(25) NOT NULL,
                book_publisher VARCHAR(20),
                book_price FLOAT
            );
        ";

        if(mysqli_query($con,$sql)){
            return $con;
        }else{
            echo"Cant create table";
        }

    }else{
        echo"Error in creating database".mysqli_error($con);
    }


}