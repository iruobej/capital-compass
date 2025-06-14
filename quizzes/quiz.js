let quizStartTime = Date.now(); // Capturing quiz start

document.getElementById('quizForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;

    const totalQuestions = 7;
    let score = 0;

    // Scoring the quiz
    for (let i = 1; i <= totalQuestions; i++) {
        const answer = form.querySelector(`input[name="q${i}"]:checked`);
        if (answer && answer.value === "correct") {
            score++;
        }
    }

    const result = document.getElementById("result");
    const passFail = score >= 5 ? 'pass' : 'fail';
    const timeTaken = Math.floor((Date.now() - quizStartTime) / 1000); // in seconds
    const topic = form.querySelector('input[name="topic"]').value; // from hidden input in the quiz php pages

    // Showing result to user
    result.innerHTML = `${passFail === 'pass' ? 'You passed!' : 'You did not pass.'} Score: ${score}/7`;
    result.style.color = passFail === 'pass' ? "green" : "red";

    // Sending user's attempt to backend
    fetch('submit_quiz.php', {
        method: 'POST',
        credentials: 'include',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ topic, score, time_taken: timeTaken, pass_fail: passFail })
    })
    .then(res => res.json())              // parsing response as JSON
    .then(data => {                      
      console.log("Parsed JSON:", data);
    })
    .catch(e => {                         // to catch both network & parse errors
      console.error("Invalid JSON response:", e);
    });
});
