document.addEventListener('DOMContentLoaded', function () {
    // Validation functions
    function validateUsername() {
        const usernameRegex = /^(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
        if (usernameRegex.test(username.value)) {
            username.style.borderColor = 'green';
            document.getElementById('usernameError').textContent = '';
            return true;
        } else {
            username.style.borderColor = 'red';
            document.getElementById('usernameError').textContent =
                'Username must be at least 5 characters, with uppercase and lowercase letters.';
            return false;
        }
    }

    function validatePassword() {
        if (password.value.length >= 10) {
            password.style.borderColor = 'green';
            document.getElementById('passwordError').textContent = '';
            return true;
        } else {
            password.style.borderColor = 'red';
            document.getElementById('passwordError').textContent =
                'Password must be at least 10 characters long.';
            return false;
        }
    }

    function validateConfirmPassword() {
        if (confirmPassword.value === password.value) {
            confirmPassword.style.borderColor = 'green';
            document.getElementById('confirmPasswordError').textContent = '';
            return true;
        } else {
            confirmPassword.style.borderColor = 'red';
            document.getElementById('confirmPasswordError').textContent =
                'Passwords do not match.';
            return false;
        }
    }

    // Toggle password visibility function with error logging
    function togglePasswordVisibility(toggleButtonId, passwordFieldId, iconElementId) {
        const toggleButton = document.getElementById(toggleButtonId);
        const passwordField = document.getElementById(passwordFieldId);
        const passwordIcon = document.getElementById(iconElementId);

        if (!toggleButton || !passwordField || !passwordIcon) {
            console.error(`Missing element(s) for IDs: ${toggleButtonId}, ${passwordFieldId}, ${iconElementId}`);
            return;
        }

        toggleButton.addEventListener('click', function () {
            const isPasswordHidden = passwordField.type === 'password';
            passwordField.type = isPasswordHidden ? 'text' : 'password';

            // Toggle the eye icon
            passwordIcon.classList.toggle('fa-eye');
            passwordIcon.classList.toggle('fa-eye-slash');
        });
    }

    // Toggles for Registration Fields
    togglePasswordVisibility('toggleRegisterPassword', 'registerPassword', 'registerPasswordIcon');
    togglePasswordVisibility('toggleRegisterConfirmPassword', 'registerConfirmPassword', 'registerConfirmPasswordIcon');

    // Toggles for Customer Fields
    togglePasswordVisibility('toggleCustomerCurrentPassword', 'customerCurrentPassword', 'customerCurrentPasswordIcon');
    togglePasswordVisibility('toggleCustomerNewPassword', 'customerNewPassword', 'customerNewPasswordIcon');
    togglePasswordVisibility('toggleCustomerConfirmPassword', 'customerConfirmPassword', 'customerConfirmPasswordIcon');

    // Reset button clears styles, messages, and input values
    const resetButton = document.querySelector('.reset-button');
    if (resetButton) {
        resetButton.addEventListener('click', function () {
            const inputs = document.querySelectorAll('#registrationForm input');
            inputs.forEach((input) => {
                input.style.borderColor = '';
                input.value = '';
            });
            document.getElementById('usernameError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('confirmPasswordError').textContent = '';
        });
    }
});