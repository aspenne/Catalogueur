#!/bin/bash

cp -r ../modele/ /Docker/aspen/
cp -r ../scripts/ /Docker/aspen/
cp -r ../samples/multi.json /Docker/aspen/scripts
cp -r ../samples/mono.json /Docker/aspen/scripts

docker image pull bigpapoo/sae4-html2pdf
docker image pull bigpapoo/sae4-php  

docker container run --rm -ti -v /Docker/aspen:/work bigpapoo/sae4-php php scripts/builder.php > /Docker/aspen/multi.html

mv /Docker/aspen/scripts/builder.css /Docker/aspen/builder.css

docker container run --rm -ti -v /Docker/aspen:/work bigpapoo/sae4-html2pdf "html2pdf multi.html multi.pdf"

mv /Docker/aspen/multi.pdf ../samples/multi.pdf
