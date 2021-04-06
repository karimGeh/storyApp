const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");

const loginGlobalError = document.getElementById("globalError-login");
const loginEmailError = document.getElementById("emailError-login");
const loginPasswordError = document.getElementById("passwordError-login");

const registerGlobalError = document.getElementById("globalError-register");
const registerUsernameError = document.getElementById("usernameError-register");
const registerEmailError = document.getElementById("emailError-register");
const registerPasswordError = document.getElementById("passwordError-register");
const registerConfirmPasswordError = document.getElementById(
	"confirmPasswordError-register",
);

loginForm.addEventListener("submit", (e) => {
	e.preventDefault();
	let formData = new FormData(document.forms["login-form"]);
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

			loginGlobalError.innerText = body.errors
				? body.errors.global
					? body.errors.global
					: ""
				: "";

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

registerForm.addEventListener("submit", (e) => {
	e.preventDefault();
	let formData = new FormData(document.forms["register-form"]);
	fetch("/user/register", {
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
			registerGlobalError.innerText = body.errors
				? body.errors.global
					? body.errors.global
					: ""
				: "";

			registerUsernameError.innerText = body.errors
				? body.errors.username
					? body.errors.username
					: ""
				: "";

			registerEmailError.innerText = body.errors
				? body.errors.email
					? body.errors.email
					: ""
				: "";

			registerPasswordError.innerText = body.errors
				? body.errors.password
					? body.errors.password
					: ""
				: "";

			registerConfirmPasswordError.innerText = body.errors
				? body.errors.confirmPassword
					? body.errors.confirmPassword
					: ""
				: "";
		});
});
