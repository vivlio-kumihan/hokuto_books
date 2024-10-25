<?php /* Template Name: access */ ?>

<?php get_header(); ?>

<div class="main">
  <div class="conBox" id="Access">
    <h3>アクセスマップ</h3>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      google.maps.event.addDomListener(window, 'load', function() {
        var mapdiv = document.getElementById('map_canvas');
        var myOptions = {
          zoom: 15,
          center: new google.maps.LatLng(35.044094, 135.777145),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scaleControl: true
        };
        var map = new google.maps.Map(mapdiv, myOptions);
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(35.044094, 135.777145),
          map: map,
          title: '北斗書房'
        });
        var infowindow = new google.maps.InfoWindow({
          content: '<div class="mapMarker"><h4>北斗書房（北斗プリント社内）</h4><p>〒606-0864　京都府京都市左京区下鴨高木町38-2<br />TEL 075-791-6125 / FAX 075-791-7290</p></div>',
          size: new google.maps.Size(320, 100)
        });
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });
      });
    </script>
    <div id="map_canvas"></div>
    <h4>交通アクセス</h4>
    <table>
      <tbody>
        <tr>
          <th>JR・近鉄　京都駅から</th>
          <th>阪急　四条烏丸駅から</th>
        </tr>
        <tr>
          <td>
            <h5>地下鉄烏丸線経由</h5>
            <ul>
              <li><strong>北大路駅で下車される場合</strong><br />
                （地下鉄烏丸線）国際会議場行き → 約14分 → 北大路駅駅下車 → （市バス）北大路バスターミナル「赤のりば」204・206・北８系統 → 約10分 → 「下鴨高木町」バス停下車 </li>
              <li><strong>松ヶ崎駅で下車される場合</strong><br />
                （地下鉄烏丸線）国際会議場行き → 約14分 → 松ヶ崎駅下車 → 南へ徒歩10分 → 高木町交差点を左（東）へ徒歩30秒<br />
                → 左（北）側</li>
            </ul>
          </td>
          <td>
            <h5>地下鉄烏丸線経由</h5>
            <ul>
              <li><strong>北大路駅で下車される場合</strong><br />
                （地下鉄烏丸線）国際会議場行き → 約11分 → 北大路駅駅下車 → （市バス）北大路バスターミナル「赤のりば」204・206・北８系統 → 約10分 → 「下鴨高木町」バス停下車 </li>
              <li><strong>松ヶ崎駅で下車される場合</strong><br />
                （地下鉄烏丸線）国際会議場行き → 約11分 → 松ヶ崎駅下車 → 南へ徒歩10分 → 高木町交差点を左（東）へ徒歩30秒<br />
                → 左（北）側</li>
            </ul>
            <p>&nbsp;</p>
          </td>
        </tr>
        <tr>
          <th><strong>京阪　出町柳駅から</strong></th>
          <th>地下鉄　北大路駅・松ヶ崎駅から</th>
        </tr>
        <tr>
          <td>
            <ul>
              <li><strong>京阪　出町柳駅前バス停より</strong><br />
                （京都バス）32・34・35・37 → 約５～７分 → 高野橋東詰下車 → 西へ徒歩３分北</li>
            </ul>
            <p>※市バスは下鴨本通りを北行するため不適です。</p>
          </td>
          <td>
            <ul>
              <li><strong>地下鉄　北大路駅からお越しの場合</strong><br />
                （市バス）北大路バスターミナル「赤のりば」204・206・北８系統 → 約10分 → 「下鴨高木町」バス停下車 </li>
              <li><strong>地下鉄　松ヶ崎駅からお越しの場合</strong><br />
                南へ徒歩10分 → 高木町交差点を左（東）へ徒歩30秒 → 左（北）側</li>
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
    <h4>広域・詳細マップ</h4>
    <ul class="map">
      <li>
        <h5>広域マップ</h5>
        <p><a href="http://localhost:8888/hokuto-bs/wp-content/uploads/2012/07/map-l.png"><img src="http://localhost:8888/hokuto-bs/wp-content/uploads/2012/07/map-l-320x478.png" alt="広域マップ" title="広域マップ" class="alignnone size-medium wp-image-263" /></a></p>
      </li>
      <li>
        <h5>詳細マップ</h5>
        <p><a href="http://localhost:8888/hokuto-bs/wp-content/uploads/2012/07/map-zoom.png"><img src="http://localhost:8888/hokuto-bs/wp-content/uploads/2012/07/map-zoom-320x323.png" alt="詳細マップ" title="詳細マップ" class="alignnone size-medium wp-image-264" /></a></p>
        <p>地図クリックで拡大表示されます。</p>
        <p class="mapPrint"><a onclick="javascript:window.open('/print/map.html','map','width=700,height=800,scrollbars=yes');return false;" href="/print/map.html">地図の印刷はこちら</a></p>
      </li>
    </ul>
  </div>
</div>

<?php get_footer(); ?>