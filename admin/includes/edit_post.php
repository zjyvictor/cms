<?php

    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];


    }
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_post_by_id = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_post_by_id)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_views_count = $row['post_views_count'];
    }

    if(isset($_POST['update_post'])){
        $post_category_id = $_POST['post_category'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];
    
        
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
            }
        }else{
            move_uploaded_file($post_image_temp,"../images/$post_image");
        }
        
        $query = "UPDATE posts SET ";
        $query .= "post_category_id = {$post_category_id}, ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_date = now(), ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_user = '{$post_user}', ";
        $query .= "post_comment_count = '{$post_comment_count}', ";
        $query .= "post_views_count = '{$post_views_count}' ";
        $query .= "WHERE post_id = {$the_post_id}";
        
        $update_post = mysqli_query($conn,$query);
        confirmQuery($update_post);
    
    }


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="">Post Category</label>
        <select name="post_category" id="">
    <?php
        $query = "SELECT * FROM categories";
        $select_category_by_id = mysqli_query($conn, $query);
        confirmQuery($select_category_by_id);
        while ($row = mysqli_fetch_assoc($select_category_by_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }
    ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="">Post Image</label>
        <img width="100" src="../images/<?php echo $post_image;?>">
        <input type="file" name="image">
    </div>
   
    <div class="form-group">
        <label for="">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
       
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
    
</form>