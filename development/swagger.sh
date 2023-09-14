 #!/bin/bash

#mkdir ../public/swagger

php ../vendor/bin/openapi --format json --bootstrap ./swagger-constants.php --output ../public ./swagger-v1.php ../app/Http/Controllers/Api  ../app/Http/Controllers
