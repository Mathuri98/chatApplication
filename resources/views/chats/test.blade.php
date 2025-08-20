<x-layout>

    <h1>Chat Test</h1>
    <div id="messages" style="margin-top:1rem;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof window.Echo === 'undefined') {
                console.error('Echo is undefined');
                return;
            }
            // Just confirm the connection succeeds
            const pusher = window.Echo.connector.pusher;
            pusher.connection.bind('connected', () => {
                console.log('✅ Connected to Pusher');
                const m = document.getElementById('messages');
                m.insertAdjacentHTML('beforeend', '<div>✅ Connected to Pusher</div>');
            });
        });
    </script>
</x-layout>
