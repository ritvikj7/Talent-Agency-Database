function loadNavbar() {
    fetch('navbar.html')
        .then(response => response.text())
        .then(navbarHtml => {
            const parser = new DOMParser();
            const navbarDoc = parser.parseFromString(navbarHtml, 'text/html');
            const navbarContent = navbarDoc.querySelector('nav');
            document.getElementById('navbar-placeholder').appendChild(navbarContent);
        });
}
