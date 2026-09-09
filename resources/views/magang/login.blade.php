<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .form-container {
            /* max-width: 600px; */
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            width: 60%;
            height: 40%;
            margin-top: 6%;


        }
        body {
           background-image: url('magang/Petrokimia.jpg');
             background-repeat: no-repeat;
             background-attachment: fixed;

            background-size: cover;
        }
.logo{
      float: right;
      margin-top: -30%;
      width: 50%;
      height: 50%;

}

    </style>
</head>
<body>

    <form class="form-container" action="{{ route('storelogin') }}" method="POST">
          @csrf
<p class="">Welcome Admin</p>
        <div class="form-outline mb-4">
                 <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control w-50" required />

        </div>

        <div class="form-outline mb-4">
               <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control w-50" required />

        </div>

        <button type="submit" name="login" class="btn btn-primary w-50">Login</button>
          <img src="{{ asset('magang/logopetro.png') }}" alt="logo" class="logo" >
    </form>
</body>
</html>
