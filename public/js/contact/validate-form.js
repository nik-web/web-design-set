/* 
 * Validate contact-form
 * 
 * https://css-tricks.com/snippets/javascript/loop-queryselectorall-matches/
 * 
 * https://jscompress.com/
 */

/**
 * Check length of the adjusted value of the input element
 * 
 * @param {object} inputElement HTMLInputElement
 * @param {number} length
 * @return {boolean}
 */
function validateLength(inputElement, length) {
    if (length === inputElement.value.trim().length) {        
        return true;
    }    
    return false;
}

/**
 * Check min. length of the adjusted value of the input element
 * 
 * @param {object} inputElement HTMLInputElement
 * @param {number} minLength
 * @return {boolean}
 */
function validateMinLength(inputElement, minLength) {
    if (minLength > inputElement.value.trim().length) {
        return false;
    }
    return true;
}

/**
 * Check max. length of the adjusted value of the input element
 * 
 * @param {object} inputElement HTMLInputElement
 * @param {number} maxLength
 * @return {boolean}
 */
function validateMaxLength(inputElement, maxLength) {
    if (maxLength < inputElement.value.trim().length) {
        return false;
    }
    return true;
}

/**
 * Check if email adress is valide
 * 
 * @param {object} inputElement
 * @return {boolean}
 */
function validateEmailAdress(inputElement) {
    let value = inputElement.value.trim();
    let emailRegex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
    if (value.match(emailRegex)) {
        return true;
    }
    return false;
}

/**
* Add error classes to the input element and to his description
* 
* @param {object} formElementDescription 
* @param {object} formElement
* @return {undefined}
*/
function addErrorClasses( formElementDescription, formElement) {
   formElementDescription.classList.add('not-valid-input-description');
   if (undefined !== formElement) {
       formElement.classList.add('not-valid-input');
   }
}

/**
* Remove error classes from the input element and from his description
* 
* @param {object} formElementDescription 
* @param {object} formElement
* @return {undefined}
*/
function removeErrorClasses(formElementDescription, formElement) {
   formElementDescription.classList.remove('not-valid-input-description');
   if (undefined !== formElement) {
       formElement.classList.remove('not-valid-input');
   }
}

function validateContactForm() {
    // [object HTMLFormElement] or undefined
    let contactForm = document.forms['contact_form'];
    if (undefined === contactForm) {
        return false;
    }
    
    //alert (document.getElementById('forename')); // object HTMLInputElement or null
    
    //alert (forename = contactForm.elements['forename']); // object HTMLInputElement or undefined
        
    /**
     * Validate input type text element forename
     * 
     * @return {boolean}
     */
    function validateForename() {
        // object HTMLInputElement or undefined
        let forename = contactForm.elements['forename'];
        if (undefined === forename) {
            console.log('%cError: No input element forename found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }
        // object HTMLElement or null
        let description = document.getElementById('forename-description');
        if (null === description) {
            console.log('%cError: No description found for the input element forename!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        let minLength = 2;
        let maxLength = 128;
        let notValid = false;
        if (!validateMinLength(forename, minLength)) {
            notValid = true;
            addErrorClasses(description, forename);
        } else if (!validateMaxLength(forename, maxLength)) {
            notValid = true;
            addErrorClasses(description, forename);
        } else {
            removeErrorClasses(description, forename);
        }
        
        return notValid;
    }
    
    /**
     * Validate input type text element surname
     * 
     * @return {boolean}
     */
    function validateSurname() {
        // object HTMLInputElement or undefined
        let surname = contactForm.elements['surname'];        
        if (undefined === surname) {
            console.log('%cError: No input element surname found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }
        // object HTMLElement or null
        let description = document.getElementById('surname-description');        
        if (null === description) {
            console.log('%cError: No description found for the input element surname!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        let minLength = 2;
        let maxLength = 128;
        let notValid = false;
        if (!validateMinLength(surname, minLength)) {
            notValid = true;
            addErrorClasses(description, surname);
        } else if (!validateMaxLength(surname, maxLength)) {
            notValid = true;
            addErrorClasses(description, surname);
        } else {
            removeErrorClasses(description, surname);
        }
        
        return notValid;
    }
    
    // Validate form element email
    function validateEmail() {
        // object HTMLInputElement or undefined
        let email =  contactForm.elements['email'];        
        if (undefined === email) {
            console.log('%cError: No input element email found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        // object HTMLElement or null
        let description = document.getElementById('email-description');        
        if (null === description) {
            console.log('%cError: No description found for the input element email!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        let notValid = false;
        if (validateEmailAdress(email)) {
            removeErrorClasses(description, email);
        } else {
            notValid = true;
            addErrorClasses(description, email);
        }
        
        return notValid;
    }
    
    // Validate form element subject
    function validateSubject() {
        // object HTMLInputElement or undefined
        let subject = contactForm.elements['subject'];
        if (undefined === subject) {
            console.log('%cError: No input element subject found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }
        // object HTMLElement or null
        let description = document.getElementById('subject-description');
        if (null === description) {
            console.log('%cError: No description found for the input element subject!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        let minLength = 2;
        let maxLength = 128;
        let notValid = false;
        if (!validateMinLength(subject, minLength)) {
            notValid = true;
            addErrorClasses(description, subject);
        } else if (!validateMaxLength(subject, maxLength)) {
            notValid = true;
            addErrorClasses(description, subject);
        } else {
            removeErrorClasses(description, subject);
        }
        
        return notValid;
    }
    
    // Validate form element message
    function validateMessage() {
        // object HTMLTextAreaElement or undefined
        let message = contactForm.elements['message'];
        if (undefined === message) {
            console.log('%cError: No text area element message found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        // object HTMLElement or null
        let description = document.getElementById('message-description');
        if (null === description) {
            console.log('%cError: No description found for the input element message!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        let minLength = 3;
        let maxLength = 4096;
        let notValid = false;
        if (!validateMinLength(message, minLength)) {
            notValid = true;
            addErrorClasses(description, message);
        } else if (!validateMaxLength(message, maxLength)) {
            notValid = true;
            addErrorClasses(description, message);
        } else {
            removeErrorClasses(description, message);
        }
        
        return notValid;
    }
    
    // Validate form element checkbox "accept privacy policy"
    function validateAcceptPrivatePoliy() {
        // object HTMLInputElement|null
        let checkbox =  document.getElementById("accept-privacy-policy");
        if (null === checkbox) {
            console.log('%cError: No input checkbox element accept-privacy-policy found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        let notValid = true;
        // object HTMLLabelElement
        let label = document.getElementById("privacy-policy-label");
        if (null === label) {
            console.log('%cError: No label for input checkbox element accept-privacy-policy found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        if (checkbox.checked) {
            notValid = false;
            removeErrorClasses(label, checkbox);
        } else {
            addErrorClasses(label, checkbox);
        }
        
        return notValid;        
    }
    
    // Validate form element checkbox "data processed accepted"
    function validateDataProcessedAccepted() {
        // object HTMLInputElement|null
        let checkbox =  document.getElementById("data-processed-accepted");
        if (null === checkbox) {
            console.log('%cError: No input checkbox element data-processed-accepted found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }        
        let notValid = true;
        // object HTMLLabelElement
        let label = document.getElementById("data-processed-accepted-label");
        if (null === label) {
            console.log('%cError: No label for input checkbox element data-processed-accepted-label found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }
        if (checkbox.checked) {
            notValid = false;
            removeErrorClasses(label, checkbox);
        } else {
            addErrorClasses(label, checkbox);
        }
        
        return notValid;        
    }
    
    // Validate form element text "contact captcha"
    function validateContactCaptcha() {
        let element = document.getElementById("captcha");
        if (null === element) {
            console.log('%cError: No input element captcha found!', 'background-color: pink; color: red; padding: 5px');
            
            return false;
        }
        let notValid = true;                
        // object HTMLElement or null
        let description = document.getElementById('captcha-description');
        if (null === description) {
            alert ('Fehler: Keine Beschreibung für das Captcha Element gefunden!');
            
            return false;
        }
        let length = 4;
        if (validateLength(element, length)) {
            notValid = false;
            removeErrorClasses(description, element);
        } else {
            addErrorClasses(description, element);
        }
        
        return notValid;
    }
    
    // Remove flash messages
    function removeFlashMessages() {
        let messages = document.getElementsByClassName('alert');
        for (let i = 0; i < messages.length; i++) {
            messages[i].classList.add('alert-dismissible');
        }
    }

    contactForm.addEventListener('submit', function(evt) {
        let element = false;
        let error = false;
        if (validateContactCaptcha()) {
            element = document.getElementById('captcha');
            error = true;
        }        
        if (validateDataProcessedAccepted()) {
            element = document.getElementById('data-processed-accepted');
            error = true;
        }
        if (validateAcceptPrivatePoliy()) {
            element = document.getElementById('accept-privacy-policy');
            error = true;
        }
        if (validateMessage()) {
            element = document.getElementById('message');
            error = true;
        }
        if (validateSubject()) {
            element = document.getElementById('subject');
            error = true;
        }
        if (validateEmail()) {
            element = document.getElementById('email');
            error = true;
        }
        if (validateSurname()) {
            element = document.getElementById('surname');
            error = true;
        }
        if (validateForename()) {
            element = document.getElementById('forename');
            error = true;
        }
        if (error) {
            // Inputs are incorrect and older browsers should be supported
            (evt.preventDefault) ? evt.preventDefault() : evt.returnValue = false;
        }
        // If element with error exist
        if (element) {
            // remove the flashmessages if exist
            removeFlashMessages();
            // Scroll to the first element with error
            window.scrollTo( 0, element.offsetTop );
        }
    });
}

validateContactForm();