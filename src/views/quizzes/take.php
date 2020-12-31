<div class="container mt-5">

<?php if($viewmodel): ?>
<form class="form-check" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<?php if(isset($viewmodel)): ?>
  <!-- Keep track of the question number -->
  <?php $q_num=0; ?>
  <?php foreach($viewmodel as $key => $value): ?>
    <strong><?php echo $key; ?></strong><br><br>
    <?php $i=0; ?>
    <?php foreach($value as $item): ?>

      <input type="radio" name="choice<?php echo $q_num; ?>" value="<?php echo $i;?>" checked="checked"><?php echo $item[0]; ?><br>
      <?php $i++; ?>
    <?php endforeach; ?><br><br>
    <?php $q_num++; ?>
  <?php endforeach; ?>
<br>

<input class="btn btn-outline-primary" type="submit" name="submit" value="Submit">
<?php endif; ?>
<?php else: ?>
  <div class="container mt-5">

    <a href="<?php echo ROOT_PATH; ?>quizzes/create">Create a Quiz?</a>
  </div>

<?php endif; ?>
</form>
</div>
