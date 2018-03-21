<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Post-SocialEdu</title>
    <link rel="stylesheet" type="text/css" href="<?php  echo base_url()."\assets\global\css\postGirdi_style.css" ?>"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<!-- Genel -->
<div id="genel">
    <!-- Logo -->
    <div id="header">
        <div class="header">
            <div class="baslik"><a href="#"><img src="<?php  echo base_url()."\assets\images\logo.png"?>" alt=""/></a></div>
        </div>
    </div>
    <!-- Orta -->
    <div id="post">
        <label for="title" class="label">Başlık: </label>
        <input type="text" name="baslik" id="title">
        <br>
        <label for="selectKategori" class="label">Kategori: </label>
        <select id="selectKategori">
            <option value="kategori1">Kategori1</option>
            <option value="kategori2">Kategori2</option>
            <option value="kategori3">Kategori3</option>
            <option value="kategori4">Kategori4</option>
        </select>
        <br>
        <label for="altBaslik" class="label">Altbaşlık: </label>
        <select id="altBaslik">
            <option value="thread1">thread1</option>
            <option value="thread2">thread2</option>
            <option value="thread3">thread3</option>
            <option value="thread4">thread4</option>
        </select>
        <br>
        <label for="icerik" class="label icrk">İçerik: </label>
        <textarea name="icerik" id="icerik" rows="5" cols="100"></textarea>
        <br>
        <button class="btn">tamam</button>
    </div>
</div>

<!-- Temizleme -->
<div style="clear:both;"></div>

</body>
</html>