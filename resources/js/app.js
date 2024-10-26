import './bootstrap';

var animationElements = document.querySelectorAll('.animation-element');
var windowHeight = window.innerHeight;

// Disable triggering on small devices
var isMobile = window.matchMedia("only screen and (max-width: 768px)");
if (isMobile.matches) {
    // If on a mobile device, skip adding animations
    // You can also remove the `animation-element` class if needed
    // animationElements.forEach(element => element.classList.remove('animation-element'));
}

function checkIfInView() {
    var windowTopPosition = window.scrollY;
    var windowBottomPosition = (windowTopPosition + windowHeight);

    animationElements.forEach(function(element) {
        var elementHeight = element.offsetHeight;
        var elementTopPosition = element.getBoundingClientRect().top + windowTopPosition;
        var elementBottomPosition = (elementTopPosition + elementHeight);

        // Check if the element is within the viewport
        if ((elementBottomPosition >= windowTopPosition) &&
            (elementTopPosition <= windowBottomPosition)) {
            element.classList.add('in-view');
        }
    });
}

// Attach the event listeners for `scroll` and `resize` events
window.addEventListener('scroll', checkIfInView);
window.addEventListener('resize', function() {
    windowHeight = window.innerHeight; // Update window height on resize
    checkIfInView();
});

// Trigger the initial check on page load
checkIfInView();


