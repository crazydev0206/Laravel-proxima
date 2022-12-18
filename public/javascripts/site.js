// This is where it all goes :)
/**
 * @method
 * @name updateAndModifyPlaceDropdown
 * @summary Handle highlight, Enter and Tab key auto select with lat and lng to hidden fields
 * @description Common function use to highlight first autocomplete item if nothing highlighted,
 * This set value to input field when enter or tab key pressed
 * @param elementId
 * @param objectData
 * @example (idObjectKeys).forEach((function(key){
 *   updateAndModifyPlaceDropdown(key, idObjects(key))
 * }))
 * @return void
 */
function updateAndModifyPlaceDropdown(elementId, objectData){
  var homeFromFieldAutoComplete = objectData["autoComplete"];
  var latElement = $(objectData["latElement"]);
  var lngElement = $(objectData["lngElement"]);
  var mapElement = $(objectData["mapElement"]);
  var homeFromPackContainer;
  var id = "#"+elementId;
  $(id).focusin(function(){
    /*
     * Find Enter or Tab key, enter => 13, tab = 9
     **/
    try{
      homeFromPackContainer = homeFromFieldAutoComplete["gm_accessors_"]["place"];
      try{
        var gmKeys = Object.keys(homeFromPackContainer);
        var keyWithGMAccessors;
        if(Array.isArray(gmKeys) && gmKeys.length){
          gmKeys.forEach(function(key){
            if(homeFromPackContainer.hasOwnProperty(key)){
              if(homeFromPackContainer[key].hasOwnProperty("gm_accessors_")){
                keyWithGMAccessors = key;
                return false
              }
            }
          })
        }
        if(keyWithGMAccessors){
          homeFromPackContainer = homeFromPackContainer[keyWithGMAccessors]["gm_accessors_"]["input"][keyWithGMAccessors]["H"];
        }
      }catch (e) {
        console.log(e)
      }
      // $(homeFromPackContainer).find(".pac-item").eq(0).addClass("pac-item-selected");

    }catch (e) {
      console.log("Error", e)
    }

  });


  /**
   * Home from field keydown, this will check
   */
  $(id).on("keydown",function(e){
    if([13, 9].includes(e.which)){ // Handle enter and tab
      // Manipulate Google autocomplete
      var placeValue=[], placeValueString="";
      var selectedItem;
      selectedItem = $(homeFromPackContainer).find(".pac-item").eq(0);
      selectedItem.children().each(function(index,item){
        if($(item).text()){
          placeValue.push($(item).text())
        }
      });
      var highlightedPlace = $(homeFromPackContainer).find(".pac-item.pac-item-selected")
      if(highlightedPlace.length){
        placeValue = [];
        highlightedPlace.children().each(function(index,item){
          if($(item).text()){
            placeValue.push($(item).text())
          }
        });
        selectedItem = highlightedPlace;
      }
      setTimeout(function(){
        placeValueString = placeValue.join(",")
        // Set value to the input field
        console.log(id)
        console.log(elementId)
        $(id).val(placeValueString);
        selectedItem.click();
        // Search current value and set longitude and lattitude
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({address: placeValueString}, function(results, status){
          if(status === google.maps.GeocoderStatus.OK){
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();
            // $("#home-from-lat").val(lat);
            // $("#home-from-lng").val(lng);
            $(latElement).val(lat);
            $(lngElement).val(lng);
            if(mapElement && mapElement.length){
              /* Set current value to autocomplete then trigger place_changed event */
              homeFromFieldAutoComplete.set('place', results[0]);
              google.maps.event.trigger(homeFromFieldAutoComplete, 'place_changed')
            }
          }
        })
      })
    }else{ // During search highlight first element
    }
  });

  $(id).on("keyup", function(e){
    var keyPressed = e.which;
    console.log(keyPressed);
    if(!([13,9].includes(keyPressed))){ // Not enter and tab keys
      // $(homeFromPackContainer).find(".pac-item").eq(0).addClass("pac-item-selected");
      if([40,38].includes(keyPressed)){ // Keyboard UP/DOWN keys
        // Check if there multiple .pac-item-selected, if yes then remove first one
        var pacItemSelected = $(homeFromPackContainer).find(".pac-item.pac-item-selected").length;
        if(pacItemSelected > 1){
          // $(homeFromPackContainer).find(".pac-item").eq(0).removeClass("pac-item-selected");
        }
      }
    }
  });
}


$(document).ready(function(){

  if(typeof $.fn.tooltip !== "undefined"){
    $("[data-toggle='tooltip']").tooltip();
  }


  var datepickerIDElement = $("#datepicker");
  if(datepickerIDElement.length){
    var datePickerEle = $("#datepicker")
    var datePickerFormat = datePickerEle.data("format");
    var datePicker = $('#datepicker').datepicker({
      uiLibrary: 'bootstrap4',
      // format: 'dd-mm-yyyy',
      keyboardNavigation: true,
      closeDuration: 0,
      format: ( datePickerFormat || "dd-mm-yyyy"),
      disableDates: function(date){
        // Check current date and give date, if it older than current, then disable it
        var todayDate = new Date();
        todayDate.setHours(0,0,0,0)
        var currentDate = new Date(date)
        return todayDate.getTime() <= currentDate.getTime();
      }
    });
    var datePickerObject = datePicker;




    var dataPickerElement = datePicker[0];
    var guid = dataPickerElement.dataset["guid"];
    var calendar = $('[guid="'+guid+'"]');

    calendar.on("swipeleft", function(){
      // console.log("With new function...")
      // console.log("Swipe left....")
    });

    $(document).on("swipeleft", function(e){
      if(calendar.is(":visible")){
        var navigatorElementL = calendar.find(".data-navigator");
        var isItAchildL = false;
        isItAchildL = navigatorElementL.find(e.target).length;
        if(!isItAchildL){
          isItAchildL = navigatorElementL.find(e.target.localName).length;
        }
        if(isItAchildL){
          datePicker.renderNextMonth();
        }
      }
    });

    $(document).on("swiperight", function(e){
      console.debug("Document swipe right")
      if(calendar.is(":visible")) {
        var navigatorElementR = calendar.find(".data-navigator");
        var isItAchildR = false;
        isItAchildR = navigatorElementR.find(e.target).length;
        if(!isItAchildR){
          isItAchildR = navigatorElementR.find(e.target.localName).length;
        }
        if(isItAchildR){
          datePicker.renderPrevMonth();
        }
      }
    });

    datePicker.on("open", function(){
    });
    datePicker.on("close", function(){
    });

    if(datePickerObject && datePickerObject[0]){
      try{
        var currentDateValue = datePickerObject[0].value;
        if(!currentDateValue){
          $(document).find("#close-landing-search-date").hide();
        }
      }catch (e) {

      }
      datePickerObject.on("select", function(e, type){
        $(document).find("#close-landing-search-date").show();
      })
    }
    $(document).find("#close-landing-search-date").on("click",function(e){
      try{
        e.preventDefault();
        if(datePickerObject && typeof datePickerObject.value === "function"){
          datePickerObject.value("");
        }else{
          var currentDatePicker = datePickerObject[0];
          currentDatePicker.value = "";
        }
        $(e.currentTarget).hide();
      }catch (e) {
        console.debug("Error is", e)
      }
      e.stopPropagation();
    });
  }
})