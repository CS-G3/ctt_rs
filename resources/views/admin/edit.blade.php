@include('sidebar') <!-- Include the sidebar partial -->

<h2>User</h2>
<form method="POST" action="{{ route('update.user') }}">
    @csrf
    <!-- @method('PUT') -->

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
    </div>

@if(auth()->user()->id === $user->id)   
    <form method="POST" action="{{ route('update.password') }}" id="password-reset-form" onsubmit="clearFormFields()">
        @csrf

        <input type="text" placeholder="email" name='email' value="{{ $user->email }}" hidden>

        <label>Password</label>
        <input type="text" placeholder="password" name='Password' required>

        <label>Confirm Password</label>
        <input type="text" placeholder="Confirm Password" name='new_password' required>

        <button type="submit">Update</button>
    </form>

    <button type="submit">Update Profile</button>
@else
@endif

    <script>
        function clearFormFields() {
           setTimeout(() => {
            document.getElementById("password-reset-form").reset();
           }, 3000);
        }
    </script>
</form>
