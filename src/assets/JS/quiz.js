// To check if php variable are available in js
console.log(quizData);
console.log(questions);

document.addEventListener('DOMContentLoaded',
  () => {
    // Set the question number
    var numQuestion = 0;
    // Display the current question and multiple choice answers
    display_question(numQuestion);

    // When the answer is submitted
    document.querySelector('#form').onsubmit = () => {
      // check if an answer is selected, if selected retrieve the value, otherwise alert to select
      var selected = document.querySelector('input[name=answer]:checked');
      let question = questions[numQuestion];
      let choices = quizData[question];
      if (selected != null){
        // Retrieve the value of selected answer
        let value = selected.value;

        // Check if the selected answer is correct
        check_answer(choices, value);
        // Clear the multiple choice answers
        document.querySelector('#choices').innerHTML = '';
        numQuestion++;

        // Check if it has reached the end of the quiz, if not display next question
        if(numQuestion < questions.length){
          display_question(numQuestion);
        } else {
          // End of the quiz
          // Clear the question and hide submit button
          document.querySelector('#question').innerHTML = '';
          document.querySelector('#submit').style.display = 'none';
          show_result();
        }

      } else {
        alert('Select an answer');
      }
      return false;
    }

  });

// Display the current question and multiple choices of its answer
function display_question(num){
  // Current question
  let question = questions[num];
  document.querySelector('#question').innerHTML = question;

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

function check_answer(choices, value){
  // Loop through the choices and check if the selected value is the answer
  let is_answer = choices[value]['is_answer'];
  // console.log(is_answer);
  if (is_answer == 1){
    alert('Correct!');
  } else {
    alert('Wrong answer');
    // Display the correct answer
  }
}

function show_result(){
  alert('The result');
}
