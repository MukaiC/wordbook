

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
  var hrefQuizzes = "<?php echo ROOT_URL; ?>quizzes";

</script>

<form class="container mb-3" id="form">
  <h1 class="display-4 mt-5" id="question"></h1><hr><br>
  <div class="container mb-3" id="choices">
  </div>
  <button type="button" class="btn btn-outline-primary" name="button" id="submit">Submit</button>

</form>

<div class="container" id="result">
</div>

<script type="text/javascript" src="<?php echo ROOT_URL; ?>assets/JS/quiz.js"></script>
<?php endif; ?>
