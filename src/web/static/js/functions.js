const getValue = (selector) => {
    var elements = document.getElementsByName(selector);
    if(elements.length > 0) return elements[0].value;
    return '';
}

const getElement = (selector) => {
    var element = document.querySelector(selector);
    if(element) return element;
    return null;
}

const validInput = (selector) => {
    var e = getElement(selector);
    if(e.classList.contains('is-invalid')) e.classList.toggle('is-invalid');
    if(!e.classList.contains('is-valid')) e.classList.toggle('is-valid');
} 

const invalidInput = (selector, message) => {
    var e = getElement(selector);
    if(!e.classList.contains('is-invalid')) e.classList.toggle('is-invalid');
    var eMsg = getElement(`${selector}_error`);
    eMsg.innerText = message;
}