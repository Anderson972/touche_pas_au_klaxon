document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.getElementById('flashMessage');
    if (flashMessage) {
        setTimeout(function() {
            flashMessage.classList.remove('show')
        }, 3000);
        setTimeout(function() {
            flashMessage.classList.add('d-none')
        }, 3250);
    }
});