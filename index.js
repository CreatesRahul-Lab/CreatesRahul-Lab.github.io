// Change background color on scroll
window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    const body = document.body;

    // Add the 'scrolled' class to the body when the user scrolls down
    if (scrollY > 100) {
        body.classList.add('scrolled');
    } else {
        body.classList.remove('scrolled');
    }
});

// Smooth transition for the scroll color change
document.addEventListener('DOMContentLoaded', () => {
    window.scrollTo(0, 0);  // Ensure it starts from the top
});
