{{-- 
<!DOCTYPE html>
  <head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
  
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
  
      var pusher = new Pusher('03ea741e62a6857215b7', {
        cluster: 'ap2'
      });
  
      var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
      });
    </script>
  </head>
  <body>
    <h1>Pusher Test</h1>
    <p>
      Try publishing an event to channel <code>my-channel</code>
      with event name <code>my-event</code>.
    </p>
  </body>

</html> --}}
<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.2/echo.iife.js"></script>
</head>
<body>
    <!-- Your Blade content -->

    <script type="text/javascript">
        Pusher.logToConsole = true;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true
        });

        window.Echo.private('App.User.{{ Auth::id() }}')
            .notification((notification) => {
                console.log(notification.message);
                alert(notification.message);
                // You can also dynamically update the DOM to show the notification
            });
    </script>
</body>
</html>
