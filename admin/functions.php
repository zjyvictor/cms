<?php

function confirmQuery($result){
    global $conn;
    if(!$result){
        die('QUERY FAILED .' . mysqli_error($conn));
    }
}

function insert_category(){
    global $conn;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }else{
            $query = "INSERT INTO categories (cat_title) ";
            $query .= "VALUES ('{$cat_title}') ";

            $create_category_query = mysqli_query($conn,$query);
            if(!$create_category_query){
                die('Query FAILED'. mysqli_error($conn));
            }
        }
    }
}


function findAllCategories(){
    global $conn;
    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($select_all_categories_query)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategory(){
    global $conn;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($conn,$query);
        if(!$delete_query){
            die('Query FAILED!' . mysqli_error($conn));
        }else{
            
            header("refresh:3;url=categories.php");
  
            echo "<h3>DELETE 1 row (ID: {$the_cat_id}) successfully!</h3>";
        }
    }
}
?>