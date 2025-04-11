document.getElementById('quizForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const totalQuestions = 7;
    let score = 0;

    for (let i = 1; i <= totalQuestions; i++) {
        const answer = document.querySelector('input[name="q' + i + '"]:checked');
        if (answer && answer.value === "correct") {
            score++;
        }
    }

    const result = document.getElementById("result");
    if (score >= 5) {
        result.innerHTML = `You passed! Score: ${score}/7`;
        result.style.color = "green";
    } else {
        result.innerHTML = `You did not pass. Score: ${score}/7`;
        result.style.color = "red";
    }
});