<?php include 'public/header.php'; ?>

<link rel="stylesheet" href="\mvcAplicacoesInternet\public\css\user\index.css">


<div class="loginBox"> <img class="user" src="https://i.ibb.co/yVGxFPR/2.png" height="100px" width="100px">
    <h3>Entre aqui</h3>
    <form method="post">
        <div class="inputBox">
            <input id="uname" type="text" name="Username" placeholder="Username">
            <input id="pass" type="password" name="Password" placeholder="Password">
        </div>
        <input type="submit" name="" value="Login">
    </form>
    <a href="#">Esqueceu a senha<br></a>
    <div class="text-center">
        <p style="color: #59238F;">Registrar</p>
    </div>
</div>

<script>
    // Get the form element
    var form = document.querySelector('form');

    // Add an event listener for the 'submit' event
    form.addEventListener('submit', function(event) {
        // Prevent the form from being submitted normally
        event.preventDefault();

        // Call the loginUser function
        loginUser();
    });

    function loginUser() {
        var username = document.getElementById("uname").value;
        var password = document.getElementById("pass").value;

        // Perform fetch request to login user
        fetch("authLogin", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username: username, password: password })
        })
        .then(response => {
            console.log("response:", response);
            return response.json();
        })
        .then(data => {
            console.log("🚀 ~ loginUser ~ data:", data)
            if (data.status === 'success') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Login bem-sucedido"
                }).then(() => {
                    window.location.href = "/mvcAplicacoesInternet/produtos/index";
                });
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: data.message
                });
            }
        });
        
    }
</script>
<?php include 'public/footer.php'; ?>