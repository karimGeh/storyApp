const searchForm = document.getElementById("search-form");
const page = document.getElementById("page");
const nextPage = document.getElementById("nextPage");
const previousPage = document.getElementById("previousPage");

const currentPage = document.currentScript.getAttribute("currentPage");
const maxPage = document.currentScript.getAttribute("maxPage");

nextPage.addEventListener("click", () => {
	if (parseInt(currentPage) >= parseInt(maxPage)) {
		return;
	}
	page.value = parseInt(currentPage) + 1;
	searchForm.submit();
});

previousPage.addEventListener("click", () => {
	if (parseInt(currentPage) <= 1) {
		return;
	}
	page.value = parseInt(currentPage) - 1;
	searchForm.submit();
});
