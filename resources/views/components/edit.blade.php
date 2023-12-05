<div class="bg-light ml-1 p-4 w-100" style="  height: 100vh;
    overflow: auto;
    border: 1px solid #ccc;">

    @if(auth()->user()->id === $user->id)
        <h2 style="text-align:center;">Setting</h2>
        <hr>
    @else
        <a href="/admin/dashboard">Back</a>
        <hr>
        <h2 style="text-align:center;">Edit User</h2>
    @endif

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('success') }}
        <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
            <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
        </span>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ Session::get('error') }}
        <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
            <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
        </span>
    </div>
@endif

<form method="POST" action="{{ route('user.updateNameEmailPassword') }}" class="pl-5 mt-4" style="margin-left:25%">
    @csrf
    <input type="text" id="id" name="id" value="{{ $user->id }}" required hidden>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        <br>

        @if(auth()->user()->id !== $user->id)   
        <button type="submit">Update</button>
        @endif

@if(auth()->user()->id === $user->id)   

<h6 class="mt-5">Password</h6>

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
    
