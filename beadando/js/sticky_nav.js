function sticky_nav(){
    let navbar = document.getElementById("navbar");
    let navPos = navbar.offsetTop;

    window.addEventListener("scroll", e => {
        let scrollPos = window.scrollY;
        if (scrollPos > navPos) {
            navbar.classList.add('sticky');
        } else {
            navbar.classList.remove('sticky');
        }
    });
}
