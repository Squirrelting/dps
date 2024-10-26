function getProvinces(sessionProvince, sessionCity, sessionBarangay) {
  $.ajax({
    url: "https://psgc.gitlab.io/api/provinces.json",
    type: "GET",
    success: function (response) {
      // Check if response is an array or has a 'provinces' property
      const provinces = Array.isArray(response) ? response : response.provinces;
      if (!provinces) {
        console.error("Provinces data not found in the response.");
        return;
      }

      let options = "<option value='' selected>Please select province</option>";
      const existingProvince = provinces.find(
        (province) => province.name === sessionProvince
      );

      for (let province of provinces) {
        // Set selected attribute if the current province matches sessionProvince
        const isSelected = sessionProvince === province.name ? "selected" : "";
        options += `<option value="${province.name}" data-id="${province.code}" ${isSelected}>${province.name}</option>`;
      }

      $("#provincesData").html(options);
      if (sessionCity) {
        getCitiesMunicipalities(sessionCity, sessionBarangay);
      } else {
        getCitiesMunicipalities(null);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching provinces:", error);
    },
  });
}

function getCitiesMunicipalities(sessionCity, sessionBarangay) {
  let code = $("#provincesData option:selected").data("id");
  $.ajax({
    url: `https://psgc.gitlab.io/api/provinces/${code}/cities-municipalities.json`,
    type: "GET",
    success: function (response) {
      // Check if response is an array or has a 'provinces' property
      let citiesMunicipalities = Array.isArray(response)
        ? response
        : response.citiesMunicipalities;
      if (!citiesMunicipalities) {
        console.error("Cities/Municipalities data not found in the response.");
        return;
      }

      let options =
        "<option value='' selected>Please select City/Municipality</option>";

      const existingCity = citiesMunicipalities.find(
        (city) => city.name === sessionCity
      );
      for (let cityMunicipality of citiesMunicipalities) {
        const isSelected =
          sessionCity === cityMunicipality.name ? "selected" : "";
        options += `<option value="${cityMunicipality.name}" data-id="${cityMunicipality.code}" ${isSelected}>${cityMunicipality.name}</option>`;
      }

      $("#citiesData").html(options);
      if (sessionBarangay) {
        getBarangays(sessionBarangay);
      } else {
        getBarangays(null);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching cities:", error);
    },
  });
}

function getBarangays(sessionBarangay) {
  let code = $("#citiesData option:selected").data("id");
  $.ajax({
    url: `https://psgc.gitlab.io/api/cities-municipalities/${code}/barangays.json`,
    type: "GET",
    success: function (response) {
      // Check if response is an array or has a 'provinces' property
      let barangays = Array.isArray(response) ? response : response.barangays;
      if (!barangays) {
        console.error("Barangays data not found in the response.");
        return;
      }

      let options = "<option value='' selected>Please select barangay</option>";

      const existingBarangay = barangays.find(
        (barangay) => barangay.name === sessionBarangay
      );
      for (let barangay of barangays) {
        const isSelected = sessionBarangay === barangay.name ? "selected" : "";
        options += `<option value="${barangay.name}" data-id="${barangay.code}" ${isSelected}>${barangay.name}</option>`;
      }

      $("#barangaysData").html(options);
    },
    error: function (xhr, status, error) {
      console.error("Error fetching barangays:", error);
    },
  });
}
