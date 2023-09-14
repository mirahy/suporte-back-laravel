<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Swagger UI</title>
        <link rel="stylesheet" type="text/css" href="css/swagger/swagger-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/swagger/index.css" />
        <link
            rel="icon"
            type="image/png"
            href="img/favicon-32x32.png"
            sizes="32x32"
        />
        <link
            rel="icon"
            type="image/png"
            href="img/favicon-16x16.png"
            sizes="16x16"
        />
    </head>
     {{-- gerar arquivo openapi.json --}}
    <?php
        require("../vendor/autoload.php");
        $openapi = \OpenApi\Generator::scan(['../app']);
        header('Content-Type: application/x-yaml');
        $openapi = json_encode($openapi);
        file_put_contents('./openapi.json', $openapi);
    ?>

    <body>
        <div class="container">

            <div id="swagger-ui">
            </div>
        </div>
        <script src="js/swagger/swagger-ui-bundle.js" charset="UTF-8"></script>
        <script
            src="js/swagger/swagger-ui-standalone-preset.js"
            charset="UTF-8"
        ></script>
        <script>
            window.onload = function () {
                // Build a system
                const ui = SwaggerUIBundle({
                    url: (url =
                        window.location.protocol +
                        "//" +
                        window.location.hostname +
                        ":" +
                        window.location.port +
                        "/openapi.json"),
                    dom_id: "#swagger-ui",
                    deepLinking: true,
                    presets: [
                        SwaggerUIBundle.presets.apis,
                        SwaggerUIStandalonePreset,
                    ],
                    plugins: [SwaggerUIBundle.plugins.DownloadUrl],
                    layout: "StandaloneLayout",
                });
                window.ui = ui;
            };
        </script>
        <!-- <script src="./swagger-initializer.js" charset="UTF-8"> </script> -->
    </body>
</html>
