const form = document.getElementById('form');
const firstname = document.getElementById('firstname');
const lastname = document.getElementById('lastname');
const email = document.getElementById('email');
const number = document.getElementById('number');
const username = document.getElementById('username');
const password = document.getElementById('password');
const confirmpassword = document.getElementById('confirmpassword');

form.addEventListener('submit', e =>{
    e.preventDefault();


    validateInputs();
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = email => {

    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    return re.test(String(email).toLowerCase());
}
const validateInputs = () => {

    const firstnameValue = firstname.value.trim();
    const lastnameValue = lastname.value.trim();
    const emailValue = email.value.trim();
    const numberValue = number.value.trim();
    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();
    const confirmpasswordValue = confirmpassword.value.trim();

    if(firstnameValue === '') {
        setError(firstname, 'First name is required');
    } else {
        setSuccess(firstname);
    }

    if(lastnameValue === '') {
        setError(lastname, 'Last namre is required');
    } else {
        setSuccess(lastname);
    }

    if(emailValue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email');
    } else {
        setSuccess(email);
    }

    if(numberValue === '') {
        setError(number, 'Phone number is required');
    } else {
        setSuccess(number);
    }

    if(usernameValue === '') {
        setError(username, 'User namre is required');
    } else {
        setSuccess(username);
    }

    if(passwordValue === '') {

        setError(password, 'password is required');

    }else if (passwordValue.length < 6) {

        setError(password, 'password must be 6 character');

    } else if (!/(?=.*[A-Z])/.test(passwordValue)) {

        setError(password, 'Password must contain at least one uppercase letter');

    } else if (!/(?=.*\d)/.test(passwordValue)) {

        setError(password, 'Password must contain at least one number');

    }else {

        setSuccess(password);
    }

    if(confirmpasswordValue === '') {

        setError(confirmpassword, 'please confirm your password');

    }else if (passwordValue !== confirmpasswordValue) {

        setError(confirmpassword, 'password dosent match');

    }else {
        
        setSuccess(confirmpassword);
    }

};