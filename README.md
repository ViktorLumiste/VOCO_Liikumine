ADD ```action="register.php" method="post"``` TO REGISTER FORMS <br>
AND <br>
ADD ```action="login.php" method="post"``` TO LOG IN FORMS IN HTML<br><br><br>
EXAMPLE<br>
```
<!-- Login Form -->
    <form id="loginForm" action="login.php" method="post">
        <h2>Login</h2>
        <label for="loginName">Username:</label>
        <input type="text" id="loginName" name="loginName" required>

        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="loginPassword" required>

        <button type="submit">Login</button>
    </form>
```
```
    <!-- Register Form -->
    <form id="registerForm" action="register.php" method="post">
        <h2>Register</h2>
        <label for="regName">Username:</label>
        <input type="text" id="regName" name="regName" required>

        <label for="regEmail">Email:</label>
        <input type="email" id="regEmail" name="regEmail" required>

        <label for="regPassword">Password:</label>
        <input type="password" id="regPassword" name="regPassword" required>
        
        <label for="regPhone">Phone:</label>
        <input type="phone" id="regPhone" name="regPhone" required>
        
        <label for="regRole">Coach/Student</label>
        <input type="select" id="regRole" name="regRole">

        <button type="submit">Register</button>
    </form>
```
