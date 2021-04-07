const thecreateform = document.getElementById("form_create_story");
var storyId = document.currentScript.getAttribute("storyId");
thecreateform.addEventListener("submit", (e) => {
	e.preventDefault();
	let formData = new FormData(document.forms["form_create_story"]);
	formData.set("id", storyId);
	fetch("/api/story/edit", {
		method: "POST",
		body: formData,
	})
		.then((res) => {
			return res.json();
		})
		.then((body) => {
			console.log(body);
			if (!body) {
				console.log("server errors");
				return;
			}
			if (body.redirect) {
				window.location.href = body.redirect;
			}
		});
});
