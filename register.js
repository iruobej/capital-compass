function validatePasswords() {
    const password = document.querySelector('input[name="password"]').value; 
    const confirmPassword = document.querySelector('input[name="confirm_password"]').value; 
    const errorDiv = document.getElementById('error-message');

    errorDiv.textContent = '';

    if(password !== confirmPassword) {
        errorDiv.textContent = "Passwords do not match.";
        return false;
    }

    if(!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errorDiv.textContent = "Password must include at least one special character.";
        return false;
    }

    if(password.length < 12) {
        errorDiv.textContent = "Password must be at least 12 characters long.";
        return false;
    }

    if(!/[A-Z]/.test(password)) {
        errorDiv.textContent = "Password must include at least one uppercase letter.";
        return false;
    }

    if(!/[a-z]/.test(password)) {
        errorDiv.textContent = "Password must include at least one lowercase letter.";
        return false;
    }
    //All checks passed 
    return true;
}
document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const errorMessage = urlParams.get('error');
    if (errorMessage) {
        const errorDiv = document.getElementById('error-message');
        errorDiv.textContent = decodeURIComponent(errorMessage);
    }
});
