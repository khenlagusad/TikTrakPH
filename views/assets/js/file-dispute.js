const titleField = document.querySelector("#title");
const explanationField = document.querySelector("#explanation");
const disputeForm = document.querySelector("#dispute-form");

disputeForm.addEventListener("submit", (e) => {

    if (!titleField.value.trim()) {
        e.preventDefault();
        alert("Please enter a valid title");
        return;
    }

    if (!explanationField.value.trim()) {
        e.preventDefault();
        alert("Please enter a valid explanation");
        return;
    }
});