document.addEventListener("DOMContentLoaded", () => {
    'use strict';

    const form = document.querySelector(".jsValid");
    const pass = form.querySelector('.formPass');
    const passConf = form.querySelector('.formPassConf');
    let isEmail = true;
    let isName = true;
    let isUsername = true;

    //Regular expressions
    const regName = /^([A-Z]{1}[a-z]{2,23}|[a-z]{3,23})$/
    const regEmail = /^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i;
    const regPass = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{5,20}$/


    const validateElem = (elem) => {

        // Name and username validation
        if ((elem.name === 'username') || (elem.name === 'name')){
            if(!regName.test(elem.value) && elem.value !== ''){
                if (elem.name === 'username') {
                    elem.nextElementSibling.textContent = 'Enter correct username. Example: "Name", "name".';
                    elem.style.borderColor = 'red';
                    isUsername = false;
                } else {
                    elem.nextElementSibling.textContent = 'Enter correct name. Example: "Name", "name".';
                    elem.style.borderColor = 'red';
                    isName = false;
                }
            } else {
                elem.nextElementSibling.textContent = '';
                elem.style.borderColor = 'white';
                isName = true;
                isUsername = true;
            }
        }
        //E-mail validation
        if (elem.name === 'email') {
            if(!regEmail.test(elem.value) && elem.value !== ''){
                elem.nextElementSibling.textContent = 'Enter correct e-mail. Example: "email@aaa.bbb" ';
                elem.style.borderColor = 'red';
                isEmail = false;
            } else {
                elem.nextElementSibling.textContent = '';
                elem.style.borderColor = 'white';
                isEmail = true;

            }
        }
        //Password validation
        if ((elem.name === "password") || (elem.name === "passwordConfirmation")){
            if (passConf.value !== pass.value && passConf.value !== "") {
                passConf.nextElementSibling.textContent = "Password do not match";
                elem.style.borderColor = 'red';
            } else {
                passConf.nextElementSibling.textContent = "";
                elem.style.borderColor = 'white';
            }

            if (!regPass.test(elem.value) && elem.value !== "") {
                elem.nextElementSibling.textContent = 'Enter correct password. Example: "Example1!"';
                elem.style.borderColor = 'red';
            } else {
                elem.nextElementSibling.textContent = "";
                elem.style.borderColor = 'white';
            }
        }
    };

    for(let elem of form.elements) {
        if ((elem.tagName !== 'BUTTON') || (elem.type !== 'hidden')){
            elem.addEventListener('blur', () => {
                validateElem(elem);
            });
        }
    }

    form.addEventListener('submit', (even) => {
        //Required fields validation
        for (let elem of form.elements) {
            if(elem.tagName !== "BUTTON") {
                if ((elem.value === '') && (elem.name !== 'email') && (elem.name !== 'userfile')){
                    elem.nextElementSibling.textContent = 'This field is required';
                    elem.style.borderColor = 'red';
                    even.preventDefault()
                }
            }
        }

        if ( (isEmail === false) || (isName === false) || (isUsername === false)){
            even.preventDefault()
        }
    });
});











