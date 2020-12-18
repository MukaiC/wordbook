<div class="container">
    <div class="card mt-5">
      <div class="card-header">Add a new word or phrase to your wordbook</div>
      <div class="card-body">
        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
              <label>Word / Phrase</label>
              <input type="text" name="entry" class="form-control" value="<?php echo $_POST['entry'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Meaning</label>
              <input type="text" name="meaning" class="form-control" value="<?php echo $_POST['meaning'] ?? ''; ?>">
          </div>
          <div class="form-group">
              <label>Notes</label>
              <textarea name="notes" class="form-control" rows="3"  placeholder="Grammar notes, examples ..."></textarea>
          </div>
          <input class="btn btn-outline-primary" type="submit" name="submit" value="Submit">
          <a class="btn btn-outline-danger" href="<?php echo ROOT_PATH; ?>words">Cancel</a>
        </form>
      </div>
    </div>
</div>
