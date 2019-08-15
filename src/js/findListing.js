// functions for creating a slider
// sliderId is the id of the slider div, min is minimum value of slider
// max is max value of slider, step is the amount that the handle will 'step' by
// prepend is any text to show before the value, format is the number of decimals tooltip should have
// overLimitSign is if the handle value = max should show a + sign after the value to indicate
//  that it also includes values above the current value (eg. if max = 9 and handle is at 9
// then values 9 <= are included)
function createSlider (sliderId, min, max, start, stop, step, prepend, format, overLimitSign) {
    var nonLinearSlider = document.getElementById(sliderId);

    noUiSlider.create(nonLinearSlider, {
        connect: true,
        behaviour: 'tap',
        start: [start, stop],
        range: {
            'min': [min,step],
            'max': [max]
        },
        tooltips: true,
        format: {
          to: function ( value ) {
            return prepend + value.toFixed(format) + (value==max && overLimitSign? '+':'');
          },
          from: function ( value ) {
            return value.replace('.00', '');
          }
      }
    });
    return nonLinearSlider;
}

function createSingleSlider (sliderId, min, max, start, step, prepend, format, overLimitSign, connect) {
    var linearSlider = document.getElementById(sliderId);

    noUiSlider.create(linearSlider, {
        connect: connect,
        behaviour: 'tap',
        start: start,
        range: {
            'min': [min,step],
            'max': [max]
        },
        tooltips: true,
        format: {
          to: function ( value ) {
            return prepend + value.toFixed(format) + (value==max && overLimitSign? '+':'');
          },
          from: function ( value ) {
            return value.replace('.00', '');
          }
      }
    });
    return linearSlider;
}
