<!DOCTYPE html>
<html>
<head>
	<title>Library System</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>

<!------ Include the above in your HEAD tag ---------->

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" >

<fieldset>

<!-- Form Name -->
<legend>Books</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Title</label>  
  <div class="col-md-4">
  <input id="title" name="title" placeholder="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"  type="text" >
  <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
  
   
  </div>
</div>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rate">Rate</label>  
  <div class="col-md-4">
  <input id="rate" name="rate" type="number" placeholder="Rate" class="form-control form-control-lg <?php echo (!empty($data['rate_err'])) ? 'is-invalid' : ''; ?>"  type="text">
  <span class="invalid-feedback"><?php echo $data['rate_err']; ?></span>
 
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="author_id">Author ID</label>
  <div class="col-md-4">                     
    <input  class="form-control form-control-lg <?php echo (!empty($data['author_id_err'])) ? 'is-invalid' : ''; ?>" id="author_id" name="author_id" placeholder="Author ID" type="number">
 <span class="invalid-feedback"><?php echo $data['author_id_err']; ?></span>
  </div>
</div>



<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="published_at">Published At</label>  
  <div class="col-md-4">
  <input id="published_at" name="published_at" placeholder="Published At" class="form-control form-control-lg <?php echo (!empty($data['published_at_err'])) ? 'is-invalid' : ''; ?>" type="date">
  <span class="invalid-feedback"><?php echo $data['published_at_err']; ?></span>
   
  </div>
</div>

    
 <!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="image_path">Image</label>
  <div class="col-md-4">
    <input id="image_path" name="image_path" class="input-file" type="file">
   
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="author_name">title</label>  
  <div class="col-md-4">
  <input id="author_name" name="author_name" placeholder="Author_Name" class="form-control form-control-lg <?php echo (!empty($data['author_name_err'])) ? 'is-invalid' : ''; ?>" type="text">
  <span class="invalid-feedback"><?php echo $data['author_name_err']; ?></span>
   
  	  
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="add">Add</label>
  <div class="col-md-4">
    <button id="add" name="add" type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>
</body>
</html>

