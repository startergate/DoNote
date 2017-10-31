<html lang="en">
  <head>
    <link rel="apple-touch-icon" sizes="57x57" href="/static/img/favicon/donote/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/static/img/favicon/donote/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/static/img/favicon/donote/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/static/img/favicon/donote/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/static/img/favicon/donote/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/static/img/favicon/donote/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/static/img/favicon/donote/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/static/img/favicon/donote/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/static/img/favicon/donote/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/static/img/favicon/donote/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/img/favicon/donote/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/static/img/favicon/donote/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/img/favicon/donote/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/static/img/favicon/donote/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="456580060753-4is76ugf9v0jqi0885kt4gpnb34nei0b.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <title>DoNote Ahlpa 0.1</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" type="text/css" href="./style2.css">
  </head>
  <body>
    <div class="container">
      <div class="col-md-9">
        <header class="jumbotron text-left">
          <h1>DoNote</h1>
        </header>
      </div>
      <div class="col-md-3">
        <header class="jumbotron text-center">
          <div id="control">
            <a href="./login.php" class="btn btn-success btn-lg">로그인</a>
          </div>
          <div id="control">
            <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
              <script>
                //function onSignIn(googleUser) {
                // Useful data for your client-side scripts:
                //var profile = googleUser.getBasicProfile();
                //console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                //console.log('Full Name: ' + profile.getName());
                //console.log('Given Name: ' + profile.getGivenName());
                //console.log('Family Name: ' + profile.getFamilyName());
                //console.log("Image URL: " + profile.getImageUrl());
                //console.log("Email: " + profile.getEmail());

                // The ID token you need to pass to your backend:
                //var id_token = googleUser.getAuthResponse().id_token;
                //console.log("ID Token: " + id_token);
              //};
            </script>
          </header>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <header class="jumbotron text-left">
            ⓒ 2017 STARTERGATE. This Content Can Be Used With GNU License.
          </header>
        </div>
      </div>
    </div>
  </body>
</html>
