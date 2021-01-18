// To check if php variable are available in js
console.log(quizData);
console.log(questions);

document.addEventListener('DOMContentLoaded',
  () => {
    // Keep track of the score
    var numCorrect = 0;
    // Set the question number
    var numQuestion = 0;
    // Display the current question and multiple choice answers
    display_question(numQuestion);

    // When the answer is submitted
    // document.querySelector('#form').onsubmit = () => {
    document.querySelector('#submit').onclick = () => {
      // check if an answer is selected, if selected retrieve the value, otherwise alert to select
      // document.querySelector('#alert').innerHTML = '';
      var selected = document.querySelector('input[name=answer]:checked');
      var question = questions[numQuestion];
      var choices = quizData[question];
      if (selected != null){
        // Retrieve the value of selected answer
        let value = selected.value;
        // Check if the selected answer is correct
        let is_answer = choices[value]['is_answer'];
        // console.log(is_answer);
        if (is_answer == 1){
          // alert('Correct!');
          numCorrect++;
          var alertMessage = 'Correct';
        } else {
          // Loop through the options and get the correct answer
          for(i=0; i<choices.length; i++){
            if(choices[i]['is_answer'] == 1){
              var correctAnswer = choices[i]['content'];
              // var correctAnswer = choices[i]['content'].toUpperCase();
              break;
            }
          };
          var alertMessage = 'Incorrect';
        }

        // Update numQuestion
        numQuestion++;
        // Give feedback after each question
        alert_result(alertMessage, correctAnswer, numQuestion, numCorrect);
      } else {
        alert('Select an answer');
      }
      return false;
    }
  });

// Show if the selected answer is correct or not
function alert_result(alertMessage, correctAnswer, numQuestion, numCorrect){
  // Hide submit button;
  document.querySelector('#submit').style.display = 'none';
  let alert = document.createElement('div');
  let nextButton = document.createElement('button');
  nextButton.className = 'btn btn-outline-info';
  // nextButton.id = 'next';
  nextButton.innerHTML = 'Next';

  // Check if it is the last question
  if(numQuestion < questions.length){
    // Click on next button will display the next question
    nextButton.onclick = function() {
      display_question(numQuestion);
    }
  } else {
    // !!!
    nextButton.innerHTML = 'Result';
    // Click on next button sill show the final reult
    nextButton.onclick = function() {
      end_result(numCorrect, numQuestion);
    }
  }
  // Different message and color depending on whether the answer is correct or not
  if(alertMessage == 'Correct'){
    alert.className = 'alert alert-success';
    alert.innerHTML = `${alertMessage}!`;
  } else {
    alert.className = 'alert alert-danger';
    alert.innerHTML = `${alertMessage}!\n The answer is ${correctAnswer}`;
  }
  // Append the message and button to DOM
  document.querySelector('#result').append(alert);
  document.querySelector('#result').append(nextButton);
}

// Display the current question and multiple choices of its answer
function display_question(num){
  // Show submit button;
  document.querySelector('#submit').style.display = 'block';
  // Clear the multiple choice answers and alert message
  document.querySelector('#choices').innerHTML = '';
  document.querySelector('#result').innerHTML = '';
  // Current question
  let question = questions[num];
  document.querySelector('#question').innerHTML = `Q${num+1}. ${question}`;

  // Answer choices for the current question
  let choices = quizData[question];
  console.log(choices);
  // Append each choice to list of choices
  let numChoice = 0;
  choices.forEach((choice) => {
    // console.log(choice[0]);
    // Create radio buttons
    let radiobox = document.createElement('input');
    radiobox.type = 'radio';
    radiobox.id = `choice${numChoice}`;
    // radiobox.name = `question${numQuestion}`;
    radiobox.name = 'answer';
    radiobox.value = numChoice ;
    // radiobox.innerHTML = choice[0];
    // Create the label to display answer text
    let label = document.createElement('label');
    label.className = 'answer';
    label.innerHTML = choice[0];

    // Create <br>
    let newline = document.createElement('br');


    // Add answer choices to div
    let divChoices = document.querySelector('#choices')
    divChoices.appendChild(radiobox);
    divChoices.appendChild(label);
    divChoices.appendChild(newline);
    numChoice++;
  });
}


function end_result(numCorrect, numQuestion){
  // Change the heading to result
  document.querySelector('#question').innerHTML = 'Result';

  // Clear the alert message and next button
  document.querySelector('#choices').innerHTML = '';
  document.querySelector('#result').innerHTML = '';

  // Create result
  let result = document.createElement('div');
  result.className = 'alert alert-info';
  result.innerHTML = `You scored ${numCorrect} out of ${numQuestion}!`;
  document.querySelector('#result').append(result);
  // Link back to quizzes
  let back = document.createElement('a');
  back.className = 'btn btn-outline-info mr-1';
  back.href = hrefQuizzes;
  back.innerHTML = 'Take another quiz';
  document.querySelector('#result').append(back);
  // Try-again
  let again = document.createElement('button');
  again.className = 'btn btn-outline-info';
  again.id = 'again';
  again.innerHTML = 'Try again';
  again.onclick = function(){ window.location.reload(); }
  document.querySelector('#result').append(again);
}
