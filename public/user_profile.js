const logout = document.getElementById("logout");

// const backend = "localhost:8000";

logout.addEventListener("click", () => {
	fetch(`/user/logout`, {
		method: "POST",
	})
		.then((res) => res.json())
		.then((body) => {
			if (!body) return;

			if (body.logedout) {
				window.location.reload(true);
			}
		});
});

const deleteStory = (id) => {
	const simple_form = new FormData();
	simple_form.append("id", id);
	fetch("/story/delete", {
		method: "POST",
		body: simple_form,
	})
		.then((res) => res.json())
		.then((body) => {
			console.log(body);
			if (!body) {
				return;
			}
			if (body.redirect) {
				window.location.replace(body.redirect);
			}
			if (body.success) {
				window.location.reload(true);
			}
		});
};
