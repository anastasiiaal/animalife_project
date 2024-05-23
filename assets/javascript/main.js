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

// function that only allows submit of RDV form if both animal and time were selected
// also makes overlay visible if form is submitted
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('rdv');
    const overlay = document.getElementById('overlay');
    const animalRadios = document.querySelectorAll('input[type="radio"][name="animalId"]');
    const appointmentRadios = document.querySelectorAll('input[type="radio"][name="appointmentId"]');

    function updateButtonState() {
        const isAnimalSelected = Array.from(animalRadios).some(radio => radio.checked);
        const isAppointmentSelected = Array.from(appointmentRadios).some(radio => radio.checked);

        // Enable button if both radio groups have selections
        if (isAnimalSelected && isAppointmentSelected) {
            btn.classList.remove('disabled');
        } else {
            if (!btn.classList.contains('disabled')) {
                btn.classList.add('disabled');
            }
        }
    }

    animalRadios.forEach(radio => radio.addEventListener('change', updateButtonState));
    appointmentRadios.forEach(radio => radio.addEventListener('change', updateButtonState));

    btn.addEventListener('click', function() {
        if (!btn.classList.contains('disabled')) {
            overlay.classList.remove('hidden');
        }
    });
});