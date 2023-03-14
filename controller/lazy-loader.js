// function loadFullImage(event) {
//     event.currentTarget.onload = null;
//     event.currentTarget.src = event.currentTarget.src.replase("/thumbnail", "");
// }

// alle elemente die, die klasse "lazy-load" haben, ansprechen und in einer Array speicher
const lazyClass = "lazy-load";
const lazyImages = document.querySelectorAll(`.${lazyClass}`);

// liste aller elemente durch gehen, die die im viewport sind
const lazyObserver = new IntersectionObserver((elements) => {
    elements.forEach((element) => {
        // sobald der element im viewport auftauch die entsprechende image laden
        if (element.isIntersecting) {
            const image = element.target;
            showImage(image);
            lazyObserver.unobserve(image);
        }
    });
});

// images an den Oberserver übergeben
lazyImages.forEach(image => {
    lazyObserver.observe(image);
});

// image pfäder laden
function showImage(image) {
    image.src = image.dataset.src;
    image.classList.remove(lazyClass);
}

// kommentar feld ansprechen um das feld automatisch zuvergrössern
const commentForm = "comment-form";
if (document.querySelector(`.${commentForm}`) != null) {
    const commentContent = document.querySelector(`.${commentForm}`);

    textarea = commentContent.children[0];

    // nach ein tippen soll der feld vergrössert werden
    textarea.addEventListener("keyup", e => {
        textarea.style.height = "20px";
        let up = e.target.scrollHeight;
        textarea.style.height = `${up}px`;
    });   
}