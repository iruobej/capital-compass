let quizStartTime = Date.now(); // capture quiz start

document.getElementById('quizForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const totalQuestions = 7;
    let score = 0;

    // Score the quiz
    for (let i = 1; i <= totalQuestions; i++) {
        const answer = document.querySelector('input[name="q' + i + '"]:checked');
        if (answer && answer.value === "correct") {
            score++;
        }
    }

    const result = document.getElementById("result");
    const passFail = score >= 5 ? 'pass' : 'fail';
    const timeTaken = Math.floor((Date.now() - quizStartTime) / 1000); // in seconds
    const topic = document.querySelector('input[name="topic"]').value; // from hidden input

    // Show result to user
    result.innerHTML = `${passFail === 'pass' ? 'You passed!' : 'You did not pass.'} Score: ${score}/7`;
    result.style.color = passFail === 'pass' ? "green" : "red";

    // Send attempt to backend
    fetch('submit_quiz.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            topic: topic,
            score: score,
            time_taken: timeTaken,
            pass_fail: passFail
        })
    }).then(res => res.text())
    .then(text => {
        console.log("Raw response:", text);
        // Try parsing it as JSON manually if you want:
        try {
            const data = JSON.parse(text);
            console.log("Parsed JSON:", data);
        } catch (e) {
            console.error("Invalid JSON response:", e);
        }
    });
});
