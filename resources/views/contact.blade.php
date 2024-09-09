<!DOCTYPE html>
<html lang="en">
<head>
    @include('inc/head')
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    @include('inc/nav')

    <main class="mt-4"> 
        <h2>Contact</h2>
 <br><br><Br>
        <!-- Form to submit opinion -->
        <form action="{{ url('/send-email') }}" method="POST">
            @csrf <!-- CSRF protection token -->

            <!-- Email input field -->
            <div class="mb-3">
                <label for="email" class="form-label">Your Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <!-- Message input field -->
            <div class="mb-3">
                <label for="message" class="form-label">Your Message:</label>
                <textarea name="message" class="form-control" rows="4" placeholder="Enter your message" required></textarea>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary">Send</button>
        </form>

        <br><br><Br>

        <p>Email: <a href="mailto:your.email@example.com">pshamugia@gmail.com</a> 
            <br>
            Facebook: <a href="https://www.facebook.com/pshamugia" target="_blank">Follow</a></p>
        <p></p>

        <!-- Success message (optional) -->
        @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif
    </main>
</div>

<!-- Add Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
