function loadFullImage(event) {
    event.currentTarget.onload = null;
    event.currentTarget.src = event.currentTarget.src.replase("/thumbnail", "");
}