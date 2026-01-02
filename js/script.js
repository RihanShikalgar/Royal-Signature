function handleLogin() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if (!username || !password) {
        alert("Please fill in all fields");
        return;
    }

    let formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    fetch('backend/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Login Successful");
            sessionStorage.setItem('user_id', data.data.user_id);
            sessionStorage.setItem('username', data.data.username);
            window.location.href = "home.html";
        } else {
            alert(data.message || "Login failed");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred during login");
    });
}

function handleSignUp() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if (!username || !password) {
        alert("Please fill in all fields");
        return;
    }

    // For signup, we need email field
    let email = prompt("Please enter your email:");
    if (!email) return;

    let formData = new FormData();
    formData.append('username', username);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('confirm_password', password);

    fetch('backend/signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Sign Up Successful");
            sessionStorage.setItem('user_id', data.data.user_id);
            sessionStorage.setItem('username', data.data.username);
            window.location.href = "home.html";
        } else {
            alert(data.message || "Sign up failed");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred during signup");
    });
}

// for eye icon of passward

function togglePassword() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.querySelector(".toggle-password i");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash"); // Change to "Hide" icon
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye"); // Change back to "Show" icon
    }
}
