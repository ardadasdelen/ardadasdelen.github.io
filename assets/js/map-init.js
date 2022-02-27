 
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        var mapOptions = {
          zoom: 17,
          scrollwheel: false, 
          navigationControl: false,
          center: new google.maps.LatLng(24.906308,91.870413),
          styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},
          {"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},
          {"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},
          {"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},
          {"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},
          {"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},
          {"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},
          {"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},
          {"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},
          {"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},
          {"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},
          {"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},
          {"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
      };
      var mapElement = document.getElementById('mh-map');
      var map = new google.maps.Map(mapElement, mapOptions);
      var marker = new google.maps.Marker({
          position: new google.maps.LatLng(24.906308,91.870413),
          map: map,
          title: '24 Golden Tower (2nd floor), Amborkhana, Sylhet.!'
      });
    }




document.addEventListener('mousedown', onMouseDown);
document.addEventListener('mouseup', onMouseUp);
var temp = document.querySelector('#shareBoxTemplate');

function onMouseDown() {
  document.getSelection().removeAllRanges();
  var shareBox = document.querySelector('#shareBox');
  if (shareBox !== null)
    shareBox.remove();
}

function onMouseUp() {
  var sel = document.getSelection(),
    txt = sel.toString();
  if (txt !== "") {
    var range = sel.getRangeAt(0);
    if (range.startContainer.parentElement.parentElement.localName === "article" || range.startContainer.parentElement.localName === "article") {
      document.body.insertBefore(document.importNode(temp.content, true), temp);
      var rect = range.getBoundingClientRect();
      var shareBox = document.querySelector('#shareBox');
      shareBox.style.top = `calc(${rect.top}px - 38px)`;
      shareBox.style.left = `calc(${rect.left}px + calc(${rect.width}px / 2) - 30px)`;
      var shareBtn = shareBox.querySelector('button');
      shareBtn['shareTxt'] = txt;
      shareBtn.addEventListener('mousedown', onShareClick, true);
    }
  }
}

function onShareClick() {
  window.open(`https://twitter.com/intent/tweet?text=${this.shareTxt}`);
  this.remove();
  document.getSelection().removeAllRanges()
}