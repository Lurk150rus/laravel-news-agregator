<h1>Register</h1>

<form method="POST" action="/register">
    @csrf

    <input name="login" placeholder="login">
    <input name="password" type="password" placeholder="password">

    <button type="submit">Register</button>
</form>

<a href="/login">Login</a>