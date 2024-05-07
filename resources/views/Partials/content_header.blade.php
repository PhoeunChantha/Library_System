<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            {{-- <h1 id="greeting">Welcome, @auth {{ Auth::user()->name }} @endauth</h1> --}}
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<script>
    // Wait for the page to load
    document.addEventListener('DOMContentLoaded', function () {
        // Check if the current page is the dashboard page
        var isDashboardPage = {!! json_encode(request()->routeIs('front.home')) !!};

        // Select the greeting element
        var greetingElement = document.getElementById('greeting');

        // Check if the user is on the dashboard page and if the greeting message has not been shown before
        if (isDashboardPage && !localStorage.getItem('isGreetingShown')) {
            // Show the greeting message
            greetingElement.style.display = 'block';

            // Mark the greeting as shown in local storage
            localStorage.setItem('isGreetingShown', true);

            // Hide the greeting after 5 seconds (5000 milliseconds)
            setTimeout(function () {
                greetingElement.style.display = 'none';
            }, 5000); // Adjust the duration as needed (in milliseconds)
        }
    });
</script>

