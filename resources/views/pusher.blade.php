<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="notifications" style="position: relative;">
        <button id="notificationBell" style="position: relative;">
            Bell
            <span id="notificationCount" style="position: absolute; top: 0; right: 0; background: red; border-radius: 50%; padding: 5px; color: white;">0</span>
        </button>
        <div id="notificationList" style="display: none; position: absolute; top: 30px; background: white; border: 1px solid #ccc; width: 300px;">
            <!-- Notifications will be appended here -->
        </div>
    </div>

    <!-- Include Pusher and Laravel Echo directly -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>

    <script>
        const pusherKey = '{{ env("PUSHER_APP_KEY") }}';
        const pusherCluster = '{{ env("PUSHER_APP_CLUSTER") }}';

        Pusher.logToConsole = true;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: pusherKey,
            cluster: pusherCluster,
            forceTLS: true
        });

        Echo.private('App.Models.User.' + {{ Auth::id() }})
            .notification((notification) => {
                let notificationCount = document.getElementById('notificationCount');
                let notificationList = document.getElementById('notificationList');
                let count = parseInt(notificationCount.innerText);
                notificationCount.innerText = count + 1;

                let notificationItem = document.createElement('div');
                notificationItem.innerText = notification.message;
                notificationList.appendChild(notificationItem);

                // Show the notification list when a new notification comes in
                notificationList.style.display = 'block';
            });

        document.getElementById('notificationBell').addEventListener('click', () => {
            let notificationList = document.getElementById('notificationList');
            notificationList.style.display = notificationList.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>