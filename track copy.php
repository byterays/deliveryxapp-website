<?php include "layout/header.php" ?>
<?php
    $tracking_id = (($_GET['tid'] ?? '') === '.php') ? '' : ($_GET['tid'] ?? '');
?>


<!-- subheader begin -->
<section id="subheader" class="page-track no-bottom" data-stellar-background-ratio="0.5">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Track
                        <span>Your Package Info</span>
                    </h1>
                    <div class="small-border wow flipInY" data-wow-delay=".8s" data-wow-duration=".8s"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subheader close -->

<div class="clearfix"></div>

<!-- content begin -->
<div id="content" class="no-padding">
    <!-- section begin -->
    <section id="section-tracking">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="cta-form wow fadeIn" data-wow-delay="0s" data-wow-duration="1s">
                        <form id="trackForm" method="post" action="track">
                            <input type="text" name="tid" id="tidInput" value="<?=$tracking_id ?>"
                                placeholder="Insert tracking number here...">
                            <input type="submit" id="track-it" value="TRACK MY ORDER">
                        </form>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>


    </section>
    <!-- section close -->

    <!-- tracking results -->
    <section id="section-tracking-result" class="tracking-result"></section>
    <!-- end tracking section -->


    <?php include "ui-blocks/understand-tracking.php" ?>
    <?php include "ui-blocks/our-services.php" ?>
</div>
<!-- content close -->

<?php include "layout/footer.php" ?>

<script type="text/javascript">
$(function () {

    // Function to fetch tracking HTML
    function fetchTracking(trackingId) {
        if (!trackingId) return;

        $.ajax({
            url: "api/track-order.php",
            type: "POST",
            data: { tid: trackingId },
            success: function (response) {
                console.log(response); // Verify the response

                // Inject HTML into container
                var $result = jQuery('#section-tracking-result');
                $result.html(response.data);
                                
                // Scroll to the result
                 $result.slideDown();
                $('html, body').animate({
                    scrollTop: $("#section-tracking").offset().top
                }, 500);
            },
            error: function (xhr, status, error) {
                console.log("Error fetching tracking results:", error);
            }
        });
    }

    // Form submit handler
    $("#trackForm").on("submit", function (e) {
        e.preventDefault();

        var trackingId = $.trim($("#tidInput").val());
        if (!trackingId) {
            alert("Please enter a tracking number.");
            return false;
        }

        // Update URL without reload
        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?tid=" + encodeURIComponent(trackingId);
        history.pushState({ path: newUrl }, "", newUrl);

        fetchTracking(trackingId);
        return false;
    });

    // Auto-trigger AJAX on page load if PHP variable has value
    var initialTrackingId = "<?= $tracking_id ?>";
    if ($.trim(initialTrackingId)) {
        fetchTracking(initialTrackingId);
    }

});
</script>