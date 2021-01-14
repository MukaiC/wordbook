<?php if($viewmodel): ?>
<h1 class="display-4">Edit: <?php echo $viewmodel['title']; ?></h1>
<p>Select to edit</p>
<form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="form-group">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" name="title_id" value="<?php echo $viewmodel['title'];?>" id="title">
      <label class="custom-control-label" for="title">Title: <?php echo $viewmodel['title'];?></label>
    </div>

    <?php $questions = $viewmodel['questions'] ?>
    <!-- Create checkbox -->
    <?php foreach ($questions as $question): ?>
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" name="question_id" value="<?php echo $question['id']; ?>" id="question<?php echo $question['id']; ?>">
      <label class="custom-control-label" for="question<?php echo $question['id']; ?>">Question: <?php echo $question['content'];?></label>
    </div>
    <?php endforeach; ?>
    <input class="btn btn-outline-primary" type="submit" name="submit" value="Submit">

    <a class="btn btn-outline-info" href="<?php echo ROOT_URL; ?>quizzes/manage">Cancel</a>

  </div>
  </form>


  <div class="container">
    <p>Select the questions to edit</p>
    <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <?php $questions = $viewmodel['questions'] ?>
        <!-- Create checkbox -->
        <?php foreach ($questions as $question): ?>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="question_id" value="<?php echo $question['id']; ?>" id="question<?php echo $question['id']; ?>">
          <label class="custom-control-label" for="question<?php echo $question['id']; ?>"><?php echo $question['content'];?></label>
        </div>
        <?php endforeach; ?>

      </div>
    </form>

  </div>


  <?php endif; ?>
