<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #ffff00;
            font-family: sans-serif;
        }

        .container {
            width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
        }

        .logo {
            width: 200px;
            height: 100px;
            background-image: url("assets/logo.png");
            background-repeat: no-repeat;
            background-position: center;
        }

        .form {
            margin-top: 20px;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .input-group label {
            width: 100px;
            text-align: right;
        }

        .input-group input {
            width: 300px;
            border: 1px solid #000000;
            padding: 10px;
            font-size: 16px;
        }

        .button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            color: #ffffff;
            background-color: #ff0000;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="header">
            <img src="assets/logo.png" class="logo" alt="Logo">
            <h1>Login</h1>
        </div>

        <form style="width: 32rem;" action="">

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" style="font-size: 16px;">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" style="font-size: 16px;">
                <input type="checkbox" onclick="myFunction()" style="margin-top: 10px"> Show Password
            </div>
            <script>
                function myFunction() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                    }
            </script>

            <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit" class="button">Login</button>
            </div> 
            @csrf
        </form>

    </div>
    <script type="module">
        $('form').submit(async function (e) {
            e.preventDefault();
            let username = $('#username').val();
            let password = $('#password').val();
    
            try {
                const response = await axios.post('/login', {
                    username,
                    password
                }).then((res) => {
                console.log(res);                
                const role = res.data.role;
    
                if (role === 'admin') {
                    swal.fire({
                        title: 'Login berhasil!',
                        text: 'Redirecting to dashboard...',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location = '/dashboard';
                    });
                } else {
                    swal.fire({
                        title: 'Login berhasil!',
                        text: 'Redirecting to beranda...',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location = '/beranda';
                    });
                }
                })
    
    
                console.log(response);
            } catch (error) {
                swal.fire('Waduh!', 'Anda tidak bisa login, pastikan username dan password terisi dengan benar!', 'warning');
                console.error(error);
            }
        });
    </script>
</body>
</html>
