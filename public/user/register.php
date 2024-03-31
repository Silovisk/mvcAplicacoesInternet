<?php include 'public/header.php'; ?>

<link rel="stylesheet" href="\mvc2024\public\css\user\index.css">

<div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
    <h3>Registrar</h3>
    <div id="registrationForm">
        <div class="inputBox">
            <input id="uname" type="text" name="Username" placeholder="Username">
            <input id="pass" type="password" name="Password" placeholder="Password">
        </div>
        <input type="submit" name="" value="Register" onclick="registerUser()">
    </div>
    <a href="#">Esqueceu a senha<br></a>
    <div class="text-center">
        <p style="color: #59238F;">Já possui uma conta? <a href="login.php">Faça login</a></p>
    </div>
</div>

<script>
    function registerUser() {
        var username = document.getElementById("uname").value;
        var password = document.getElementById("pass").value;

        // Perform fetch request to register user
        fetch("store", {
            method: "POST",
            body: JSON.stringify({ username: username, password: password })
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                icon: data.status,
                title: data.message,
                showConfirmButton: true,
                timer: 15000,
            }).then(() => {
                window.location.href = "/mvc2024/user/login";
            });
        })
        .catch(error => {
            Swal.fire({
                icon: "error",
                title: "Erro ao registrar usuário",
                showConfirmButton: false,
                timer: 1500
            });
        });
    }
</script>

<?php include 'public/footer.php'; ?>