function toggleView(elementID) {
    let element = document.getElementById(elementID);
    if (element.style.display === "none") {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }
}
