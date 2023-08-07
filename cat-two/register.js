
const form = document.getElementById('form');
const accountType = document.getElementById('accountType');
const username = document.getElementById('username');
const email = document.getElementById('email');
const phoneNumber = document.getElementById('phoneNumber');
const dob = document.getElementById('dob');
const password = document.getElementById('password');

form.addEventListener('submit', (e) => {
   e.preventDefault()

   // check empty fields
   if (isEmpty(accountType)) {
      alert('Account type cannot be empty!');
      return;
   }
   if (isEmpty(username)) {
      alert('Username type cannot be empty!');
      return;
   }
   if (isEmpty(email)) {
      alert('Email cannot be empty!');
      return;
   }
   if (isEmpty(phoneNumber)) {
      alert('Phone number cannot be empty!');
      return;
   }
   if (isEmpty(dob)) {
      alert('Date of birth cannot be empty!');
      return;
   }
   if (isEmpty(password)) {
      alert('Date of birth cannot be empty!');
      return;
   }

   // check email for [%@%.%]
   if (!isEmailValid(email)) {
      alert('Email is not valid!');
      return;
   }

   // check phone number
   if (!isPhoneNumberValid(phoneNumber)) {
      alert('Phone number is not valid!');
      return;
   }

   // check age above 18
   if (!isAgeValid(dob)) {
      alert('Age is not valid!');
      return;
   }

   // check password
   if (!isPasswordValid(password)) {
      alert('Password is not valid!');
      return;
   }

   // success dialog
   // alert(`You "${username.value}" have successfully registered as "${getSelectedOptionText(accountType)}"`);

   form.submit();
})


function isEmpty(formElement) {
   // checks for empty values in any form element
   return formElement.value.length < 1;
}

function isEmailValid(formEmailInput) {
   // \S allows any character, @ . checks for '@' '.'
   return /\S+@\S+\.\S+/.test(formEmailInput.value);
}

function isAgeValid(formDobElement) {
   const dob = new Date(formDobElement.value);
   const today = new Date();
   dob.setFullYear(dob.getFullYear() + 18);
   return dob.getTime() <= today.getTime();
}

function isPhoneNumberValid(formPhoneNumberInput) {
   const numberString = formPhoneNumberInput.value
   // check kenyan code
   if (!numberString.startsWith('254')) {
      return false;
   }
   // check if characters are enough
   // 254 712 345678 as example: 12 characters without the spaces in between
   if (numberString.length != 12) {
      return false;
   }
   return true;
}

function isPasswordValid(formPasswordInput) {
   const passwordString = formPasswordInput.value;
   if (passwordString.length < 8) {
      alert('Password must be at least 8 characters!');
      return false;
   }
   // checks for numbers and uppercase letters only
   if (/^[\dA-Z]+$/.test(passwordString)) {
      return true;
   } else {
      alert('Password has only digits and uppercase letters!')
      return false;
   }
}

function getSelectedOptionText(select) {
   // returns the text of the selected option in a select box
   // remember .value returns the value no the text
   return select.options[select.selectedIndex].text;
}

function containsNumbersOnly(string) {
   // regular expression is written between 2 forward slashes /.../
   // ^ asserts the beginning of the string
   // $ asserts the end of the string
   // + matches the previous token/condition one or more times eg: ensures there's at least one character matching that expression
   // \d matches any digit (0-9)
   return /^\d+$/.test(string);
}

function containsStringOnly(string) {
   // [a-zA-Z] matches any lowercase or uppercase letter
   return /^[a-zA-Z]+$/.test(string);
}