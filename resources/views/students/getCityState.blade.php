<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Geolocation Example</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.send').on('click', function() {
        $.getJSON('https://ipapi.co/' + $('.ip').val() + '/json', function(data) {
          $('.city').text(data.city);
          $('.country').text(data.country);
        });
      });
    });
  </script>
</head>
<body>

<input class="ip" value="8.8.8.8">
<!-- <input class="ip" value="{{$ip}}"> -->

<button class="send">Go</button>
<br><br>
<span class="city"></span>, 
<span class="country"></span>

</body>
</html>
