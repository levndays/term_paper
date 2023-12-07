$(document).ready(function () {
    // Enable the Register button when all fields are filled
    $('form input').on('input', function () {
        const isFormValid = $('form')[0].checkValidity();
        const isAddressFilled = $('#address').val().trim() !== '';
        $('#registerBtn').prop('disabled', !(isFormValid && isAddressFilled));
    });
});

function updateAddress(latlng) {
    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latlng.lat}&lon=${latlng.lng}&format=json`)
        .then(response => response.json())
        .then(data => {
            const address = data.display_name;
            $('#address').val(address);
        })
        .catch(error => {
            console.error('Error fetching address:', error);
        });
}
