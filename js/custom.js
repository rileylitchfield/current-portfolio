(function ($) {

    "use strict";

    $(document).ready(function () {

        // PRELOADER
        $("body").toggleClass("loaded");
        setTimeout(function () {
            $("body").addClass("loaded");
        }, 3000);

        // PORTFOLIO DIRECTION AWARE HOVER EFFECT
        var item = $("#bl-work-items>div");
        var elementsLength = item.length;
        for (var i = 0; i < elementsLength; i++) {
            $(item[i]).hoverdir();
        }

        // TEXT ROTATOR
        $("#selector").animatedHeadline({
            animationType: "clip"
        });

        // BOX LAYOUT
        Boxlayout.init();

        // REMOVE # FROM URL
        $("a[href='#']").on("click", (function (e) {
            e.preventDefault();
        }));

        // AJAX CONTACT FORM
        $(".contactform").on("submit", function (e) {
            e.preventDefault(); // Prevent default form submission
            
            var form = $(this);
            var submitBtn = form.find('button[type="submit"]');
            var originalBtnHTML = submitBtn.html(); // Store original HTML (text + icon)
            var formData = form.serialize();
            var action = form.attr('action');
            
            // Change button to loading state
            submitBtn.html("Sending... <i class='fa fa-spinner fa-spin'></i>");
            submitBtn.prop('disabled', true);
            submitBtn.removeClass('btn-success btn-error'); // Clear previous status classes
            
            $.ajax({
                url: action,
                method: "POST",
                data: formData,
                dataType: "json",
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    // Show success state on button
                    submitBtn.html("<i class='fa fa-check'></i> MESSAGE SENT SUCCESSFULLY!");
                    submitBtn.addClass('btn-success');
                    form[0].reset(); // Reset the form fields
                    M.updateTextFields(); // Update Materialize text fields
                    M.textareaAutoResize($('#comment')); // Resize textarea
                    
                    // Revert button to original state after a delay
                    setTimeout(function() {
                        submitBtn.html(originalBtnHTML);
                        submitBtn.prop('disabled', false);
                        submitBtn.removeClass('btn-success');
                    }, 4000); // Revert after 4 seconds
                },
                error: function(err) {
                    // Show error state on button
                    submitBtn.html("<i class='fa fa-times'></i> ERROR SENDING MESSAGE");
                    submitBtn.addClass('btn-error');
                    
                    // Revert button to original state after a delay
                    setTimeout(function() {
                        submitBtn.html(originalBtnHTML);
                        submitBtn.prop('disabled', false);
                        submitBtn.removeClass('btn-error');
                    }, 4000); // Revert after 4 seconds
                }
            });
        });

        // MATERIAL CAROUSEL
        $(".carousel.carousel-slider").carousel({
            fullWidth: true,
            indicators: true,
        });

        // RESUME CARDS ANIMATION
        if ($(window).width() > 800) {
            $(".resume-list-item, .resume-card").on("click", function () {
                $(".resume-list-item").removeClass("is-active");
                var e = parseInt($(this).data("index"), 10);
                $("#resume-list-item-" + e).addClass("is-active");
                var t = e + 1,
                    n = e - 1,
                    i = e - 2;
                $(".resume-card").removeClass("front back up-front up-up-front back-back"), $(".resume-card-" + e).addClass("front"), $(".resume-card-" + t).addClass("back"), $(".resume-card-" + n).addClass("back-back"), $(".resume-card-" + i).addClass("back")
            });
        }

    });

})(jQuery);