document.addEventListener('DOMContentLoaded', function() {
    const citiesByCountry = JSON.parse(document.getElementById('cities-data').getAttribute('data-cities'));
    const countrySelect = document.getElementById('country-select');
    const citySelect = document.getElementById('city-select');
    const selectedCity = document.getElementById('cities-data').getAttribute('data-selected-city');

    function updateCities() {
        const selectedCountry = countrySelect.value;

        // Reset city select with default option
        citySelect.innerHTML = '<option value="">Toutes les villes</option>';

        if (!selectedCountry) {
            // Show all cities from all countries
            Object.values(citiesByCountry).flat().forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.nom;
                if (city.nom === selectedCity) {
                    option.selected = true;
                }
                citySelect.appendChild(option);
            });
        } else if (citiesByCountry[selectedCountry]) {
            // Show cities only for selected country
            citiesByCountry[selectedCountry].forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.nom;
                if (city.nom === selectedCity) {
                    option.selected = true;
                }
                citySelect.appendChild(option);
            });
        }
    }

    countrySelect.addEventListener('change', updateCities);
    updateCities();
});