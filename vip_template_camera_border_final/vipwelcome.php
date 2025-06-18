<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <link rel="stylesheet" href="welcomeStyle.css">
    <title>Snapbits</title>
<style>
    body {
    height: 100vh; 
    margin: 0;
    background-color: #564787;
}

.cookie-regular {
  font-family: "Cookie", cursive;
  font-weight: 400;
  font-style: normal;
}


.outfit-regular {
  font-family: "Outfit", sans-serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
}

.header {
    display: flex;
    padding: 20px;
    padding-bottom: 25px;
    height: 40px;
    margin: 0;
    background-color: #3d2f6d;
    justify-content: space-between;
    
}

.Logo {
    height: 50px;
    width: 60px;
    margin-right: 20px;
    margin-left: 20px;
    display: flex;
}

.logo {
    height: 50px;
    width: auto;
    margin-right: 20px;
    margin-left: 20px;
}

ul {
    font-family: century gothic;
    color: white;
    margin-right: 30px;
    
}

li {
    list-style: none;
    display: inline-block;
    font-weight: bold;
}

li a {
    color: white;
    text-decoration: none;
}

.headText {
    font-family: century gothic;
    color: white;
    font-weight: bold;
}

.center-content {
    text-align: center;
    color: white;
}

.snapBits {
    font-family: "Cookie", cursive;
    font-size: 90px;
    margin-top: 95px;
    margin-bottom: 0px;
    color: rgb(33, 27, 34);
}

.H3 {
    font-family: "Outfit", sans-serif;
    margin-top: 0px;
    color: rgb(65, 30, 63);
    justify-content: center;
    font-weight: lighter;
    font-size: 20px;
    margin-bottom: 40px;
}

button {
    border-radius: 20px;
    padding: 15px;
    height: auto;
    width: 180px;
    font-family: century gothic;
    font-weight: bold;
    background-color: #f0ccff;
    border-color: black;
}

.Film1 {
    align-items: center;
    justify-content: center;
    width: 100%;
}

.picture {
    flex-direction: row;
    margin: 0;
    justify-content: center;
    height: 90px;
    width: 100%;
}

.picture2 {
    margin-top: 60px;
}
.vip {
  display: flex;
  align-items: center;
}

.vipicon {
  height: 150px;
  width: auto;
  cursor: pointer;
}
</style>
</head>
<body style="background-image: url(welcomePics/purpleSky.jpg)">
<div class="top">
    <div class="header">
        <div class="Logo">
<img src="../Images/Logo.png" class="logo" alt="Logo">
            <p class="headText">SnapBits!</p>
        </div>
        <div class="vip">
<button onclick="window.location.href='/snapbits/welcome.html'" class="logout">Log Out</button>
        </div>
    </div>
</div>

<div class="Film1">
    <div class="picture">
        <img src="Images/Film.png" alt="Film">
    </div>
</div>

<div class="center-content">
    <h1 class = "snapBits">Welcome to SnapBits! our VIP</h1>
        <div class="H3">
            <h3>Snap to the Bits!</h3>
        </div>
    <button onclick="window.location.href='viptemplatepage.html'">Snap Your Piccy~</button>

</div>
</body>
</html>
