const logout = document.getElementById("logout");
const changePhoto = document.getElementById("change-photo");
const photo = document.getElementById("photo");
const formPhoto = document.getElementById("updatePhoto");
// const backend = "localhost:8000";

logout.addEventListener("click", () => {
	fetch(`/api/user/logout`, {
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
changePhoto.addEventListener("click", () => {
	photo.click();
});
photo.addEventListener("change", () => {
	let formData = new FormData(document.forms["updatePhoto"]);
	fetch(`/api/user/updatePhoto`, {
		method: "POST",
		body: formData,
	})
		.then((res) => res.json())
		.then((body) => {
			if (!body) return;

			if (body.redirect) {
				window.location.reload(true);
			}
		});
});

const deleteStory = (id) => {
	const simple_form = new FormData();
	simple_form.append("id", id);
	fetch("/api/story/delete", {
		method: "POST",
		body: simple_form,
	})
		.then((res) => res.json())
		.then((body) => {
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
