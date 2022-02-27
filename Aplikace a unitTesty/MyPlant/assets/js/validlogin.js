document.addEventListener("DOMContentLoaded", () => {
    'use strict';


    const form = document.querySelector(".jsValid");
    console.log(form)
    form.addEventListener('submit', (even) => {

        for (let elem of form.elements) {
            if (elem.tagName !== "BUTTON") {
                if (elem.value === '') {
                    elem.nextElementSibling.textContent = 'This field is required';
                    elem.style.borderColor = 'red';
                    console.log('help')
                    even.preventDefault()
                } else {
                    elem.nextElementSibling.textContent = '';
                    elem.style.borderColor = 'white';
                }
            }
        }
    });
});