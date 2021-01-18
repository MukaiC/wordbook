<div class="container">
  <?php if($viewmodel): ?>
    <div class="card mt-5">
      <div class="card-header">Edit</div>
      <div class="card-body">

        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="word_id" value="<?php echo $viewmodel['id']; ?>">
          <div class="form-group">
              <label>Word / Phrase</label>
              <input type="text" name="entry" class="form-control" value="<?php echo $viewmodel['entry'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Meaning</label>
              <input type="text" name="meaning" class="form-control" value="<?php echo $viewmodel['meaning'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Notes</label>
              <textarea name="notes" class="form-control" rows="3"  placeholder="Grammar notes, examples ..."><?php echo $viewmodel['notes'] ?? ''; ?></textarea>
          </div>
          <input class="btn btn-outline-primary" type="submit" name="submit" value="Submit">
          <a class="btn btn-outline-danger" href="<?php echo ROOT_PATH; ?>words">Cancel</a>
        </form>
      </div>
    </div>
  <?php endif; ?>
</div>
