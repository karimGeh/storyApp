const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");

const loginEmailError = document.getElementById("emailError");
const loginPasswordError = document.getElementById("passwordError");

loginForm.addEventListener("submit", (e) => {
	e.preventDefault();
	var formData = new FormData(document.forms["login-form"]);
	fetch("/user/login", {
		method: "POST",
		body: formData,
	})
		.then((res) => {
			return res.json();
		})
		.then((body) => {
			if (!body) {
				console.log("server errors");
				return;
			}
			if (body.redirect) {
				window.location.href = body.redirect;
			}
			loginEmailError.innerText = body.errors
				? body.errors.email
					? body.errors.email
					: ""
				: "";

			loginPasswordError.innerText = body.errors
				? body.errors.password
					? body.errors.password
					: ""
				: "";
		});
});
