document.addEventListener("DOMContentLoaded", () => {
    const usernameInput = document.getElementById("username");
    const currentPasswordInput = document.getElementById("customerCurrentPassword");
    const newPasswordInput = document.getElementById("customerNewPassword");
    const confirmPasswordInput = document.getElementById("customerConfirmPassword");

    const usernameError = document.getElementById("usernameError");
    const currentPasswordError = document.getElementById("currentPasswordError");
    const newPasswordError = document.getElementById("newPasswordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    // Username Validation
    usernameInput.addEventListener("input", () => {
        const usernameRegex = /^[a-zA-Z0-9]{5,}$/; // At least 5 alphanumeric characters
        if (usernameRegex.test(usernameInput.value)) {
            usernameError.textContent = "";
            usernameInput.style.borderColor = "green";
        } else {
            usernameError.textContent = "Username must be at least 5 characters long.";
            usernameInput.style.borderColor = "red";
        }
    });

    // New Password Validation
    newPasswordInput.addEventListener("input", () => {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{10,}$/;
        if (passwordRegex.test(newPasswordInput.value)) {
            newPasswordError.textContent = "";
            newPasswordInput.style.borderColor = "green";
        } else {
            newPasswordError.textContent = "Password must be at least 10 characters long, with uppercase, lowercase, digit, and special character.";
            newPasswordInput.style.borderColor = "red";
        }
    });

    // Confirm Password Validation
    confirmPasswordInput.addEventListener("input", () => {
        if (confirmPasswordInput.value === newPasswordInput.value) {
            confirmPasswordError.textContent = "";
            confirmPasswordInput.style.borderColor = "green";
        } else {
            confirmPasswordError.textContent = "Passwords do not match.";
            confirmPasswordInput.style.borderColor = "red";
        }
    });

    // Form Submission Prevention
    const form = document.querySelector("form");
    form.addEventListener("submit", (event) => {
        const usernameValid = usernameInput.style.borderColor === "green";
        const newPasswordValid = newPasswordInput.style.borderColor === "green";
        const confirmPasswordValid = confirmPasswordInput.style.borderColor === "green";

        if (!usernameValid || !newPasswordValid || !confirmPasswordValid) {
            event.preventDefault();
            alert("Please fix the errors in the form before submitting.");
        }
    });
});