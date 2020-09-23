<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script type="text/javascript">
  $(window).scroll(function(){
    if($(window).scrollTop() >= $(document).height() - $(window).height() - 50)
    {
      $('.infinite').append('<div></div>');
    }
  })


</script> -->

<script type="text/javascript">
//appends an "active" class to .popup and .popup-content when the "Open" button is clicked
$("#open").on("click", function() {
  $(".popup-overlay, .popup-content").addClass("active");
});

//removes the "active" class to .popup and .popup-content when the "Close" button is clicked
$(".close, .popup-overlay").on("click", function() {
  $(".popup-overlay, .popup-content").removeClass("active");
});
</script>

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
<script type="text/javascript">
    var elem = document.querySelector('.grid');
    var msnry = new Masonry( elem, {
    // options
    columnWidth: 100,
    itemSelector: '.grid-item',
    gutter:10,
    fitWidth: true,
    });

</script>
</body>

</html>
