<div class="container mb-5">
<h1 class="display-4"><?php echo $_SESSION['user_data']['name']; ?>'s Quizzes</h1><hr>

<?php if($viewmodel): ?>



  <div class="container mb-3">
    <?php foreach($viewmodel as $item): ?>

        <div class="card card-body border-light mb-2 bg-light">
          <h5 class="card-title">
            <a href="<?php echo ROOT_PATH."quizzes/take?id=".$item['id']; ?>"><?php echo $item['title']; ?></a>
            <a class="btn btn-sm btn-outline-info" href="<?php echo ROOT_PATH."quizzes/edit?quiz_id=".$item['id']; ?>">Edit</a>
            <a class="btn btn-sm btn-outline-danger" href="<?php echo ROOT_PATH."quizzes/delete?id=".$item['id']; ?>">Delete</a>

          </h5>
          <small><?php echo "{$item['created_at']}" ?></small>
        </div>
    <?php endforeach; ?>
  </div><br>

<?php endif; ?>
  <div class="container mb-3">
      <a class="btn btn-sm btn-outline-info" href="<?php echo ROOT_PATH; ?>quizzes/create">Create New</a>
      <a class="btn btn-sm btn-outline-info" href="<?php echo ROOT_PATH; ?>quizzes">Quizzes</a>
  </div>

</div>
