<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/users/update" method="post">
        @csrf
        <input type="text" name="idUser" placeholder="Id">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="email" placeholder="email">
        <input type="pássword" name="password" placeholder="password">
        <input type="text" name="cellphone" placeholder="cellphone">
        <button type="submit">Update</button>
    </form>
</body>
</html>