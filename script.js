document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector("#searchInput");
    const resultsDiv = document.querySelector("#searchResults");

    searchInput.addEventListener("keyup", () => {
        const keyword = searchInput.value;
        fetch(`search_ajax.php?keyword=${keyword}`)
            .then(res => res.text())
            .then(data => {
                resultsDiv.innerHTML = data;
            });
    });
});
