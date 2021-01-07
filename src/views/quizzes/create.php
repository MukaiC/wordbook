<div class="container mb-5">
    <div class="card mt-5">
    <div class="card-header">QUIZ</div>
      <div class="card-body">
      <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label>Quiz Title:</label>

          <?php if(isset($_SESSION['create_data'])): ?>
            <input type="text" readonly name="title" class="form-control-plaintext" value="<?php echo $_SESSION['create_data']['title'] ?? ''; ?>">
          <?php else: ?>
            <input type="text" name="title" class="form-control" placeholder="Write a title for your quiz-set" value="<?php echo $_POST['title'] ?? ''; ?>">
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="card mt-5">
      <div class="card-header">Create Questions</div>
        <div class="card-body">

        <div class="container mb-2">
          <div class="form-group">
          <?php if(isset($_SESSION['create_data'])): ?>
            <label><strong>Question <?php echo $_SESSION['create_data']['num_question']+1; ?>:</strong></label>
            <input type="text" name="question" class="form-control" value="<?php echo $_POST["question"] ?? ''; ?>">
          <?php else: ?>
            <label><strong>Question 1:</strong></label>
            <input type="text" name="question" class="form-control" value="<?php echo $_POST["question"] ?? ''; ?>">
          <?php endif; ?>
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
        </div>
        <div class="container">
          <input class="btn btn-outline-primary" type="submit" name="submit" value="Submit this question and enter another">
          <?php if(isset($_SESSION['create_data'])): ?>
          <input class="btn btn-outline-success" type="submit" name="submit-last" value="This is the last question">
          <?php endif; ?>
        </div>
        <div class="container mt-4">
            <input class="btn btn-sm btn-outline-danger" type="submit" name="cancel" value="Cancel this quiz">
            <small>This action will delete this quiz and all the related questions saved</small>
        </div>
        </form>



      </div>


    </div>
</div>
