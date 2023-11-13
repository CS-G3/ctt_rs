<div class="bg-light ml-1 p-4 w-100" style="  height: 100vh;
    overflow: auto;
    border: 1px solid #ccc;">

    @if(auth()->user()->id === $user->id)
        <h2>Setting</h2>
    @else
        <a href="/admin/dashboard">Back</a>
        <hr>
        <h2>Edit User</h2>
    @endif

<hr>

<h6>Username & Email</h6>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

<form method="POST" action="{{ route('user.updateNameEmailPassword') }}" class="pl-5">
    @csrf
    <input type="text" id="id" name="id" value="{{ $user->id }}" required hidden>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        <br>

        @if(auth()->user()->id !== $user->id)   
        <button type="submit">Update</button>
        </form>
        @endif

<hr>

@if(auth()->user()->id === $user->id)   

<h6>Password</h6>

        <label>Current Password</label>
        <input type="password" placeholder="Current Password" name='current_password'>  
        
        <label>New Password</label>
        <input type="password" placeholder="Password" name='confirm_password'>

        <label>Confirm Password</label>
        <input type="password" placeholder="Confirm Password" name='new_password'>

        <br>
        <button type="submit">Update</button>
    </form>
</div>

@else

@endif
    
