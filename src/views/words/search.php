<div class="container">
    <div class="card mt-5">
      <div class="card-header">Search your wordbook</div>
      <div class="card-body">
        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
              <label>Serch by Word / Phrase</label>
              <input type="text" name="search-entry" class="form-control">
          </div>
          <div class="form-group">
              <label>Search by Meaning</label>
              <input type="text" name="search-meaning" class="form-control">
          </div>

          <input class="btn btn-outline-primary" type="submit" name="submit" value="Search">
          <a class="btn btn-outline-danger" href="<?php echo ROOT_PATH; ?>words">Cancel</a>
        </form>
      </div>
    </div>
</div>
