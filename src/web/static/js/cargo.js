const button = document.querySelector('.addNewCargo i');
const newCargo = document.querySelector('.newCargo');
const newCargoBtn = document.querySelector('#newCargoButton');
var pressed = false;
var cargoId = 0;

button.addEventListener('click', () => {
    if(pressed) {
        pressed = false;
        newCargo.style.display = 'none';
    } else {
        pressed = true;
        newCargo.style.display = 'block';
    }
});

newCargoBtn.addEventListener('click', () => {
    var name = getValue('cargoName');
    var weight = getValue('cargoWeight');
    var type = getValue('cargoType');
    var airplaneType = getValue('airplaneType');
    var validName = true, validWeight = false, validType = true;
    if(name == undefined || String(name).trim().length <= 0) {
        validName = false;
        invalidInput('#cargoName', 'Wprowadź nazwę ładunku!');
    } else validInput('#cargoName');
        if(!['Airbus A380', 'Boeing 747'].includes(airplaneType)) {
            invalidInput('#cargoWeight', 'Wybierz najpierw typ samolotu!');
        } else if (airplaneType.includes('Airbus A380') && parseInt(weight) > 35000) {
            invalidInput('#cargoWeight', 'Waga pojedynczego ładunku nie może przekroczyć 35 ton!');
        } else if (airplaneType.includes('Boeing 747') && parseInt(weight) > 38000) {
            invalidInput('#cargoWeight', 'Waga pojedynczego ładunku nie może przekroczyć 38 ton!');
        } else if(!new RegExp('[0-9]$').test(weight) || weight <= 0) {
            invalidInput('#cargoWeight', 'Wprowadź poprawną wagę ładunku!');
        } else {
            validWeight = true;
            validInput('#cargoWeight');
        }
    if(type == undefined || !['normal', 'dangerous'].includes(type)) {
        validType = false;
        invalidInput('#cargoType', 'Wybierz typ ładunku!');
    } else validInput('#cargoType');

    if(validName && validWeight && validType) {
        var data = {
            'id': cargoId,
            'name': name,
            'weight': weight,
            'type': type
        };
        cargos.push(data);
        console.log(cargos);
        createCargo(data, cargoId);
        cargoId += 1;
        resetNewCargo();
    }
});

const createCargo = (data, id) => {
    const currentCargos = document.querySelector('.currentCargos');
    var cargo = document.createElement('div');
    cargo.id = `cargo_${id}`;
    cargo.classList.add('cargoItem', 'col-md-4', 'col-6');
    cargo.innerHTML = `
        <i class="icon-flight"></i>
        <div class="cargoItemName">${data.name}</div>
        <div class="cargoItemWeight">${data.weight} kg</div>
        <div class="cargoItemType">${data.type}</div>
        <i class="icon-trash" id="delete_cargo_${id}"></i>
    `;
    currentCargos.appendChild(cargo);
    var deleteBtn = getElement(`#delete_cargo_${id}`);
    deleteBtn.addEventListener('click', () => {
        var cargo = getElement(`#cargo_${id}`);
        cargo.parentElement.removeChild(cargo);
        cargos = cargos.filter(c => c.id != id);
    });
}

const resetInput = (selector) => {
    var e = getElement(selector);
    e.value = '';
    e.classList.remove('is-valid');
}

const resetNewCargo = () => {
    pressed = false;
    newCargo.style.display = "none";
    resetInput('#cargoName');
    resetInput('#cargoWeight');
    resetInput('#cargoType');
}