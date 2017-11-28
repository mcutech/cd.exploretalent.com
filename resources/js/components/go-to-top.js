module.exports = function () {
  // ===== Scroll to Top ====
  $(window).scroll(function () {
    if ($(this).scrollTop() >= 500) {       // If page is scrolled more than 50px
      $('#go-to-top-btn').fadeIn(200)    // Fade in the arrow
    } else {
      $('#go-to-top-btn').fadeOut(200)   // Else fade out the arrow
    }
  })
  $('#go-to-top-btn').click(function () {      // When arrow is clicked
    $('body,html').animate({
      scrollTop: 0                       // Scroll to top of body
    }, 500)
  })
}
