<style>
    .radio-card-group {
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    .radio-card {
        width: 150px;
        padding: 20px;
        border: 2px solid #ddd;
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        background-color: #fff;
        transition: all 0.3s ease;
    }

    /* Hover effect */
    .radio-card:hover {
        border-color: #007BFF;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
        transform: scale(1.05);
    }

    /* When the radio button is selected (checked) */
    .radio-card input[type="radio"]:checked + label {
        color: #007BFF;
        font-weight: bold;
    }

    .radio-card input[type="radio"]:checked + label i {
        color: #007BFF;
    }

    /* Apply different selected effect */
    .radio-card input[type="radio"]:checked + label {
        border-color: #007BFF;
        background-color: #f0f8ff; /* Different background when selected */
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3); /* A more noticeable shadow */
        transform: scale(1); /* No scaling on selection */
    }

    .radio-card input[type="radio"] {
        display: none;
    }

    .radio-card i {
        font-size: 30px;
        color: #555;
        margin-bottom: 10px;
        display: inline-block;
        transition: color 0.3s ease;
    }

    .radio-card label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #555;
        margin-top: 10px;
        transition: color 0.3s ease, font-weight 0.3s ease;
    }
</style>

<div class="row">
    <div class="col-12 col-md-4 d-flex justify-content-end mb-3">
        <div class="radio-card fv-row text-center">
            <input type="radio" id="card1" name="assessment_cat" value="MPCA Assessment" checked>
            <label for="card1">
                <i class="ki-duotone ki-abstract-31 fs-3tx img">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <br>
                MPCA Assessment
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 d-flex justify-content-center mb-3">
        <div class="radio-card fv-row text-center">
            <input type="radio" id="card2" name="assessment_cat" value="Livelihood Assessment">
            <label for="card2">
                <i class="ki-duotone ki-virus fs-3tx img">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <br>
                Livelihood Assessment
            </label>
        </div>
    </div>

    <div class="col-12 col-md-4 d-flex justify-content-start mb-3">
        <div class="radio-card fv-row text-center">
            <input type="radio" id="card3" name="assessment_cat" value="Kitchen Gardening">
            <label for="card3">
                <i class="ki-duotone ki-people fs-3tx img">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                <br>
                Kitchen Gardening
            </label>
        </div>
    </div>
</div>
