This is views/quizzes/create
<div class="container">
    <div class="card mt-5">
      <div class="card-header">Create a quiz</div>
      <div class="card-body">
        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
              <label>Question:</label>
              <input type="text" name="question" class="form-control" value="<?php echo $_POST['question'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Answer Options (Mark the correct answer)</label><br>
              <?php for($i = 1; $i < 5; $i++): ?>
                <label>Option <?php echo $i; ?>:</label>
                <input type="radio" name="correct" value="<?php echo $i; ?>">
                <input type="text" name="<?php echo "option{$i}"; ?>" class="form-control" value="<?php echo $_POST["option{$i}"] ?? ''; ?>">
                <br>
              <?php endfor; ?>
          </div>

          <input class="btn btn-outline-primary" type="submit" name="submit" value="Submit">
          <a class="btn btn-outline-danger" href="<?php echo ROOT_PATH; ?>quizzes">Cancel</a>
        </form>
      </div>
    </div>
</div>
