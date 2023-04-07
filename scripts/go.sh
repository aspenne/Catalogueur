#!/bin/bash

username=$(whoami)

cp -r ../modele/ /Docker/$username/
cp -r ../scripts/ /Docker/$username/
cp -r ../samples/multi.json /Docker/$username/scripts
cp -r ../samples/mono.json /Docker/$username/scripts

docker image pull bigpapoo/sae4-html2pdf
docker image pull bigpapoo/sae4-php  

mv /Docker/$username/scripts/builder.css /Docker/$username/builder.css

if [ -f /Docker/$username/scripts/multi.json ]; then
    docker container run --rm -ti -v /Docker/$username:/work bigpapoo/sae4-php php scripts/builder.php > /Docker/$username/multi.html
    docker container run --rm -ti -v /Docker/$username:/work bigpapoo/sae4-html2pdf "html2pdf multi.html multi.pdf"
    mv /Docker/$username/multi.pdf ../samples/multi.pdf
else
    docker container run --rm -ti -v /Docker/$username:/work bigpapoo/sae4-php php scripts/builder.php > /Docker/$username/mono.html
    docker container run --rm -ti -v /Docker/$username:/work bigpapoo/sae4-html2pdf "html2pdf mono.html mono.pdf"
    mv /Docker/$username/mono.pdf ../samples/mono.pdf
fi

rm -r /Docker/$username/scripts
rm -r /Docker/$username/modele
rm  /Docker/$username/builder.css
rm /Docker/$username/multi.html
rm /Docker/$username/mono.html