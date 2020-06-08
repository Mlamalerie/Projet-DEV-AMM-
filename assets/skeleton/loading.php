<!-- Loading Spinner Wrapper-->
<div class="loader text-center">
    <div class="loader-inner">

        <!-- Animated Spinner -->
        <div class="lds-roller mb-3">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- Spinner Description Text [For Demo Purpose]-->
        <h4 class="text-uppercase font-weight-bold">Loading</h4>
        <p class="font-italic text-muted">This loading window will be removed after <strong class="countdown text-dark font-weight-bold">3 </strong> Seconds</p>
    </div>
</div>

<script>
    $(document).ready(function(){
        // HIDE LOADING SPINNER WHEN PAGE IS LOADED [3000msec after the page is loaded]
        $(window).on('load', function () {
            setTimeout(function () {
                $('.loader').hide(300);
            }, 3000);
        });



        // FOR DEMO PURPOSE
        $(window).on('load', function () {
            var loadingCounter = setInterval(function () {
                var count = parseInt($('.countdown').html());
                if (count !== 0) {
                    $('.countdown').html(count - 1);
                } else {
                    clearInterval();
                }
            }, 1000);
        });
        $('#reload').on('click', function (e) {
            e.preventDefault();
            location.reload();
        });
    });
</script>