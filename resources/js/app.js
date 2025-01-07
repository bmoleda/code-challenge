import './bootstrap';

// Gracefully handle searchable lists/inputs that have no value attr
// to hide numerical IDs the items (for the aesthetics):
var bmComboFields = document.querySelector('input[list].bm-combo-field');
if (bmComboFields !== null) {
    bmComboFields.addEventListener('input', function (e) {
        var list = e.target.getAttribute('list');
        var options = document.querySelectorAll('#' + list + ' option');
        var hiddenInputId = list.replace('_visible', '');
        var hiddenInput = document.getElementById(hiddenInputId);
        hiddenInput.value = "";

        for (var i = 0; i < options.length; i++) {
            var option = options[i];

            if (option.innerText === e.target.value) {
                hiddenInput.value = option.getAttribute('data-value');
                break;
            }
        }
    });
}
