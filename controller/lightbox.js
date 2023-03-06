// auf die conteiners zugeifen um pfäder uszulesen und weitere elemente zu erstellen
const postContent = document.querySelector(".post-content");
const galleryItem = document.getElementsByClassName("gallery-item");

// div conteiners erstelle und entsprechende klassen vergeben
const lightboxContainer = document.createElement("div");
const lightbocContent = document.createElement("div");
const lightboximg = document.createElement("img");

lightboxContainer.classList.add("lightbox");
lightbocContent.classList.add("lightbox-content");

// weitere elemente hinzufügen
postContent.append(lightboxContainer);
lightboxContainer.appendChild(lightbocContent);
lightbocContent.appendChild(lightboximg);


// das originle medie ausgeben
function showLightbox(n) {
    let imageLocation = galleryItem[n].children[0].getAttribute("id");
    console.log(n);
    console.log(galleryItem[0].children[0].getAttribute("id"));
    lightboximg.setAttribute("loading", "lazy");
    lightboximg.setAttribute("src", imageLocation);
    lightboxContainer.style.display = "block";
}

// das fenster schliessen
function closeLightbox() {
    lightboxContainer.style.display = "none";
}

lightboxContainer.addEventListener("click", () => {
    closeLightbox();
});