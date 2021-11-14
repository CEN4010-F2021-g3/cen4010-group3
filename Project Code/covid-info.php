<?php
include_once './includes/header.php'
?>
<link href="assets/css/style.css" rel="stylesheet" />

<div class="container-fluid bg-1 text-center">
    <h1 class="info_subtitle">COVID-19 Info</h1>
</div>

<div class="container-fluid bg-1 text-center">
    <img src="assets/img/Covid.jpg" width="20%" alt="covid image">
</div>

<div class="container-fluid bg-1 text-center">
    <p> The official name for COVID-19 is SARS-CoV-2 or serve acute respiratory syndrome coronavirus 2.</p>
    <p> COVID-19 is a disease that mainly attacks the respiratory system in one's body.</p>
    <p> Although some may contract the disease not all cases are the same with some being more impacted than others. </p>
    <p> This disease when first started in America attacked more of the older generation however nowadays cases include any age range.</p>
    <p> With the increase of cases there was a vaccine created by companies such as Pfizer and Moderna trying to combat the disease.</p>
    <p> Although with efforts of trying to get rid of this disease, the disease has grown more in different variants such as the Alpha and Delta Variant.</p>
</div>



<div class="container-fluid bg-2 text-center">
    <div class="data-container">
        <div class="stats-container">
            <h4>Country</h4>
            <h1 id="country">United States</h1>
            <h4>Population</h4>
            <h1 id="population"></h1>
            <h4>Last Updated</h4>
            <h1 id="update"></h1>
        </div>
        <div class="location-container">
            <h4>Cases</h4>
            <h1 id="cases"></h1>
            <h4>Deaths</h4>
            <h1 id="deaths"></h1>
            <h4>% of Deaths</h4>
            <h1 id="percent"></h1>
        </div>
    </div>
</div>

<?php
include_once './includes/footer.php'
?>