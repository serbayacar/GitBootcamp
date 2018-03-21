<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">
    <title>Oturum Aç-SocialEdu</title>
    <link rel="stylesheet" href="<?php  echo base_url()."\assets\global\css\loginStyle.css" ?>">
    <!--Google Font - Work Sans-->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="container">
    <div class="profile">
        <div class="profile_photo">
            <img src="<?php  echo base_url()."\assets\images\user_photo.png"?>" alt="Avatar"/>
        </div>
        <div class="profile__form">
            <div class="profile__fields">
                <div class="field">
                    <input type="text" id="fieldUser" class="input" required pattern=.*\S.*/>
                    <label for="fieldUser" class="label">Kullanıcı adı</label>
                </div>
                <div class="field">
                    <input type="password" id="fieldPassword" class="input" required pattern=.*\S.*/>
                    <label for="fieldPassword" class="label">Şifre</label>
                </div>
                <a href="#" class="forgot_link">Şifremi unuttum</a>
                <div class="profile__footer">
                    <button class="btn">Oturum Aç</button>
                </div>
                <div class="register">
                    <button class="btn">Kayıt Ol</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>