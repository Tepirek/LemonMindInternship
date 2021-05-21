<?php

?>

<!DOCTYPE html>
<html lang="en">

<?php require('../../views/header.php') ?>

<body>

    <form class="col-11 col-md-9 col-lg-7 row g-2" method="post" action="/api/transport" enctype="multipart/form-data"
        novalidate>
        <div class="form-floating col-sm-6">
            <input type="text" class="form-control" name="source" id="source" placeholder=" " required
                autocomplete="off">
            <label for="source">Transport z</label>
            <div id="source_error" class="invalid-feedback"></div>
        </div>
        <div class="form-floating col-sm-6">
            <input type="text" class="form-control" name="destination" id="destination" placeholder=" " required
                autocomplete="off">
            <label for="destination">Transport do</label>
            <div id="destination_error" class="invalid-feedback"></div>
        </div>
        <div class="form-floating col-sm-6">
            <select class="form-select" name="airplaneType" id="airplaneType" required autocomplete="off">
                <option selected value="">Wybierz</option>
                <option value="Airbus A380">Airbus A380</option>
                <option value="Boeing 747">Boeing 747</option>
            </select>
            <label for="airplaneType" class="form-label">Typ samolotu</label>
            <div id="airplaneType_error" class="invalid-feedback"></div>
        </div>
        <div class="form-floating col-sm-6">
            <input type="text" class="form-control" name="date" id="date" placeholder=" " required autocomplete="off">
            <label for="date">Data transportu</label>
            <div id="date_error" class="invalid-feedback"></div>
        </div>
        <div class="form-floating col-md-12">
            <div class="uploadBox">
                <i class="icon-upload"></i>
                <input class="box__files" type="file" name="files[]" id="files" multiple="true">
                <label for="files"><strong><u>Wybierz</u> </strong>lub przeciągnij
                    tutaj</span>.</label>
            </div>
        </div>
        <div class="form-floating col-md-12">
            <div class="uploadedFiles">

            </div>
        </div>
        <div class="form-floating col-md-12">
            <div class="addNewCargo">
                Dodawanie ładunków
                <i class="icon-plus"></i>
            </div>
        </div>
        <div class="newCargo">
            <div class="form-floating col-md-12 mb-2">
                <input type="text" class="form-control" name="cargoName" id="cargoName" placeholder=" " required
                    autocomplete="off">
                <label for="cargoName">Nazwa ładunku</label>
                <div id="cargoName_error" class="invalid-feedback">
                    Wprowadź nazwę ładunku!
                </div>
            </div>
            <div class="form-floating col-md-12 mb-2">
                <input type="number" class="form-control" name="cargoWeight" id="cargoWeight" placeholder=" " required
                    autocomplete="off">
                <label for="weight">Ciężar ładunku [kg]</label>
                <div id="cargoWeight_error" class="invalid-feedback">
                    Wprowadź nazwę ładunku!
                </div>
            </div>
            <div class="form-floating col-md-12 mb-2">
                <select class="form-select" name="cargoType" id="cargoType" required autocomplete="off">
                    <option selected value="">Wybierz</option>
                    <option value="normal">ładunek zwykły</option>
                    <option value="dangerous">ładunek niebezpieczny</option>
                </select>
                <label for="cargoType" class="form-label">Typ ładunku</label>
                <div id="cargoType_error" class="invalid-feedback">
                    Wybierz typ ładunku!
                </div>
            </div>
            <div class="form-floating d-flex justify-content-center col-md-12">
                <button class="btn btn-primary" id="newCargoButton" type="button">Dodaj ładunek</button>
            </div>
        </div>
        <div class="form-floating col-md-12">
            <div class="currentCargos">

            </div>
        </div>
        <div class="form-floating d-flex justify-content-center col-md-12">
            <button class="btn btn-primary col-3" type="submit">Wyślij</button>
        </div>
    </form>
    <script src="/static/js/globals.js"></script>
    <script src="/static/js/functions.js"></script>
    <script src="/static/js/validation.js"></script>
    <script src="/static/js/datepicker.js"></script>
    <script src="/static/js/dragndrop.js"></script>
    <script src="/static/js/cargo.js"></script>
</body>

</html>