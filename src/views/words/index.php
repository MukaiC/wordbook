<div class="container mt-4 mb-4">

  <div class="container mb-3">

    <a class="btn btn-info mb-3" href="<?php echo ROOT_PATH; ?>words/add">Add new word or phrase</a>

    <form class="form-inline float-right" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

        <input type="text" name="keyword" class="form-control" placeholder="Search in my WordBook">

      <input class="btn btn-primary" type="submit" name="submit" value="Search">
    </form>
  </div>

  <div class="container mt-4">

    <?php if(!$viewmodel) : ?>
      <h5><?php echo 'No entries yet.<br> Add new words or phrases!' ?></h5>
    <?php else: ?>
      <?php foreach($viewmodel as $item) : ?>
        <div class="card card-body border-info mb-2 bg-light">
          <h4><?php echo $item['entry']; ?></h4>
          <p><?php echo $item['meaning'] ?></p><hr>
          <?php if($item['notes'] !== '') : ?>
          <p><?php echo $item['notes']; ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
