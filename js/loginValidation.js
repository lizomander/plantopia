document.addEventListener('DOMContentLoaded', () => {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const form = document.getElementById('loginForm');
    const togglePassword = document.getElementById('togglePassword');
    const passwordIcon = document.getElementById('passwordIcon');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');

    // Toggle password visibility
    togglePassword.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    });

    // Username validation (real-time)
    usernameInput.addEventListener("input", () => {
        const usernameRegex = /^(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
        if (usernameRegex.test(usernameInput.value)) {
            usernameInput.style.borderColor = "green";
            usernameError.textContent = ""; // Clear error message
        } else {
            usernameInput.style.borderColor = "red";
            usernameError.textContent = "Username must be at least 5 characters with one uppercase and one lowercase letter.";
        }
    });

    // Password validation (real-time)
    passwordInput.addEventListener('input', () => {
        const minLength = 10;
        const meetsLengthRequirement = passwordInput.value.trim().length >= minLength;
        const hasRequiredCharacters = /^(?=.*[a-z])(?=.*[A-Z]).*$/.test(passwordInput.value);

        if (meetsLengthRequirement && hasRequiredCharacters) {
            passwordInput.style.borderColor = "green";
            passwordError.textContent = ""; // Clear error message
        } else {
            passwordInput.style.borderColor = "red";

            if (!meetsLengthRequirement) {
                passwordError.textContent = `Password must be at least ${minLength} characters long.`;
            } else if (!hasRequiredCharacters) {
                passwordError.textContent = "Password must include at least one uppercase and one lowercase letter.";
            }
        }
    });

    // Form submission validation
    form.addEventListener('submit', (event) => {
        const isUsernameValid = usernameInput.style.borderColor === 'green';
        const isPasswordValid = passwordInput.style.borderColor === 'green';

        if (!isUsernameValid || !isPasswordValid) {
            event.preventDefault();
            alert('Please correct the errors in the form before submitting.');
        }
    });
});