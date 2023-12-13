<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function(){
      if ({{ Auth::check() }}) {
        var id = "{{ Auth::user()->id }}";
        var notification_list = document.getElementById("notification-list");

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('07d6f9672ead3f4d17ff', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('channel-' + id);
        channel.bind('notify', function(data) {
          var message = data.message;
          var url = data.url;

          var notification = document.createElement('li');
          var a = document.createElement('a');
          var link = document.createTextNode(message);
          a.appendChild(link);
          a.href = url;
          notification.appendChild(a);
          notification_list.appendChild(notification);
        });
      }
      
    });
    
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <ul id="notification-list"></ul>
</body>