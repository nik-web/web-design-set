/*
 * Base application with Laminsas MVC framework
 * 
 * This file is the main script.
 * Licensed under MIT LICENSE
 */



//el = document.querySelector("hr");
//color = window.getComputedStyle(el).getPropertyValue("border-top-color");
//console.log(color);

/**
 * Supporded main navigation
 * 
 * @return {Boolean}
 */
function supportedMainNavigation() {
    // object HTMLDivElement or null
    let isScriptArea = document.getElementById('is-script');
    
    let isNoScriptArea = document.getElementById('is-no-script');
    
    if (null === isScriptArea) {
        return false;
    }
    
    if (isScriptArea.classList.contains('disable-site-nav')) {
        isScriptArea.classList.remove('disable-site-nav');
    }
    
    if (! isNoScriptArea.classList.contains('disable-site-nav')) {
        isNoScriptArea.classList.add('disable-site-nav');
    }
    
    // object HTMLButtonElement or null
    let hamburgerButton = document.getElementById('hamburg-main-nav');
    // object HTMLUListElement or null
    let mainNavBar = document.getElementById('main-nav-bar');
    
    if (null === hamburgerButton || null === mainNavBar) {
        //alert ('Button oder Navigation nicht gefunden!');
        
        return false;
    }
    
    function toggleMainNav() {
        hamburgerButton.classList.toggle ('open-hamburg');
        mainNavBar.classList.toggle ('open-main-nav-bar');
    }
    
    hamburgerButton.addEventListener('click', toggleMainNav);
    
    // object HTMLCollection
    let mainNavDropdownButtons = document.getElementsByClassName('main-nav-button');
    let mainNavDropdownMenus = document.getElementsByClassName('main-nav-bar-dropdown');
    
    for (let i = 0; i < mainNavDropdownButtons.length; i++) {
        
        mainNavDropdownButtons[i].addEventListener('click', function() {
            
            for (let j = 0; j < mainNavDropdownMenus.length; j++) {
            
                if (j !== i) {
                    if (mainNavDropdownMenus[j].classList.contains('main-nav-bar-dropdown-show')) {
                        mainNavDropdownMenus[j].classList.remove('main-nav-bar-dropdown-show');
                    }
                } else {
                    mainNavDropdownMenus[j].classList.toggle('main-nav-bar-dropdown-show');                  
                    if (mainNavDropdownMenus[j].classList.contains('main-nav-bar-dropdown-show')) {
                        mainNavDropdownButtons[i].classList.add('main-nav-button-open');
                    } else {
                        mainNavDropdownButtons[i].classList.remove('main-nav-button-open');
                    }                    
                }
            }            
        });
    }  
}

supportedMainNavigation();

// Show button site messanges close
function showButtonSiteMessagesClose() {    
    // [object HTMLCollection]
    let buttons =  document.getElementsByClassName('site-messages-close');
    // If no buttons return
    if (! buttons.length) {
        return;
    }
    for (let i = 0; i < buttons.length; i++) {
        if (! buttons[i].classList.contains('site-messages-close-show')) {
            buttons[i].classList.add('site-messages-close-show');
        }
    }
    
}

showButtonSiteMessagesClose();

// Close site messages
function closeSiteMessages() {    
    // [object HTMLCollection]
    let buttons =  document.getElementsByClassName('site-messages-close');
    // If no buttons return
    if (! buttons.length) {
        return;
    }
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click',  function() {
            this.parentElement.classList.add('alert-dismissible');
        });
    }
}

closeSiteMessages();
    
// Close the dropdown menu if the user clicks outside of the dropdown button
window.onclick = function(event) {
    if ( !event.target.matches(['.main-nav-button'])) {
        let dropdowns = document.getElementsByClassName("main-nav-bar-dropdown");
        for (let i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];            
            if (openDropdown.classList.contains('main-nav-bar-dropdown-show')) {
                openDropdown.classList.remove('main-nav-bar-dropdown-show');
                openDropdown.parentElement.classList.remove('main-nav-dropdown-item-open');
            }            
            // object HTMLButtonElement
            let button = openDropdown.previousElementSibling;
            if (button.classList.contains('main-nav-button-open')) {
                button.classList.remove('main-nav-button-open');
            }
        }
    }
};