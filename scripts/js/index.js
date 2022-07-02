function activatethis(element, activation_class = 'active') {
    element.classList.add(activation_class);
}

function deactivatethis(element, activation_class = 'active') {
    element.classList.remove(activation_class);
}

function activate(item, activation_class = 'active') {
    let element = document.querySelector(item);
    element.classList.add(activation_class);
}

function deactivate(item, deactivation_class = 'active') {
    let element = document.querySelector(item);
    element.classList.remove(deactivation_class);
}

function deactivateAll(item, deactivation_class = 'active') {
    let element = document.querySelectorAll(item);

    for(i = 0; i < element.length; i++) {
        element[i].classList.remove(deactivation_class);
    }
    
}

function toggle_itm(item, toggle_class = 'active') {
    let element = document.querySelector(item);
    element.classList.toggle(toggle_class);
}

function toggle_this(element, toggle_class = 'active') {
    element.classList.toggle(toggle_class);
}

function activateAll (items, activation_class = 'active') {
    let elements = document.querySelectorAll(items);
    for(let item = 0; item < elements.length; item++) {
        elements[item].classList.add(activation_class)
    }
}

function isActive(item, item_class = 'active') {
    let element = document.querySelector(item);
    if (element.classList.contains(item_class)) {
        return true;
    }
    return false;
}

function itemsactive() {
    if(isActive('.mobile-nav') || isActive('.cart-nav')) {
        return true;
    }
    return false
}



function splitTexts(textObj) {
    //select element

    //split contents of the text into an array
    let animationText = textObj.innerText.split(' ');

    //create placeholder elements
    let element = '';
    let subElement = '';
    let subSubElement = '';
    let count = 1;

    //empty the selected element
    textObj.innerText = '';

    for( let text = 0; text < animationText.length; text++) {
        //create parent div element
        element = document.createElement('div');

        //create child span element
        subElement = document.createElement('span');

        //set style attributes for parent and child elements
        element.setAttribute('class', 'p-rel');
        element.setAttribute('style', 'margin: 0 .25rem;');
        subElement.setAttribute('class', 'p-rel');

        //asign one text in the text array to span element

        for (let subText = 0; subText < animationText[text].length; subText++) {
            // split assigned text into alphabets in spans
            subSubElement = document.createElement('span');
            subSubElement.innerText = animationText[text][subText];
            subSubElement.setAttribute('class', 'splitElement p-rel');
            subSubElement.setAttribute('style', `--count: ${count++};`);
            subElement.appendChild(subSubElement);
        }

        //append div to target element and span to div element
        element.appendChild(subElement);
        textObj.appendChild(element);
    }
}

function splitTargets(targets) {
    let targetElements = document.querySelectorAll(targets);

    for ( let target = 0; target < targetElements.length; target++) {
        splitTexts(targetElements[target]);

    }
}

function countSubItems(target) {
    let element = document.querySelector(target);
    let count = element.childElementCount;
    element.setAttribute('style', `--sub-items: ${count}`);
}

function toggle_class(target, class_one, class_two) {
    let element = document.querySelector(target);

    let check_class_one = class_one.replace('.','');
    let check_class_two = class_two.replace('.','');

    if( !element.classList.contains(check_class_one) ) {
        element.classList.add(class_one);
        element.classList.remove(class_two);
    }

    else if ( !element.classList.contains(check_class_two) ) {
        element.classList.add(class_two);
        element.classList.remove(class_one);
    }
}

function click_itm(target) {
    target = document.querySelector(target);
    target.click();
}

function milk_overlay(itm_class, state = 'active') {
    let element = document.querySelector('.milk-overlay');

    if(state == 'active') {

        if(!itemsactive()) {
            deactivate('.milk-overlay');
        }
        else activate('.milk-overlay');
        
    }

    else {
        deactivate('.milk-overlay');
    }
    
}

function menu_itm(items, item, link = 'home.html') {
    deactivateAll(items);
    activate(item);
    deactivate('.menu.mobile')
    location.href = link;
}

function menu_btn() {
    deactivateAll('.cart-nav');
    deactivateAll('.search');
    toggle_itm('.mobile-nav');
    toggle_itm('.menu-btn');
    milk_overlay('menu_close');
}

function cart_btn() {
    deactivateAll('.menu-btn');
    deactivateAll('.mobile-nav');
    deactivateAll('.search');
    toggle_itm('.cart-nav');
    milk_overlay('cart_close');
}

function search_btn() {
    deactivateAll('.menu-btn');
    deactivateAll('.mobile-nav');
    deactivateAll('.cart-nav');
    toggle_itm('.search');
    milk_overlay('search_close');
}

function hover_item(item, state = 'in') {

    if (state != 'in') {
        deactivateAll('.hover-item');
        deactivate('.milk-overlay');
    }

    else {
        deactivateAll('.hover-item');
        activate(item);
        activate('.milk-overlay');
    }
}

function set_value(value, element) {
    let item = document.querySelector(element);
    item.innerHTML = value;
}

function get_set_value(get_element, set_element) {
    let item_one = document.querySelector(get_element);
    let value = item_one.innerHTML;
    set_value(value, set_element);
}

function setType(element, target, c = 'a') {
    set_value(element.innerHTML, target);
    if(c == 'a')
    toggle_itm(".options");
}

// window.onscroll = () => {
//     if(scrollY > 50) {
//         activate('nav');
//     }
// }
