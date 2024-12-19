let slideIndex = 1;
showSlides(slideIndex);
function plusSlide(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    let i;
    const slides = document.getElementsByClassName("slide");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}

const carousel = document.querySelector(".category-carousel");
const leftBtn = document.querySelector(".left-btn");
const rightBtn = document.querySelector(".right-btn");

let currentScrollPosition = 0;
const scrollStep = 160; // Adjust to match the item's width + margin
const maxScroll = carousel.scrollWidth - carousel.parentElement.clientWidth;

rightBtn.addEventListener("click", () => {
    currentScrollPosition = Math.min(currentScrollPosition + scrollStep, maxScroll);
    carousel.style.transform = `translateX(-${currentScrollPosition}px)`;
});

leftBtn.addEventListener("click", () => {
    currentScrollPosition = Math.max(currentScrollPosition - scrollStep, 0);
    carousel.style.transform = `translateX(-${currentScrollPosition}px)`;
});

function prevSlide() {
    plusSlide(-1);
}

function nextSlide() {
    plusSlide(1);
}

setInterval(() => {
    nextSlide();
}, 5000); 
let loginCarouselSlideIndex=1;
loginShowSlide(loginCarouselSlideIndex);
function loginPlus(n){
    loginShowSlide(loginCarouselSlideIndex+=n);
}
function loginShowSlide(n){
    let i
}
// Function to change the main photo when a thumbnail is clicked
function changePhoto(thumbnail) {
    // Select the main photo element
    const mainPhoto = document.getElementById('mainPhoto');
    
    // Update the src of the main photo to match the clicked thumbnail
    mainPhoto.src = thumbnail.src;
}

// Add event listeners to each thumbnail
document.querySelectorAll('.product-image-four img').forEach((thumbnail) => {
    thumbnail.addEventListener('click', function () {
        changePhoto(thumbnail);
    });
});
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}
// JavaScript for Cart Interactivity

function changeQuantity(action, button) {
    const input = button.parentNode.querySelector('.quantity-input');
    let currentQuantity = parseInt(input.value);
    
    if (action === 'increase') {
        input.value = currentQuantity + 1;
    } else if (action === 'decrease' && currentQuantity > 1) {
        input.value = currentQuantity - 1;
    }
    
    updateCartTotal(); // Update the cart total when quantity changes
}

function updateCartTotal() {
    let totalItemsCount = 0;
    let totalPriceAmount = 0;

    document.querySelectorAll('.cart-item').forEach((item, index) => {
        const quantity = parseInt(item.querySelector('.quantity-input').value);
        const price = parseFloat(item.querySelector('.cart-item-price p').textContent.replace('$', ''));

        totalItemsCount += quantity;
        totalPriceAmount += quantity * price;
    });

    document.querySelector('.total-items').textContent = totalItemsCount;
    document.querySelector('.total-price').textContent = `$${totalPriceAmount.toFixed(2)}`;
}

// document.addEventListener('DOMContentLoaded', () => {
//     setTimeout(() => {
//         const iframe = document.getElementById('promo-video');
//         iframe.style.visibility = 'visible';
//         iframe.style.position = 'static'; 
//         iframe.style.width = '560px'; 
//         iframe.style.height = '315px';
//     }, 5000); 
// });
