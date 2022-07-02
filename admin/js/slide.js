

class slide {
    constructor(slide_items, slide_duration) {
        this.slide_items = slide_items;
        this.slide_count = 2;
        this.slide_size = document.querySelectorAll(slide_items).length;
        this.slide_duration = slide_duration * 1000;
        this.slide_play();
    }

    activate(item, activate = 'activate') {
        let element = document.querySelector(item);
        let deactivate_clause = 'deactive';
        let activate_clause = 'active';

        if(activate == 'activate') {
            element.classList.remove(deactivate_clause);
            element.classList.add(activate_clause);
        }
        else {
            element.classList.remove(activate_clause);
            element.classList.add(deactivate_clause);
        }
    }

    deactivateAll(item, deactivation_class = 'active') {
        let element = document.querySelectorAll(item);
    
        for(let i = 0; i < element.length; i++) {
            element[i].classList.remove(deactivation_class);
        }
        
    }

    reset(value, start, end) {
        if(value == end) {
            return start;
        }
        else return ++value;
    }

    reset_neg(value, start, end) {
        if(value == end) {
            return start;
        }
        else return --value;
    }

    slide_core() {

        if(this.slide_count == 1) {
            this.activate(`${this.slide_items}:nth-of-type(${this.slide_size})`, 'deactivate');
        }
        this.activate(`${this.slide_items}:nth-of-type(${this.slide_count})`);

        if(this.slide_count > 1) {
            this.activate(`${this.slide_items}:nth-of-type(${this.slide_count - 1})`, 'deactivate');
        }

        this.slide_next();
    }

    slide_pause() {
        clearTimeout(this.slide_loop);
    }

    slide_play() {
        this.slide_loop = setTimeout(() => {
            this.slide_core();
        }, this.slide_duration);
    }

    slide_next() {
        this.slide_pause();
        this.slide_count = this.reset(this.slide_count, 1, this.slide_size);
        this.slide_play();
        console.log(this.slide_count);
    }

    slide_next_2() {
        this.deactivateAll(this.slide_items);
        this.activate(`${this.slide_items}:nth-of-type(${this.slide_count})`);
    }

    slide_back() {
        this.slide_pause();
        this.slide_count = this.reset_neg(this.slide_count, this.slide_size, 1);
        this.slide_play();
    }

    
}

