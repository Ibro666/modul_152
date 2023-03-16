const navBar = document.querySelector(".response-nav-container");
const menuClass = document.querySelector(".menu");
const body = document.querySelector(".container-content");

const navViewContent = document.createElement("div");
const navMenu5 = document.createElement("div");
const navMenu1 = document.createElement("div");
const navMenu2 = document.createElement("div");
const navMenu3 = document.createElement("div");
const navMenu4 = document.createElement("div");

navViewContent.classList.add("response-nav-content");
navMenu1.classList.add("response-nav-menu");
navMenu2.classList.add("response-nav-menu");
navMenu3.classList.add("response-nav-menu");
navMenu4.classList.add("response-nav-menu");
navMenu5.classList.add("response-nav-menu");

navBar.append(navViewContent);
navViewContent.appendChild(navMenu1);
navViewContent.appendChild(navMenu2);
navViewContent.appendChild(navMenu3);
navViewContent.appendChild(navMenu4);
navViewContent.appendChild(navMenu5);

function showNavMenu() {
    navMenu1.appendChild(menuClass.children[0].children[0]);
    navMenu2.appendChild(menuClass.children[1].children[0]);
    navMenu3.appendChild(menuClass.children[2].children[0]);
    navMenu4.appendChild(menuClass.children[3].children[0]);
    navMenu5.appendChild(menuClass.children[4].children[0]);
}

const navList = document.querySelector(".nav-list");

navList.addEventListener("click", () => {
    navList.classList.toggle("active");
    navBar.classList.toggle("active");
    body.classList.toggle("active");
    showNavMenu();
});