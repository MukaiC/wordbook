<div class="container mt-4 mb-4">

  <div class="container mb-3">
    <!-- Link to add new word page -->
    <a class="btn btn-info mb-3" href="<?php echo ROOT_PATH; ?>words/add">Add new word or phrase</a>
    <!-- Search bar -->
    <form class="form-inline float-right" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

      <input type="text" name="keyword" class="form-control" placeholder="Search in my WordBook">
      <div class="btn-group">
        <input class="btn btn-info" type="submit" name="submit" value="Search">
        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        </button>
        <div class="dropdown-menu">
          <input class="btn dropdown-item" type="submit" name="submit" value="Search meaning">
          <input class="btn dropdown-item" type="submit" name="submit" value="Search notes">
        </div>
      </div>
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
