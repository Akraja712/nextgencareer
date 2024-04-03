<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php

if (isset($_GET['id'])) {
	$ID = $db->escapeString($_GET['id']);
} else {
	// $ID = "";
	return false;
	exit(0);
}
if (isset($_POST['btnEdit'])) {


    $question = $db->escapeString(($_POST['question']));
    $answer = $db->escapeString(($_POST['answer']));
	$error = array();

{

$sql_query = "UPDATE faq SET question='$question',answer='$answer' WHERE id =  $ID";
$db->sql($sql_query);
$update_result = $db->getResult();
if (!empty($update_result)) {
   $update_result = 0;
} else {
   $update_result = 1;
}

// check update result
if ($update_result == 1) {
   $error['update_jobs'] = " <section class='content-header'><span class='label label-success'>Faq updated Successfully</span></section>";
} else {
   $error['update_jobs'] = " <span class='label label-danger'>Failed to Update</span>";
}
}
}


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM faq WHERE id = $ID";
$db->sql($sql_query);
$res = $db->getResult();


if (isset($_POST['btnCancel'])) { ?>
<script>
window.location.href = "faq.php";
</script>
<?php } ?>

<section class="content-header">
	<h1>
		Edit Faq<small><a href='faq.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Faq</a></small></h1>
	<small><?php echo isset($error['update_jobs']) ? $error['update_jobs'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-10">

			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				</div><!-- /.box-header -->
				<!-- form start -->
				<form name="add_slide_form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Question</label><i class="text-danger asterik">*</i><?php echo isset($error['question']) ? $error['question'] : ''; ?>
                                    <input type="text" class="form-control" name="question" value="<?php echo $res[0]['question']?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Answer</label><i class="text-danger asterik">*</i><?php echo isset($error['answer']) ? $error['answer'] : ''; ?>
                                    <input type="text" class="form-control" name="answer" value="<?php echo $res[0]['answer']?>">
                                </div>
                            </div>
                         </div>
                         <br>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>

					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>