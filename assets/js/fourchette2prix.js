$(function() {

    // Initiate Slider
    $('#slider-range').slider({
        range: true,
        min: 10,
        max: 300,
        step: 10,
        values: [10, 300]
    });

    // Move the range wrapper into the generated divs
    $('.ui-slider-range').append($('.range-wrapper'));

    // Apply initial values to the range container
    $('.range').html('<input id="rangeBorneInf" class="range-value" type="text" value="' + $('#slider-range').slider("values",0 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"><span class="range-divider"></span><input id="rangeBorneSup" class="range-value" type="text" value="' + $("#slider-range").slider("values", 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"> <input name="Price" type="hidden" value="'+$('#slider-range').slider("values", 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '-' + $("#slider-range").slider("values", 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"> ');

    // Show the gears on press of the handles
    $('.ui-slider-handle, .ui-slider-range').on('mousedown', function() {
        $('.gear-large').addClass('active');
        
    });
    
     $('.ui-slider-handle, .ui-slider-range').on('mouseup', function(){
         let ok = true;
         
        
         
         $("#formPrice").submit();
         
     });
   
   
    

    // Hide the gears when the mouse is released
    // Done on document just incase the user hovers off of the handle
    $(document).on('mouseup', function() {
        if ($('.gear-large').hasClass('active')) {
            $('.gear-large').removeClass('active');
        }
    });

    // Rotate the gears
    var gearOneAngle = 0,
        gearTwoAngle = 0,
        rangeWidth = $('.ui-slider-range').css('width');

    $('.gear-one').css('transform', 'rotate(' + gearOneAngle + 'deg)');
    $('.gear-two').css('transform', 'rotate(' + gearTwoAngle + 'deg)');

    $('#slider-range').slider({
        slide: function(event, ui) {

            // Update the range container values upon sliding

            $('.range').html('<input id="rangeBorneInf" class="range-value" type="text" value="'  + ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"><span class="range-divider"></span><input id="rangeBorneSup" class="range-value" type="text" value="' + ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"> <input name="Price" type="hidden" value="'+ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '-' +  ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '"> ');

            // Get old value
            var previousVal = parseInt($(this).data('value'));

            // Save new value
            $(this).data({
                'value': parseInt(ui.value)
            });

            // Figure out which handle is being used
            if (ui.values[0] == ui.value) {

                // Left handle
                if (previousVal > parseInt(ui.value)) {
                    // value decreased
                    gearOneAngle -= 7;
                    $('.gear-one').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                } else {
                    // value increased
                    gearOneAngle += 7;
                    $('.gear-one').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                }

            } else {

                // Right handle
                if (previousVal > parseInt(ui.value)) {
                    // value decreased
                    gearOneAngle -= 7;
                    $('.gear-two').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                } else {
                    // value increased
                    gearOneAngle += 7;
                    $('.gear-two').css('transform', 'rotate(' + gearOneAngle + 'deg)');
                }

            }

            if (ui.values[1] === 305) {
                if (!$('.range-alert').hasClass('active')) {
                    $('.range-alert').addClass('active');
                }
            } else {
                if ($('.range-alert').hasClass('active')) {
                    $('.range-alert').removeClass('active');
                }
            }
        }
    });

    // Prevent the range container from moving the slider
    $('.range, .range-alert').on('mousedown', function(event) {
        event.stopPropagation();
    });

});