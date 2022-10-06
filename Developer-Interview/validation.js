const forNameE = document.querySelector('#forname');
const surNameE = document.querySelector('#surname');
const referenceE = document.querySelector('#reference');
const emailE = document.querySelector('#email');
const mobile = document.querySelector('#mobile');

const form = document.querySelector('#addData');


const checkForName = () => {

    let valid = false;

    const min = 3,
        max = 25;

    const forname = forNameE.value.trim();

    if (!isRequired(forname)) {
        showError(forNameE, 'Forname cannot be blank.');
    } else if (!isBetween(forname.length, min, max)) {
        showError(forNameE, `Forname must be between ${min} and ${max} characters.`)
    } else {
        showSuccess(forNameE);
        valid = true;
    }
    return valid;
};

const checkSurName = () => {

    let valid = false;

    const min = 3,
        max = 25;

    const surname = surNameE.value.trim();

    if (!isRequired(surname)) {
        showError(surNameE, 'surname cannot be blank.');
    } else if (!isBetween(surname.length, min, max)) {
        showError(surNameE, `surname must be between ${min} and ${max} characters.`)
    } else {
        showSuccess(surNameE);
        valid = true;
    }
    return valid;
};


const checkEmail = () => {
    let valid = false;
    const email = emailE.value.trim();
    if (!isEmailValid(email)) {
        showError(emailE, 'Email is not valid.')
    } else {
        showSuccess(emailE);
        valid = true;
    }
    return valid;
};

const checkReference = () => {
    let valid = false;


    const reference = referenceE.value.trim();

    if (!isRequired(reference)) {
        showError(referenceE, 'reference cannot be blank.');
    } else if (!isReferenceCorrect(password)) {
        showError(referenceE, 'reference must has at least 8 characters that include at least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in (!@#$%^&*)');
    } else {
        showSuccess(referenceE);
        valid = true;
    }

    return valid;
};

const checkMobile = () => {
    let valid = false;
    const mobile = mobileE.value.trim();
    if (!ismobileValid(mobile)) {
        showError(mobileE, 'Mobile number is not valid.')
    } else {
        showSuccess(mobileE);
        valid = true;
    }
    return valid;
};


const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};
// change to reference validation
const isReferenceCorrect = (reference) => { 
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return re.test(reference);
};

const isRequired = value => value === '' ? false : true;
const isBetween = (length, min, max) => length < min || length > max ? false : true;


const showError = (input, message) => {
    // get the form-field element
    const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {
    // get the form-field element
    const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const error = formField.querySelector('small');
    error.textContent = '';
}


form.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();

    // validate fields
    let isfornameValid = checkforname(),
        isEmailValid = checkEmail(),
        isreferenceValid = checkReference(),
        issurnameValid = checkSurName();
        ismobileValid = checkMobile();

    let isFormValid = isforNameValid &&
        isEmailValid &&
        issurNameValid &&
        ismobileValid &&
        isreferenceValid;

    // submit to the server if the form is valid
    if (isFormValid) {

        
    }
});

