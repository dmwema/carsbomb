function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function preview_card1(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('card1');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function preview_card2(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('card2');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function preview_rib(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('rib');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}