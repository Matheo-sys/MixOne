/**
 * Simulation (Mock) de l'API Google Maps
 * Évite les erreurs fatales lorsque d'autres scripts (comme main.js) attendent la présence de Google Maps.
 */
(function() {
    'use strict';
    if (typeof window.google === 'undefined') {
        window.google = { 
            maps: { 
                OverlayView: class {}, 
                Map: class {}, 
                Marker: class {}, 
                InfoWindow: class {},
                LatLng: class {},
                event: { 
                    addDomListener: () => {}, 
                    trigger: () => {}, 
                    addListener: () => {} 
                }
            } 
        };
    }
})();
