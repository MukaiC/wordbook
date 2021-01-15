

<?php if($viewmodel): ?>
<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<div class="container">

<p class="delete">Delete <strong><?php echo $viewmodel['title']; ?></strong>?</p><br>
<input type="hidden" name="quiz_id" value="<?php echo$viewmodel['id']; ?>">

<input class="btn btn-outline-danger" type="submit" name="submit" value="Delete">
<a class="btn btn-outline-info" href="<?php echo ROOT_URL; ?>quizzes/manage">Cancel</a>
</div>
</form>

<?php endif; ?>
