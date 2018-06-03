
    <div class="footer">
      <div class="footer__container">
        <div class="footer__item">
          <div class="footer__logo">
            <img src=<?php echo base_url('public/img/bean-logo-footer.png') ?> />
          </div>
          <p class="footer__info">
            Coffee Beans House Online<br />
            宜蘭縣頭城鎮龜山島龜尾巴<br />
            03-961-xxxx
          </p>
        </div>
        <div class="footer__item">
          <a href="#"><i class="fab fa-fw fa-facebook-square"></i><span class="sns-title">facebook</span></a>
          <a href="#"><i class="fab fa-fw fa-instagram"></i><span class="sns-title">instagram</span></a>
          <a href="#"><i class="fab fa-fw fa-google-plus-square"></i><span class="sns-title">Google+</span></a>
          <a href="#"><i class="fab fa-fw fa-twitter-square"></i><span class="sns-title">Twitter</span></a>
          <a href="#"><i class="fab fa-fw fa-youtube"></i><span class="sns-title">Youtube</span></a>
        </div>
        <div class="footer__item">
          我們的位置：
          <div id="mymap"></div>
        </div>
      </div>
    </div>
    <!-- Google Map JavaScript API -->
    <script>
      function initMap() {
        var turtleTail = { lat: 24.845869, lng: 121.934710 };
        var mymap = new google.maps.Map(document.getElementById('mymap'), {
          zoom: 10,
          center: turtleTail
        })
        var marker = new google.maps.Marker({
          position: turtleTail,
          map: mymap
        })
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCT97_3vwndQp5Pl0BWV8hH0g7P-aK2JI&callback=initMap">
    </script>
  </body>
</html>