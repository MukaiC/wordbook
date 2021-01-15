<div class="container mb-5">


<?php if($viewmodel): ?>
<h1 class="display-4">Edit Quiz: <?php echo $viewmodel['title']; ?></h1>

<div class="container mt-3 mb-5">
<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name="num-questions" value="<?php echo $viewmodel['num_questions']; ?>">
  <!-- Title -->
  <div class="form-group">
    <label><strong>Title:</strong></label>
      <input type="text" name="title" id="title" class="form-control" value="<?php echo $viewmodel['title'] ?? ''; ?>">
      <input type="hidden" name="quiz-id" value="<?php echo $viewmodel['quiz_id']; ?>">
  </div>
</div>

<!-- Questions -->
<div class="container mb-3">
  <?php $questions = $viewmodel['questions'] ?>

  <?php $q=1; ?>
  <?php foreach ($questions as $key => $value): ?>
    <div class="form-group">
      <label><strong>Question <?php echo $q; ?></strong></label>
        <input type="hidden" name="question<?php echo $q; ?>-id" value="<?php echo $key; ?>">
        <input type="text" name="question<?php echo $q; ?>" class="form-control" value="<?php echo $value[0]['0'] ?? ''; ?>">
    </div>
<!-- Answer options -->
    <?php $a=1; ?>
    <div class="container form-group">
      <?php foreach($value as $item): ?>
      <label>option <?php echo $a; ?></label>
        <input type="hidden" name="question<?php echo $q; ?>option<?php echo $a; ?>-id" value="<?php echo $item['id']; ?>">
        <input type="radio" name="correct<?php echo $q; ?>" value="option<?php echo $a; ?>" id=option<?php echo $a; ?>
        <?php if($item['is_answer'] == 1){echo 'checked';}; ?>>
        <label for="option<?php echo $a; ?>">This is the answer</label><br>
        <input type="text" name="question<?php echo $q; ?>option<?php echo $a; ?>" class="form-control" value="<?php echo $item['2'] ?? ''; ?>"><br>
        <?php $a++; ?>
      <?php endforeach; ?>
    </div>
    <?php $q++; ?>
    <?php endforeach; ?>

    <input class="btn btn-outline-primary" type="submit" name="submit" value="Edit" id="submit">
    <a class="btn btn-sm btn-outline-danger" href="<?php echo ROOT_URL; ?>quizzes/manage">Cancel</a>
  </div>
</form>



<?php endif; ?>

</div>
