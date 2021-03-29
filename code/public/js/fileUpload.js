let dropArea = document.getElementById('drop-area');
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false)
})

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

;['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
})

;['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
})

function highlight(e) {
    dropArea.classList.add('highlight');
}

function unhighlight(e) {
    dropArea.classList.remove('highlight');
}

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;
    handleFiles(files);
}

function handleFiles(files) {
    $('#success-message').hide();
    $('#error-message').hide()
    if (files.length < 5) {
        ([...files]).forEach(uploadFile)
    } else {
        errorMessage('Num of images not valid! (Max 4 imgs)');
    }
}

function uploadFile(file, i) {
    var url = 'addImages';
    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    xhr.open('POST', url, true);

    formData.append('file', file);
    xhr.send(formData)

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var item = JSON.parse(xhr.response);
            var template = $("#hidden-element-to-clone").clone(true);
            var randval = Math.floor(Math.random() * 1000);
            template.attr("id", "image-" + item.id);
            template.removeAttr('hidden');
            template.find("image").attr('href', item.path);
            template.find("button").data('elemid', item.id);
            template.find("button").attr('id', 'delete-'+item.id);

            template.find("svg").attr('aria-label', item.id);
            template.find("small").html(dateFormat(item.created_at));
            template.prependTo(".items");
            successMessage('The images have been uploaded!');

        }
        else if (xhr.readyState == 4 && xhr.status != 200) {
            errorMessage('Error during the upload');
        }
    }
}

function dateFormat(strtotime) {
    var myObj = $.parseJSON('{"date_created":"' + strtotime + '"}'),
        myDate = new Date(1000 * myObj.date_created);
    return myDate.toLocaleString();
}

function errorMessage(message) {
    $("html").animate({ scrollTop: 0 }, "slow");
    $('#error-message').show();
    $('#error-message').html('<div id="error-ico" class="fa">&#xf119</div>' + message);
}

function successMessage(message) {
    $("html").animate({ scrollTop: 0 }, "slow");
    $('#success-message').show();
    $('#success-message').html('<div id="error-ico" class="fa">&#xf118</div>' + message);
}