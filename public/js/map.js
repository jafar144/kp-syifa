function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    mapTypeControl: false,
    center: { lat: -2.976343493555306, lng: 104.77099013136277 },
    zoom: 19,
  });

  new AutocompleteDirectionsHandler(map);
  
}

class AutocompleteDirectionsHandler {
  map;
  originPlaceId;
  destinationPlaceId;
  travelMode;
  directionsService;
  directionsRenderer;
  constructor(map) {
    this.map = map;
    this.originPlaceId = "";
    this.destinationPlaceId = "ChIJvY8ryBR2Oy4Re23JEDPldI0"; // place_id klinik alsyifa
    this.distance = "";
    this.travelMode = google.maps.TravelMode.DRIVING;
    this.directionsService = new google.maps.DirectionsService();
    this.directionsRenderer = new google.maps.DirectionsRenderer();
    this.directionsRenderer.setMap(map);

    const jarak = document.getElementById("jarak");
    const originInput = document.getElementById("origin-input");
    // const destinationInput = document.getElementById("destination-input");
    // const modeSelector = document.getElementById("mode-selector");
    // Specify just the place data fields that you need.
    const originAutocomplete = new google.maps.places.Autocomplete(
      originInput,
      { 
        fields: ["place_id"],
        componentRestrictions: { country: "id" },
      }
    );
    // Specify just the place data fields that you need.
    // const destinationAutocomplete = new google.maps.places.Autocomplete(
    //   destinationInput,
    //   { 
    //     fields: ["place_id"],
    //     componentRestrictions: { country: "id" },
    //   }
    // );

    // this.setupClickListener(
    //   "changemode-walking",
    //   google.maps.TravelMode.WALKING
    // );
    // this.setupClickListener(
    //   "changemode-transit",
    //   google.maps.TravelMode.TRANSIT
    // );
    // this.setupClickListener(
    //   "changemode-driving",
    //   google.maps.TravelMode.DRIVING
    // );

    this.setupPlaceChangedListener(originAutocomplete, "ORIG");
    // this.setupPlaceChangedListener(destinationAutocomplete, "DEST");
    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
    // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
    //   destinationInput
    // );
    // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
  }

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  // setupClickListener(id, mode) {
  //   const radioButton = document.getElementById(id);

  //   radioButton.addEventListener("click", () => {
  //     this.travelMode = mode;
  //     this.route();
  //   });
  // }

  setupPlaceChangedListener(autocomplete, mode) {
    autocomplete.bindTo("bounds", this.map);
    autocomplete.addListener("place_changed", () => {
      const place = autocomplete.getPlace();

      if (!place.place_id) {
        window.alert("Please select an option from the dropdown list.");
        return;
      }

      if (mode === "ORIG") {
        this.originPlaceId = place.place_id;
      } else {
        this.destinationPlaceId = place.place_id;
      }

      this.route();
    });
  }

  route() {
    if (!this.originPlaceId || !this.destinationPlaceId) {
      return;
    }

    const me = this;

    this.directionsService.route(
      {
        origin: { placeId: this.originPlaceId },
        destination: { placeId: this.destinationPlaceId },
        travelMode: this.travelMode,
      },
      (response, status) => {
        if (status === "OK") {
          // Untuk menunjukan jalur nya
          // me.directionsRenderer.setDirections(response);
          this.distance = response.routes[0].legs[0].distance.value;
          jarak.innerHTML += this.distance + "meter";
        } else {
          window.alert("Directions request failed due to " + status);
        }
      }
    );
  }
}

window.initMap = initMap;