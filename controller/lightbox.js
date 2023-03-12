// auf die conteiners zugeifen um pfäder uszulesen und weitere elemente zu erstellen
const postContent = document.querySelector(".post-content");
const galleryItem = document.getElementsByClassName("gallery-item");
const metadate = document.querySelector(".metainfo");

// div conteiners erstelle und entsprechende klassen vergeben
const lightboxContainer = document.createElement("div");
const lightboxContent = document.createElement("div");
const lightboximg = document.createElement("img");
const lightboxMetadata = document.createElement("div");
const lightboxdate = document.createElement("div");
const licenseContent = document.createElement("div");
const licenseContent1 = document.createElement("div");
const lightboxfinalTab = document.createElement("div");
const lightboxp = document.createElement("p");
const lightboxa = document.createElement("a");
const lightboxa1 = document.createElement("a");
const lightboxMove = document.createElement("VIDEO");
const lightboxAudio = document.createElement("AUDIO");

lightboxContainer.classList.add("lightbox");
lightboxContent.classList.add("lightbox-content");
lightboxMetadata.classList.add("metainfo");
lightboxdate.classList.add("post-date");

    // weitere elemente hinzufügen
postContent.append(lightboxContainer);
lightboxContainer.appendChild(lightboxContent);
lightboxContent.appendChild(lightboxfinalTab);
lightboxContent.appendChild(lightboxMetadata);
lightboxMetadata.appendChild(licenseContent);
lightboxMetadata.appendChild(licenseContent1);
licenseContent.appendChild(lightboxa);
licenseContent1.appendChild(lightboxp);

// das originle medie ausgeben
function showLightbox(n) {
    let imageLocation = galleryItem[n].children[0].getAttribute("id");

    if (galleryItem[n].children[0].children[0].getAttribute("id") == 0) {
        lightboxfinalTab.innerHTML = "";
        showMove(imageLocation);
    } 
    if (galleryItem[n].children[0].children[0].getAttribute("id") == 1) {
        lightboxfinalTab.innerHTML = "";
        showAudio(imageLocation);
    }
    if (galleryItem[n].children[0].children[0].getAttribute("id") == 2) {
        lightboxfinalTab.innerHTML = "";
        showImage(imageLocation);
    }

    showMetadata(n);
    lightboxContainer.style.display = "block";
}

function showMetadata(n) {
    let ajax = new XMLHttpRequest();

    ajax.onreadystatechange = () => {
        let data = JSON.parse(ajax.response);
        lightboxa.setAttribute("href", data[n].url);
        lightboxa.innerHTML = data[n].icon; 
        lightboxp.innerHTML = data[n].autor;
    }

    ajax.open("GET", "test.json");
    ajax.send();
}

function showMove(str) {
    lightboxfinalTab.appendChild(lightboxMove);
    lightboxMove.setAttribute("src", str);
    lightboxMove.controls = true;
}

function showAudio(str) {
    lightboxfinalTab.appendChild(lightboxAudio);
    lightboxAudio.setAttribute("src", str);
    lightboxAudio.controls = true;
}

function showImage(str) {
    lightboxfinalTab.appendChild(lightboximg);
    lightboximg.setAttribute("loading", "lazy");
    lightboximg.setAttribute("src", str);  
}

// das fenster schliessens
function closeLightbox() {
    lightboxContainer.style.display = "none";
}

lightboxContainer.addEventListener("click", () => {
    closeLightbox();
});