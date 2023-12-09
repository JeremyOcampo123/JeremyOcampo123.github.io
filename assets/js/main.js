/*===== MENU SHOW =====*/ 
const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId)

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            nav.classList.toggle('show')
        })
    }
}
showMenu('nav-toggle', 'nav-menu')

/*==================== REMOVE MENU MOBILE ====================*/
const navLink = document.querySelectorAll('.nav__link')

function linkAction() {
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*==================== SCROLL SECTIONS ACTIVE LINK ====================*/
const sections = document.querySelectorAll('section[id]')

function scrollActive() {
    const scrollY = window.pageYOffset

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight
        const sectionTop = current.offsetTop - 50;
        sectionId = current.getAttribute('id')

        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active')
        } else {
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active')
        }
    })
}
window.addEventListener('scroll', scrollActive)

/*===== SCROLL REVEAL ANIMATION =====*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2000,
    delay: 200,
    // reset: true
});

sr.reveal('.home__data, .about__img, .skills__subtitle, .skills__text', {}); 
sr.reveal('.home__img, .about__subtitle, .about__text, .skills__img', { delay: 400 }); 
sr.reveal('.home__social-icon', { interval: 200 }); 
sr.reveal('.skills__data, .work__img, .contact__input', { interval: 200 }); 

/*===== DOWNLOAD CV =====*/
const printButton = document.getElementById('printButton');
printButton.addEventListener('click', () => {
    // Assuming your resume PDF is located at assets/cv_pdf/Resume_nikko.pdf
    const pdfPath = 'assets/cv_pdf/Jeremy-Ocampo-Resume.pdf';

    // Opening a new tab/window with the PDF URL
    window.open(pdfPath, '_blank');
});

/*===== FORM SUBMISSION WITH AJAX =====*/
const contactForm = document.querySelector('.contact__form');

if (contactForm) {
    contactForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Collect form data
        const formData = new FormData(contactForm);

        // Log form data to the console for debugging
        console.log('Form data:', formData);

        // Send data to sendemail.php using fetch
        fetch('sendemail.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                // Log server response to the console for debugging
                console.log('Server response:', data);

                // Display the response (customize this part as needed)
                alert(data);

                // You can also redirect or perform other actions based on the response
                // For example, if the response indicates success, you can redirect the user
                if (data.includes('sent and saved to the database')) {
                    window.location.href = 'success.html';
                }
            })
            .catch(error => {
                // Log any errors to the console for debugging
                console.error('Error:', error);
            });
    });
}
