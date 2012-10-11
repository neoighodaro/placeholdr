<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlaceHoldr</title>
    <!--     <link href='http://fonts.googleapis.com/css?family=Knewave' rel='stylesheet' type='text/css'> -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
    <style type="text/css">
    html, body, .container{ height: 100%; margin: 0; padding: 0; }
    body {
        min-width: 200px;
        margin:0;
        color:#555;
        font-family:'Droid Sans', 'Helvetica Neue',Helvetica,sans-serif;
    }
    a{
        color: #EB5B49;
        text-decoration: none;
    }
    a:hover{
        color: #D43520;
    }
    .container {
        width:100%;
    }
    .container .header {
        background:#f0f0f0;
        padding-bottom: 80px;
    }
    .jumbo {
        text-align:center;
        padding:80px 0 50px;
    }
    .jumbo h1, .jumbo h4 {
        font-family:'Audiowide','Helvetica Neue',sans-serif;
    }
    .jumbo h1 {
        font-size:7.5em;
        text-transform:uppercase;
        margin:0;
        line-height:1em;
        color: #F3614E;
    }
    .jumbo h4 {
        font-size:1.5em;
        margin:0;
        text-transform:uppercase;
        line-height:1em;
    }
    .content {
        max-width:768px;
        margin:0 auto;
    }
    .showcase {
        text-align:center;
    }
    .showcase ul {
        list-style:none;
        list-style-type:none;
    }
    .showcase li {
        display: inline-block;
        margin:0 50px 0 0;
    }
    img.circular {
        -webkit-border-radius:100px;
            -moz-border-radius:100px;
                border-radius:100px;
    }
    footer {
        text-align:center;
        font-size:0.9em;
    }
    @media screen and (min-width:768px) {
        .content {
            max-width:950px;
        }
    }
    </style>
</head>
<body>
      <div class="container">
        <div class="header">
            <div class="jumbo">
                <h1>Placeholdr</h1>
                <h4>Simple placeholding images bundle for Laravel.</h4>
            </div>
            <div class="showcase">
                <ul>
                    <li>{{ HTML::placeholdr('200', null, array('class' => 'circular')) }}</li>
                    <li>{{ HTML::placeholdr('200', null, array('class' => 'circular')) }}</li>
                    <li>{{ HTML::placeholdr('200', null, array('class' => 'circular')) }}</li>
                </ul>
            </div>
        </div>
        <div class="content">
            {{ $content }}
        </div>
        <footer>&copy; 2012 <a href="http://github.com/CreativityKills/placeholdr/">PlaceHoldr for Laravel</a> by <a href="http://github.com/CreativityKills/">CreativityKills</a></footer>
      </div>
</body>
</html>