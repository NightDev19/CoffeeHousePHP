<?php
session_start();
include 'php/db.php';
$unique_id = $_SESSION['unique_id'];
$email = $_SESSION['email'];
if (empty($unique_id)) {
  header("Location: login.php");
}
$qry = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if (mysqli_num_rows($qry) > 0) {
  $row = mysqli_fetch_assoc($qry);
  if ($row) {
    $_SESSION['Role'] = $row['Role'];
    if ($row['verification_status'] != 'Verified') {
      header("Location: verify.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="css/loader.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", "sans-serif";
    }

    body {
      position: relative;
      width: 100%;
      height: 100vh;
    }

    a {
      text-decoration: none;
    }

    ul {
      list-style: none;
    }

    body {
      position: relative;
      width: 100%;
    }

    #header {
      display: flex;
      justify-content: space-between;
      padding: 25px;
      background: #ddd;
    }

    #header a.Logo h1 {
      text-transform: uppercase;
      color: #006692;
    }

    button.logout_btn {
      padding: 9px 25px;
      background-color: #006692;
      border-radius: 8px;
      border: 1px solid #00b3ff;
      cursor: pointer;
      transition: all 0.3s ease 0s;
      color: #f2f3f7;
      text-transform: uppercase;
      font-weight: 600;
      letter-spacing: 1px;
    }

    section {
      margin: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    span {
      color: #006698;
      cursor: pointer;
      text-decoration: underline;
    }

    .Welcome {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 20px;

    }

    .coffees {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      width: 200vh;
      height: 100vh;
      overflow-y: scroll;
      text-align: center;
      padding: 40px;
    }

    /* Scrollbar styles */
    ::-webkit-scrollbar {
      display: none;
      width: 12px;
      height: 12px;
    }

    ::-webkit-scrollbar-track {

      border: 1px solid yellowgreen;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {

      background: yellowgreen;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #88ba1c;
    }

    .coffees img {
      height: 200px;
      width: 200px;
      margin: 20px;
      border-radius: 5px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.29);
      transition: ease 0.6s;
    }

    .coffees img:hover {
      transform: scale(1.2);
    }

    .recommendations {
      margin-top: 40px;
    }

    footer {
      background-color: black;
      color: white;
      bottom: 0;
      width: 100vw;
      font-size: 16px;
    }

    footer * {
      box-sizing: border-box;
      border: none;
      outline: none;
    }

    .row {
      padding: 1em 1em;
    }

    .row.primary {
      display: grid;
      grid-template-columns: 3fr 2fr 4fr;
      align-items: stretch;
    }

    .column {
      width: 100%;
      display: flex;
      flex-direction: column;
      padding: 0 2em;
      min-height: 15em;
    }

    h3 {
      width: 100%;
      text-align: left;
      color: white;
      font-size: 1.4em;
      white-space: nowrap;
    }

    ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      padding: 0;
      margin: 0;
    }

    li:not(:first-child) {
      margin-top: 0.8em;
    }

    ul li a {
      color: #a7a7a7;
      text-decoration: none;
    }

    ul li a:hover {
      color: #c7940a;
    }

    .about p {
      text-align: justify;
      line-height: 2;
      margin: 0;
    }

    input,
    button {
      font-size: 1em;
      padding: 1em;
      width: 100%;
      border-radius: 5px;
      margin-bottom: 5px;
    }

    button {
      background-color: #c7940a;
      color: #ffffff;
    }

    div.social {
      display: flex;
      justify-content: space-around;
      font-size: 2.4em;
      flex-direction: row;
      margin-top: 0.5em;
    }

    .social i {
      color: #bac6d9;
    }

    .copyright {
      background-color: #25262e;
    }

    .footer-menu {
      float: left;
    }

    .footer-menu a {
      color: #cfd2d6;
      padding: 6px;
      text-decoration: none;
    }

    .footer-menu a:hover,
    .social i:hover {
      color: #c7940a;
    }

    .copyright p {
      font-size: 0.9em;
      text-align: right;
    }
  </style>

</head>

<body id="home">

  <header id="header">
    <a href="index.php" class="Logo">
      <h1>Logo</h1>
    </a>
    <nav>
      <ul class="navigation">
        <li><a href="php/logout.php?logout_id=<?php echo $unique_id ?>"><button class="logout_btn">Log Out</button></a></li>
      </ul>
    </nav>
  </header>

  <section>
    <div>
      <div class="Welcome">
        <h2>Welcome : <span><?php echo $email; ?></span></h2>
      </div>
      <div class="coffees">
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhTbQZ2EG5jX_K5cjc8S24yoCridYtMUZmFvfOVbL3vg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMaH-QN5Ujnfbj2zgx2pWBvaFRYZK5utGIaFSb2fCJqw&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC-fGY-qx6vaI3sOq_shGXKQ3Oo-V0NrGIjXGfQgLjTg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp1nMJtqi_S3lWkMD0LZCgogJhUUlHIe1ICVzCAYI7lg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhTbQZ2EG5jX_K5cjc8S24yoCridYtMUZmFvfOVbL3vg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMaH-QN5Ujnfbj2zgx2pWBvaFRYZK5utGIaFSb2fCJqw&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC-fGY-qx6vaI3sOq_shGXKQ3Oo-V0NrGIjXGfQgLjTg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp1nMJtqi_S3lWkMD0LZCgogJhUUlHIe1ICVzCAYI7lg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhTbQZ2EG5jX_K5cjc8S24yoCridYtMUZmFvfOVbL3vg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMaH-QN5Ujnfbj2zgx2pWBvaFRYZK5utGIaFSb2fCJqw&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC-fGY-qx6vaI3sOq_shGXKQ3Oo-V0NrGIjXGfQgLjTg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp1nMJtqi_S3lWkMD0LZCgogJhUUlHIe1ICVzCAYI7lg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhTbQZ2EG5jX_K5cjc8S24yoCridYtMUZmFvfOVbL3vg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMaH-QN5Ujnfbj2zgx2pWBvaFRYZK5utGIaFSb2fCJqw&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC-fGY-qx6vaI3sOq_shGXKQ3Oo-V0NrGIjXGfQgLjTg&s" alt="">
        </div>
        <div class="image">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp1nMJtqi_S3lWkMD0LZCgogJhUUlHIe1ICVzCAYI7lg&s" alt="">
        </div>

      </div>
      <div class="recommendations">
        <div class="Welcome">
          <h2>COFFEE SHOP <span>Recommendations</span></h2>
          <div class="images-maps">

          </div>
        </div>
      </div>
    </div>
  </section>
  
  <footer>
    <div class="row primary">
      <div class="column about">
        <h3>Connect</h3>
        <p>
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          Tanauan City ,Batangas
        </p>
        <div class="social">
          <i class="fa fa-facebook-square"></i>
          <i class="fa fa-twitter-square"></i>
          <i class="fa fa-linkedin-square"></i>
          <i class="fa fa-instagram"></i>
        </div>
      </div>

      <div class="column link">
        <h3>Links</h3>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#blogs">Blogs</a></li>
          <li><a href="#support">Support</a></li>
        </ul>
      </div>

      <div class="column subscribe">
        <h3>Newsletter</h3>
        <div>
          <input type="email" placeholder="Your email id here" />
          <button>Subscribe</button>
        </div>
      </div>
    </div>
    <div class="row copyright">
        <div class="footer-menu">

          <a href="index.php">Home</a>
          <a href="">F.A.Q</a>
          <a href="">Cookies Policy</a>
          <a href="">Terms Of Service</a>
          <a href="">Support</a>

        </div>
        <p>Copyright &copy; 2022</p>
      </div>
  </footer>

  <div id="loader">
    <div class="loader row-item">
      <span class="circle"></span>
      <span class="circle"></span>
      <span class="circle"></span>
      <span class="circle"></span>
      <span class="circle"></span>
    </div>
    <script>
      $(document).ready(function() {
        //Preloader
        preloaderFadeOutTime = 1200;

        function hidePreloader() {
          var preloader = $('#loader');
          preloader.fadeOut(preloaderFadeOutTime);
        }
        hidePreloader();
      });
    </script>
</body>

</html>