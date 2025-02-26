document.addEventListener('DOMContentLoaded', function() {
    const countrySelect = document.getElementById('country-select');
    const citySelect = document.getElementById('city-select');
    const citiesDataElement = document.getElementById('cities-data');
    
    if (!countrySelect || !citySelect || !citiesDataElement) {
        return;
    }
    
    const citiesByCountry = JSON.parse(citiesDataElement.dataset.cities);
    const selectedCity = citiesDataElement.dataset.selectedCity;
    
    function updateCities() {
        const selectedCountry = countrySelect.value;
        
        // Clear city options
        citySelect.innerHTML = '<option value="">Toutes les villes</option>';
        
        if (selectedCountry && citiesByCountry[selectedCountry]) {
            citiesByCountry[selectedCountry].forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                option.selected = city === selectedCity;
                citySelect.appendChild(option);
            });
        }
    }
    
    // Initialize cities based on current country selection
    updateCities();
    
    // Update cities when country changes
    countrySelect.addEventListener('change', updateCities);
});
