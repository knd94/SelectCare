document.addEventListener('DOMContentLoaded', function() {
    speakText("Welcome to the homepage!");

    const tabs = document.querySelectorAll('.menu__bar ul li a');

    tabs.forEach(tab => {
        tab.addEventListener('mouseenter', function() {
            speakText(this.innerText);
        });
    });

    function speakText(text) {
        const utterance = new SpeechSynthesisUtterance(text);
        speechSynthesis.speak(utterance);
    }
});