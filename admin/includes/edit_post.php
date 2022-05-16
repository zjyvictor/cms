<?php

    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];


    }
    $query = "SELECT * FROM posts";
    $select_post_by_id = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_post_by_id)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_status = $row['post_status'];
        $post_content = $row['post_content'];
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <input value="<?php echo $post_category_id; ?>" type="text" class="form-control" name="post_category_id">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="title">Post Image</label>
        <img width="100" src="../images/<?php echo $post_image;?>">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
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
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
       
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
    
</form>