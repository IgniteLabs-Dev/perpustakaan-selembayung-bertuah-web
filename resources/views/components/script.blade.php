<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@livewireScripts

<script>
    $(document).ready(function() {
        $(".carousel-1").owlCarousel({
            loop: false,
            margin: 20,
            nav: false,
            items: false,
            responsive: {
                0: {
                    autoWidth: true,
                    startPosition: 3,
                    center: true,
                },
                800: {
                    autoWidth: true,
                    startPosition: 1,
                    center: false,
                },
                900: {
                    startPosition: 0,
                    autoWidth: false,
                    center: false,
                },
                // 1000: {
                //     autoWidth: false,
                // },
            },


        });

        $(".carousel-2").owlCarousel({
            loop: false,
            margin: 10,
            nav: false,
            items: false,
            autoWidth: true,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".owl-stage-outer").addClass("justify-center");
        $(".owl-stage").addClass("flex items-end !important w-full justify-center ");
    });
</script>
