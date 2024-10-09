// The function below validates the email, username, and password fields in the signup form.
document.addEventListener('DOMContentLoaded', function() {

    // First, we get the signup form and add an event listener to it.
    const signupForm = document.getElementById('signup-form');

    // When the form is submitted, we get the values of the email, username, and password fields.
    signupForm.addEventListener('submit', function(event) {
        const email = signupForm.email.value;
        const username = signupForm.username.value;
        const password = signupForm.password.value;

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert('Please enter a valid email address.');
            event.preventDefault();
            return;
        }

        // Username validation
        if (username.length > 15) {
            alert('Username must be 15 characters or less.');
            event.preventDefault();
            return;
        }

        // Password validation
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordPattern.test(password)) {
            alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');
            event.preventDefault();
            return;
        }
        // If any of the fields are invalid, we prevent the form from being submitted and display an alert.
    });
});
