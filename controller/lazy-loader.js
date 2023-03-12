function loadFullImage(event) {
    event.currentTarget.onload = null;
    event.currentTarget.src = event.currentTarget.src.replase("/thumbnail", "");
}



// const commentContent = document.getElementsByClassName("coment-content");
// textarea = commentContent.children[0].children[0];
// textarea.addEventListener("keyup", e => {
//     let up = e.target.scrollHeight;
//     alert("hallo");
// });