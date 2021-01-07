

<?php if($viewmodel): ?>
<!-- Store the quizz data in JS variable -->
<!-- create JSON array of questions -->
<?php $questions = json_encode (array_keys($viewmodel), JSON_UNESCAPED_UNICODE); ?>
<!-- encode quiz data to JSON format -->
<?php $quizData = json_encode($viewmodel, JSON_UNESCAPED_UNICODE); ?>
<?php /*echo $quizData;*/ ?>

<script type="text/javascript">
  // pass questions and quizData to javascript
  var questions = <?php echo $questions; ?>;
  var quizData = <?php echo $quizData; ?>;

</script>
<form class="container mb-3" id="form">
  <h1 id="question"></h1><hr><br>
  <div id="choices">
  </div>
  <input class="btn btn-outline-primary" id="submit" type="submit" name="submit" value="Submit">
</form>

<script type="text/javascript" src="<?php echo ROOT_URL; ?>assets/JS/quiz.js"></script>
<?php endif; ?>
