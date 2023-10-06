// slide.js

var slideContent = document.getElementById("slideContent");
var slideButton = document.getElementById("slideButton");

function toggleSlide() {
    if (slideContent.style.display === "none" || slideContent.style.display === "") {
        slideContent.style.display = "block";
        slideContent.style.animation = "none";
        setTimeout(function() {
            slideContent.style.animation = "slide 0.5s ease-out forwards";
        }, 100);

        // Menambah event listener untuk menutup konten saat di luar konten diklik
        window.addEventListener("click", closeOutsideContent);
    }
}

function closeOutsideContent(event) {
    if (!slideButton.contains(event.target) && !slideContent.contains(event.target)) {
        slideContent.style.animation = "none";
        setTimeout(function() {
            slideContent.style.animation = "slide-reverse 0.5s ease-out forwards";
            slideContent.style.display = "none";
        }, 100);
        window.removeEventListener("click", closeOutsideContent);
    }
}

// Menambah event listener untuk tombol saat halaman dimuat
slideButton.addEventListener("click", toggleSlide);
