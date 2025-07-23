const slides = document.querySelector('.slides');
const navDots = document.querySelectorAll('.nav-dot');
let currentIndex = 0;
const intervalTime = 5000; // 5 seconds

function updateSlider(index) {
    slides.style.transform = `translateX(-${index * 100}%)`;
    navDots.forEach(dot => dot.classList.remove('active'));
    navDots[index].classList.add('active');
}

navDots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        currentIndex = index;
        updateSlider(index);
    });
});

setInterval(() => {
    currentIndex = (currentIndex + 1) % navDots.length;
    updateSlider(currentIndex);
}, intervalTime);

// Initialize the slider
document.addEventListener('DOMContentLoaded', () => {
    updateSlider(currentIndex);
});
