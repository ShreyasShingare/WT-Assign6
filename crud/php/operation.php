<?php
require_once("db.php");
require_once("component.php");

$con=Createdb();

//create button click

if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    UpdateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}




function createData(){
    $bookname = textboxValue("book_name");  //calling text from textbox book_name
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");

    if($bookname && $bookpublisher && $bookprice){
        $sql = "INSERT INTO books(book_name,book_publisher,book_price)    
        VALUES('$bookname','$bookpublisher','$bookprice')";    //inserting values received into the particular fields in the database

        if(mysqli_query($GLOBALS['con'],$sql)){
            TextNode("success","Record Successfully inserted");    //to give essage if data is successfully inserted into database
               
        }else{
            echo"Error";
        }
    }else{
        TextNode("error","textbox cant be empty");    //to give message if text field is empty

    }
}

function textboxValue($value){
$textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));  //trim function to save from sql injection
    if(empty($textbox)){
        return false;    //check if the textbox is empty
    }else{
        return $textbox;
    }
}

//messages : function to give out message 

function TextNode($classname,$msg){
    $element="<h6 class='$classname'>$msg</h6>";
    echo $element;
}

//to get data from mysql database
function getData(){                   //this function is called when the read button is pressed
    $sql = "SELECT * FROM books";    //sql statement to get all the field values

    $result=mysqli_query($GLOBALS['con'],$sql);    //this will return a statement and we store it in result variable

    if(mysqli_num_rows($result)>0){    //this function returns number of rows in result var
        return $result;
    }    



}

function UpdateData(){
    $bookid=textboxValue("book_id");
    $bookname=textboxValue("book_name");
    $bookpublisher=textboxValue("book_publisher");
    $bookprice=textboxValue("book_price");

    if($bookname && $bookpublisher && $bookprice)  {
        $sql ="
        UPDATE books SET book_name='$bookname',book_publisher = '$bookpublisher',book_price='$bookprice' WHERE id='$bookid';
    
        ";

        if(mysqli_query($GLOBALS['con'],$sql)){
            TextNode("success","Data Successfully Updated");
        }else{
            TextNode("error","Unable to update Data");

        }

    }else{
        TextNode("error","select data using edit icon");
    }
}

function deleteRecord(){
    $bookid = (int)textboxValue("book_id");

    $sql="DELETE FROM books WHERE id=$bookid";

    if(mysqli_query($GLOBALS['con'],$sql)){
        TextNode("success","Record deleted successfully");
    }else{
        TextNode("error","Unable to Delete");
    }

}