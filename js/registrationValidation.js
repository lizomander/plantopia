document.addEventListener("DOMContentLoaded", () => {
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("registerPassword");
    const confirmPasswordInput = document.getElementById("registerConfirmPassword");
    const usernameError = document.getElementById("usernameError");
    const passwordError = document.getElementById("passwordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    usernameInput.addEventListener("input", () => {
        const usernameRegex = /^(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
        if (usernameRegex.test(usernameInput.value)) {
            usernameInput.style.borderColor = "green"; 
            usernameError.textContent = ""; 
            usernameInput.classList.add("valid"); 
            usernameInput.classList.remove("error"); 
        } else {
            usernameInput.style.borderColor = "red"; 
            usernameError.textContent = "Username must have at least 5 characters with one uppercase and one lowercase letter.";
            usernameInput.classList.add("error"); 
            usernameInput.classList.remove("valid"); 
        }
    });

    passwordInput.addEventListener("input", () => {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z]).{10,}$/;
        if (passwordRegex.test(passwordInput.value)) {
            passwordInput.style.borderColor = "green"; 
            passwordError.textContent = ""; 
        } else {
            passwordInput.style.borderColor = "red"; 
            passwordError.textContent = "Password must be at least 10 characters with one uppercase and one lowercase letter.";
        }
    });

    confirmPasswordInput.addEventListener("input", () => {
        if (confirmPasswordInput.value === passwordInput.value) {
            confirmPasswordInput.style.borderColor = "green"; 
            confirmPasswordError.textContent = ""; 
        } else {
            confirmPasswordInput.style.borderColor = "red"; 
            confirmPasswordError.textContent = "Passwords do not match.";
        }
    });
});