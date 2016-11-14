<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #f4f4f4;
                display: table;
                font-weight: bolder;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }

            #background {
                width: 100%; 
                height: 100%; 
                position: fixed; 
                left: 0px; 
                top: 0px; 
                z-index: -1; /* Ensure div tag stays behind content; -999 might work, too. */
            }

            .stretch {
                width:100%;
                height:100%;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">

                <div id="background">
                    <img src="http://holdinghandsdonations.com/imgs/bg-front.png" class="stretch" alt="" />
                </div>
                <div class="title">Sorry for keeping you waiting, <br/>be back in a few</div>
            </div>
        </div>
    </body>
</html>
