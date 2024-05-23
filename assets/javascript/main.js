// function that handles click on .param elements to update query and doctor list
document.addEventListener('DOMContentLoaded', function () {
    let params = document.querySelectorAll('.param');
    params.forEach(function(param) {
        param.addEventListener('click', function() {
            let paramName = this.getAttribute('data-param');
            let url = new URL(window.location);
            url.searchParams.delete(paramName);
            window.location.href = url;
        });
    });
});

document.getElementById('burger').addEventListener('click', function() {
    const navWrapper = document.getElementById('nav-wrapper');

    if (this.classList.contains('open')) {
        this.classList.remove('open');
        navWrapper.classList.add('closed');
    } else {
        this.classList.add('open');
        navWrapper.classList.remove('closed');
    }
});

// function to add class .selected to the wrapper of a selected appointment hour
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('.appointment input[type="radio"]');

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            radios.forEach(r => r.parentNode.classList.remove('selected'));

            if (radio.checked) {
                radio.parentNode.classList.add('selected');
            }
        });
    });

    radios.forEach(radio => {
        if (radio.checked) {
            radio.parentNode.classList.add('selected');
        }
    });
});