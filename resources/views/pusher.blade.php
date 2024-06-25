<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #notificationBell {
            position: relative;
            cursor: pointer;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        #notificationCount {
            position: absolute;
            top: 0;
            right: 0;
            background: red;
            border-radius: 50%;
            padding: 5px;
            color: white;
            font-size: 0.8em;
            line-height: 1em;
        }

        #notificationList {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <div id="notifications" style="position: relative;">
        <button id="notificationBell">
            Bell
            <span id="notificationCount">0</span>
        </button>
        <div id="notificationList">
            <!-- Notifications will be appended here -->
        </div>
    </div>

    <!-- Include Pusher and Laravel Echo directly -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pusherKey = '{{ env("PUSHER_APP_KEY") }}';
            const pusherCluster = '{{ env("PUSHER_APP_CLUSTER") }}';

            Pusher.logToConsole = true;

            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: '03ea741e62a6857215b7',
                cluster: 'ap2',
                forceTLS: true
            });

            Echo.private('App.Models.User.' + {{ Auth::id() }})
                .notification((notification) => {
                    let notificationCount = document.getElementById('notificationCount');
                    let notificationList = document.getElementById('notificationList');
                    let count = parseInt(notificationCount.innerText);
                    notificationCount.innerText = count + 1;

                    let notificationItem = document.createElement('div');
                    notificationItem.className = 'notification-item';
                    notificationItem.innerText = notification.message;
                    notificationList.appendChild(notificationItem);

                    // Show the notification list when a new notification comes in
                    notificationList.style.display = 'block';
                });

            document.getElementById('notificationBell').addEventListener('click', () => {
                let notificationList = document.getElementById('notificationList');
                notificationList.style.display = notificationList.style.display === 'none' ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>
