let upload_box = document.querySelector('form.upload_box');
let panel_preview = document.querySelector('.image_server .panel_preview');
panel_preview.innerHTML = '';

let image_server = {
    'image' : '',
    'target' : '',
}

let preventDefaults = (e) => {
    e.preventDefault();
    e.stopPropagation();
}

let hightlight = () => {
    activatethis(upload_box, "highlight");
}

let unhighlight = () => {
    deactivatethis(upload_box, "hightlight");
}

let handledrop = (e) => {
    let dt = e.dataTransfer;
    let files = dt.files;

    activate('.loader');
    handlefiles(files);
    deactivate('.loader');
}

let handlefiles = (files) => {
    ([...files]).forEach(uploadFile);
    deactivatethis(upload_box);
    // ([...files]).forEach(previewImage);
    console.log('working');
    panel_preview.innerHTML = '';
    fetch_images(0, 10);
}


let uploadFile = (file) => {
    let images = new FormData();
    images.append('file', file);

    $.ajax({
        method: "POST",
        url: '../backend/handlers/facility_handler/php/upload_images.php',
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        data:  images,
        success: (data) => {
            // do stuff after upload;
            console.log(data);
        }
    })
}

let image_id = 0;

let fetch_images = (start_id, limit) => {
    $.ajax({
        method: "POST",
        url: '../backend/handlers/facility_handler/php/fetch_images.php',
        data: {start_id: start_id, limit: limit},
        success: (data) => {
            console.log(data);
            $.each(data, (key, value) => {
                panel_preview.innerHTML += `
                    <div class = 'ov-hidden' onclick = 'set_focus(this);'>
                        <img src = '../image_server/${value['image_url']}' class = 'obj-fit'>
                    </div>
                `;

                image_id = value['id'];
            })
        }
    })
}

fetch_images(0, 20);

let image_more = () => {
    fetch_images(image_id, 20);
}

let previewImage = (file) => {
    let reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onloadend = () => {
        let img = document.createElement('img');
        let div = document.createElement('div');

        img.setAttribute('src', reader.result);
        div.setAttribute('class', 'ov-hidden');
        div.setAttribute('onclick', 'set_focus(this);');
        div.appendChild(img);

        document.querySelector('.panel_preview').insertAdjacentElement('afterbegin', div);
    }
}

let set_focus = (target) => {
    document.querySelector('.panel_focus img').src = target.querySelector('img').src;
}

let set_image = () => {
    image_server.image = document.querySelector('.image_server .panel_focus img').src;
    image_server.target.querySelector('img').src = image_server.image;
    deactivate('.image_server');
}

let set_target = (target) => {
    image_server.target = target;
}

['dragenter', 'dragover', 'dragleave', 'drop'].forEach( event_trigger => {
    upload_box.addEventListener( event_trigger, preventDefaults, false);
});

['dragenter', 'dragover'].forEach( event_trigger => {
    upload_box.addEventListener( event_trigger, hightlight, false);
});

['dragleave', 'drop'].forEach( event_trigger => {
    upload_box.addEventListener( event_trigger, unhighlight, false);
});

upload_box.addEventListener('drop', handledrop, false);
