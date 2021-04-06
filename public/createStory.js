const thecreateform = document.getElementById("form_create_story");

thecreateform.addEventListener("submit", (e) => {
	e.preventDefault();
	let formData = new FormData(document.forms["form_create_story"]);
	fetch("/story/create", {
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

			console.log(body);
		});
});
