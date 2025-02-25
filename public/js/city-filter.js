document.addEventListener('DOMContentLoaded', function() {
    const citiesByCountry = JSON.parse(document.getElementById('cities-data').getAttribute('data-cities'));
    const countrySelect = document.getElementById('country-select');
    const citySelect = document.getElementById('city-select');
    const selectedCity = document.getElementById('cities-data').getAttribute('data-selected-city');

    function updateCities() {
        const selectedCountry = countrySelect.value;
        citySelect.innerHTML = '<option value="">Toutes les villes</option>';
        
        if (!selectedCountry) {
            Object.values(citiesByCountry).flat().forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                if (city === selectedCity) {
                    option.selected = true;
                }
                citySelect.appendChild(option);
            });
        } else if (citiesByCountry[selectedCountry]) {
            citiesByCountry[selectedCountry].forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                if (city === selectedCity) {
                    option.selected = true;
                }
                citySelect.appendChild(option);
            });
        }
    }

    countrySelect.addEventListener('change', updateCities);
    updateCities();
});
