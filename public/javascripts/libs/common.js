function is_touch_device4() {
    var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');
    var mq = function (query) {
      return window.matchMedia(query).matches;
    }
    if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
      return true;
    }
    // include the 'heartz' as a way to have a non matching MQ to help terminate the join
    // https://git.io/vznFH
    var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
    return mq(query);
  }
  
  
  
  $(document).ready(function(){
  
  });
  
  
  
  $(document).ready(function(){
    // Ride Form
    var rideDateField = $("#ride-date-field");
    var rideTimeField = $("#ride-time-field");
  
    if(rideDateField.length){
      var rideDateFormat = rideDateField.data("format")
      const rDatePickerObject = rideDateField.datepicker({
        uiLibrary:"bootstrap4",
        keyboardNavigation: true,
        format: ( rideDateFormat || "dd-mm-yyyy"),
        disableDates: function(date){
          // Check current date and give date, if it older than current, then disable it
          var todayDate = new Date();
          todayDate.setHours(0,0,0,0)
          var currentDate = new Date(date)
          return todayDate.getTime() <= currentDate.getTime();
        }
      });
      var rDatePickerElement = rDatePickerObject[0];
      var rGuid = rDatePickerElement.dataset["guid"];
      var rCalendar = $('[guid="'+rGuid+'"]');
  
      rDatePickerObject.on("close", function(){
        // rCalendar.find(".data-navigator").off("swipeleft");
        // rCalendar.find(".data-navigator").off("swiperight");
      });
  
  
      (rCalendar).on("swipeleft", function(e){
        console.log("Swipe Left")
        rDatePickerObject.renderNextMonth()
      });
  
      (rCalendar).on("swiperight", function(e){
        rDatePickerObject.renderPrevMonth()
        console.log("Swipe Nexy")
      });
  
      // rDatePickerObject.on("open", function(){
      //   console.log("Datepicker opened");
      //   $(document).find(rCalendar).on("swipeleft",".data-navigator", function(e){
      //     console.log("Swipe left");
      //     rDatePickerObject.renderNextMonth()
      //   });
      //
      //   $(document).find(rCalendar).find(".data-navigator").on("swiperight", function(e){
      //     console.log("Swipe right");
      //     rDatePickerObject.renderPrevMonth()
      //   });
      // })
    }
  
    if(rideTimeField.length){
      rideTimeField.timepicker({
        uiLibrary: "bootstrap4"
      });
  
      rideTimeField.on("click", function(){
        $(this).parent().find("button").click();
      });
    }
  
  
  var svgLatestStar = "<svg id=\"Layer_1\" data-name=\"Layer 1\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 -6 874.3 834.2\" ><title>Star</title><path  stroke-width=\"14px\" stroke=\"#A0A0A0\"  d=\"M863,312.2c-1-.22-64.42-9.6-144-21.09l-22-3.2c-127.18-18.49-127.18-18.49-132.1-25.18-.27-.37-.52-.72-.82-1.09-1.55-2-30.89-60.58-65.41-130.58C462.5,57.61,435.59,3.32,434.67,2a3.86,3.86,0,0,0-2.92-2A2,2,0,0,0,430,.75c-.63,1-25.84,51.94-64.18,129.62C332,199.25,301.59,260.05,300.59,261.54c-3.73,4.8-10,8.19-17.26,9.31-3.86.63-71.15,10.58-144,21.1C60,303.4,4.14,311.95.91,312.95A3.13,3.13,0,0,0,0,314.61c3.25,3.94,48.28,48.49,103.6,102.47C181.43,492.85,208.23,519.57,209.83,523A23.93,23.93,0,0,1,212,533c0,3.2-11.27,71.41-24.09,146-13.52,79-23.69,140-23.69,141.78a2.6,2.6,0,0,0,2,1.06c3.24-.31,258.51-134.2,263.8-134.61q1-.06,2.16-.06a28.77,28.77,0,0,1,7.42.81c2.1.68,254.09,132.22,259,134.22a5.17,5.17,0,0,0,1.34-1.43c-.08-3.55-7.37-48.71-23.61-142.62-14.36-83.29-21-122.92-23.12-138.71a35.71,35.71,0,0,1-.5-4,20.16,20.16,0,0,1,2.65-14c1.47-2.37,50.08-50.49,106.15-105.11,70.45-68.73,101.73-99.45,102.79-102.4A3.64,3.64,0,0,0,863,312.2Z\" /></svg>"
  var svgOldStart = "<svg version=\"1.0\" xmlns=\"http://www.w3.org/2000/svg\"\n" +
    " width=\"908.000000pt\" height=\"866.000000pt\" viewBox=\"0 0 908.000000 866.000000\" fill='grey'" +
    " preserveAspectRatio=\"xMidYMid meet\">" +
    "<g transform=\"translate(0.000000,866.000000) scale(0.100000,-0.100000)\"\n" +
    ">\n" +
    "<path d=\"M4453 8644 c-91 -33 -74 -2 -758 -1389 -352 -713 -644 -1299 -648\n" +
    "-1302 -5 -3 -653 -99 -1442 -213 -1109 -162 -1442 -213 -1472 -228 -45 -24\n" +
    "-84 -63 -109 -112 -26 -50 -26 -162 1 -215 13 -27 359 -371 1055 -1049 569\n" +
    "-555 1038 -1014 1042 -1020 3 -6 -104 -650 -238 -1431 -175 -1013 -243 -1433\n" +
    "-240 -1467 9 -86 70 -170 148 -202 21 -9 64 -16 96 -16 49 0 73 7 148 44 49\n" +
    "24 629 328 1289 675 659 347 1207 631 1217 631 10 0 593 -303 1296 -672 l1277\n" +
    "-673 81 0 c72 0 86 3 130 30 68 43 107 108 112 189 2 46 -55 400 -237 1461\n" +
    "-133 770 -241 1407 -241 1416 0 9 468 473 1040 1030 772 752 1045 1025 1060\n" +
    "1056 26 56 27 153 1 208 -26 57 -101 121 -159 134 -26 6 -681 103 -1456 216\n" +
    "-775 112 -1410 206 -1412 208 -2 2 -290 584 -640 1293 -349 709 -648 1305\n" +
    "-663 1324 -60 76 -184 109 -278 74z m122 -218 c9 -13 297 -594 641 -1292 344\n" +
    "-698 638 -1285 653 -1304 62 -79 -23 -63 1543 -291 786 -114 1435 -210 1442\n" +
    "-212 7 -3 16 -15 19 -26 4 -18 -167 -189 -1031 -1032 -571 -556 -1047 -1028\n" +
    "-1060 -1049 -13 -22 -25 -62 -28 -92 -4 -40 55 -401 239 -1468 152 -879 241\n" +
    "-1421 236 -1431 -5 -9 -15 -19 -22 -22 -8 -3 -587 295 -1286 663 -700 368\n" +
    "-1288 674 -1308 681 -19 6 -61 9 -92 7 -52 -4 -152 -54 -1336 -676 -901 -474\n" +
    "-1286 -672 -1304 -670 -15 2 -27 10 -29 20 -2 9 105 648 237 1420 133 772 241\n" +
    "1428 241 1458 0 34 -8 69 -21 96 -15 32 -299 315 -1060 1056 -571 557 -1039\n" +
    "1020 -1039 1029 0 9 6 22 14 28 8 7 632 102 1388 211 755 110 1403 205 1440\n" +
    "211 71 11 131 44 166 89 10 14 304 603 652 1310 349 707 638 1291 643 1298 15\n" +
    "19 45 14 62 -12z\"/>\n" +
    "</g>\n" +
    "</svg>";
  
    // Confirm rateYo plugin available
    if(typeof $.fn.rateYo !== "undefined"){
      var profileRating = $(".profile-rating");
      if(profileRating.length){
        profileRating.each((function (index, item) {
          var dataRating = $(item).data("rating");
          var background = $(item).data("background");
          var starSize = $(item).data("size");
          var readOnly = $(item).data("readonly");
          console.log(dataRating)
          console.log("Rating...")
          $(item).rateYo({
            rating: dataRating,
            starWidth: starSize || "20px",
            normalFill: background,
            readOnly: readOnly,
          fullStar: true,
              starSvg: svgLatestStar,
              spacing: "3px",
            onChange: function (rating, rateYoInstance) {
                $(this).next().val(rating);
      }
          });
        }));
      }
    }
  
  
    /* Handle Video play/pause section */
    function initiateYouTubeFunctions(){
      try{
  
        var homeVideoPlayer;
        var setVideoPlayer = function(){
          console.log("Set video player loaded....")
          homeVideoPlayer = new YT.Player("home-video-wrapper",{
            width: '640',
            height: '360',
            videoId: '11Dixobrkbw',
            events:{
              'onReady': function(){
                console.log("Video ready")
                $(document).find("#home-pb-video").on("click", ".control-play-pause", function(e){
                  e.preventDefault();
                  $(this).parent().parent(".pb__video").addClass("pb__video__play");
                  if(typeof homeVideoPlayer.playVideo !== "undefined"){
                    homeVideoPlayer.playVideo();
                  }
                })
              },
              'onStateChange': function(event){
                var status = event.data;
                if(status === 2){ // Video Pause
                  $(document).find("#home-pb-video").removeClass("pb__video__play")
  
                }
              }
            }
          });
        };
        setVideoPlayer();
      }catch (e) {
  
      }
  
  
    }
  
    try{
      window.initiateYouTubeFunctions = initiateYouTubeFunctions;
    }catch (e) {
  
    }
  
  });