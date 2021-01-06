
<div class="container mb-5">
<h1>QUIZZES</h1><hr><br>
<?php if($viewmodel): ?>
  <div class="container mb-3">
    <!-- <h2>Take a Quiz?</h2> -->
    <?php foreach($viewmodel as $item): ?>
        <div class="card card-body border-light mb-2 bg-light">
          <h5 class="card-title"><a href="<?php echo ROOT_PATH."quizzes/take?id=".$item['id']; ?>"><?php echo $item['title']; ?></a></h5>
          <small><?php echo "by {$item['name']}" ?></small>
        </div>
    <?php endforeach; ?>
      <!-- <a class="btn btn-outline-primary" href="<?php echo ROOT_PATH; ?>quizzes/take">Take Quiz</a> -->
  </div><br>
<?php endif; ?>

  <div class="container mb-3">
    <!-- <h2>Create New Quiz</h2> -->
      <a class="btn btn-sm btn-outline-info" href="<?php echo ROOT_PATH; ?>quizzes/create">Create Quiz</a>
  </div>
</div>
