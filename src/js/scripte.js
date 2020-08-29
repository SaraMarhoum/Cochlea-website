//Parallax
window.addEventListener('scroll', function () {
    const parallax = document.querySelector(".hero");
    let scrollPosition = window.pageXOffset;

    parallax.style.transforme = 'translateY(' + scrollPosition * .9 + 'px)';
})




// Scroll reveal
window.sr = ScrollReveal();

sr.reveal('.animate-left',{
    origin: 'left',
    duration: 1000,
    distance: '25rem',
    delay: 300
});

sr.reveal('.animate-right',{
    origin: 'right',
    duration: 1000,
    distance: '25rem',
    delay: 600
});

sr.reveal('.animate-top',{
    origin: 'top',
    duration: 1000,
    distance: '25rem',
    delay: 600
});

sr.reveal('.animate-bottom',{
    origin: 'bottom',
    duration: 1000,
    distance: '25rem',
    delay: 600
});


