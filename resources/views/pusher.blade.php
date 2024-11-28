<!-- Include Pusher JS library -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<!-- Include Laravel Echo library -->
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>

<!-- Include Axios library -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Include CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Initialize Echo -->
<script>
    Pusher.logToConsole = true;

    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true,
        forceTLS: true,
        authEndpoint: '/broadcasting/auth', // Default Laravel Broadcasting authentication endpoint
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    });

    window.Echo = new Echo({
        broadcaster: 'pusher',
        client: pusher,
        encrypted: true
    });

    window.Echo.private('App.Models.User.' + '{{ auth()->id() }}')
        .listen('.activity-deadline', (data) => { // Note the dot before the event name
            console.log('Received activity-deadline event:', data);
            if (data.message) {
                alert(data.message); // Display the notification message
            }
        })
        .error((error) => {
            console.error('Subscription error:', error);
        });
</script>
