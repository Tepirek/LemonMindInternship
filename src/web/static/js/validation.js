var sourceInput = getElement('#source');
var destinationInput = getElement('#destination');
var airplaneTypeInput = getElement('#airplaneType');
var dateInput = getElement('#date');

const validate = () => {
    var source = sourceInput.value;
    var destination = destinationInput.value;
    var type = airplaneTypeInput.value;
    var date = dateInput.value;
    var validSource = true;
    var validDestination = true;
    var validType = true;
    var validDate = true;

    if(source == undefined || String(source).trim().length <= 0) {
        validSource = false;
        invalidInput('#source', 'Wprowadź poprawne miejsce!');
    } else validInput('#source');

    if(destination == undefined || String(destination).trim().length <= 0) {
        validDestination = false;
        invalidInput('#destination', 'Wprowadź poprawne miejsce!');
    } else validInput('#destination');

    if(type == undefined || !['Airbus A380', 'Boeing 747'].includes(type)) {
        validType = false;
        invalidInput('#airplaneType', 'Wybierz typ samolotu!');
    } else validInput('#airplaneType');

    if(date == undefined || !(new RegExp('^([0-9]{2}).([0-9]{2}).([0-9]{4})$').test(date))) {
        validDate = false;
        invalidInput('#date', 'Wprowadź lub wybierz poprawną datę!');
    } else validInput('#date');

    if(validSource && validDestination && validType && validDate) return true;
    return false;
}