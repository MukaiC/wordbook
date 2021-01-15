
<div class="container mb-5">

<h1 class="display-4">QUIZZES</h1><hr>

<?php if($viewmodel): ?>
  <div class="container mb-3">
    <?php foreach($viewmodel as $item): ?>
        <div class="card card-body border-light mb-2 bg-light">
          <h5 class="card-title"><a href="<?php echo ROOT_PATH."quizzes/take?id=".$item['id']; ?>"><?php echo $item['title']; ?></a></h5>
          <small><?php echo "by {$item['name']}" ?></small>
        </div>
    <?php endforeach; ?>
  </div><br>
<?php endif; ?>

  <div class="container mb-3">
      <a class="btn btn-sm btn-outline-info" href="<?php echo ROOT_PATH; ?>quizzes/create">Create Quizzes</a>
      <a class="btn btn-sm btn-outline-info" href="<?php echo ROOT_PATH; ?>quizzes/manage">Manage my Quizzes</a>
  </div>

</div>
