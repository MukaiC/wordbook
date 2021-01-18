<div class="container">
  <?php if($viewmodel): ?>
    <div class="card mt-5">
      <div class="card-body">
        <div class="lead text-danger"><strong>Delete this word?</strong></div><br>

        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="word_id" value="<?php echo $viewmodel['id']; ?>">
          <div class="form-group">
              <label>Word / Phrase</label>
              <input readonly type="text" name="entry" class="form-control" value="<?php echo $viewmodel['entry'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Meaning</label>
              <input readonly type="text" name="meaning" class="form-control" value="<?php echo $viewmodel['meaning'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Notes</label>
              <textarea readonly name="notes" class="form-control" rows="3"  placeholder="Grammar notes, examples ..."><?php echo $viewmodel['notes'] ?? ''; ?></textarea>
          </div>
          <input class="btn btn-outline-danger" type="submit" name="submit" value="Delete">
          <a class="btn btn-outline-info" href="<?php echo ROOT_PATH; ?>words">Cancel</a>
        </form>
      </div>
    </div>
  <?php endif; ?>
</div>
