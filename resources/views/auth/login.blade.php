<h1>Login</h1>

<form method="POST" action="/login">
    @csrf

    <input name="login" placeholder="login">
    <input name="password" type="password" placeholder="password">

    <button type="submit">Login</button>
</form>

<a href="/register">Register</a>
