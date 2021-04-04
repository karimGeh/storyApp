const login = document.getElementById("login");
const register = document.getElementById("register");

const popout = document.getElementById("auth-popout");
const popoutContainer = document.getElementById("popout-container");
const popoutLoginNavigation = document.getElementById("login--popout");
const popoutRegisterNavigation = document.getElementById("register--popout");
const popoutLoginform = document.getElementById("login-form");
const popoutRegisterform = document.getElementById("register-form");

const showLogin = () => {
	popout.className = "popout";

	popoutLoginNavigation.className = "navlinks--popout active";
	popoutLoginform.className = "navlinks--popout";

	popoutRegisterNavigation.className = "navlinks--popout";
	popoutRegisterform.className = "navlinks--popout hidden";
};

const showRegister = () => {
	popout.className = "popout";

	popoutLoginNavigation.className = "navlinks--popout";
	popoutLoginform.className = "navlinks--popout hidden";

	popoutRegisterNavigation.className = "navlinks--popout active";
	popoutRegisterform.className = "navlinks--popout";
};

const hidePopout = () => {
	popout.className = "popout hidden";
};

popoutContainer.addEventListener("click", (e) => {
	e.stopImmediatePropagation();
});

login.addEventListener("click", showLogin);
register.addEventListener("click", showRegister);
popout.addEventListener("click", hidePopout);
popoutLoginNavigation.addEventListener("click", showLogin);
popoutRegisterNavigation.addEventListener("click", showRegister);
