<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@livewireScripts

<script>
    $(document).ready(function(){
        $(".carousel-1").owlCarousel({
            loop: false,
            margin: 20,
            nav: false,
            items: false,
            autoWidth: true, 
            startPosition: 2,
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