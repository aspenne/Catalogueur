#!/bin/bash

cp -r ../modele/ /Docker/aspen/
cp -r ../scripts/ /Docker/aspen/
cp -r ../samples/multi.json /Docker/aspen/scripts
cp -r ../samples/mono.json /Docker/aspen/scripts

docker image pull bigpapoo/sae4-html2pdf
docker image pull bigpapoo/sae4-php  

# docker build -t alizon-website ../../
# docker build -t catalogueur ../

# docker network create alizon-network

# docker run -d --rm --name alizon-container --network alizon-network alizon-website
# docker run -d --rm --name catalogueur-container  --network alizon-network catalogueur

# docker container ls -a
# docker network inspect alizon-network 
# docker container ls -a

mv /Docker/aspen/scripts/builder.css /Docker/aspen/builder.css

if [ -f /Docker/aspen/scripts/multi.json ]; then
    docker container run --rm -ti -v /Docker/aspen:/work bigpapoo/sae4-php php scripts/builder.php > /Docker/aspen/multi.html
    docker container run --rm -ti -v /Docker/aspen:/work bigpapoo/sae4-html2pdf "html2pdf multi.html multi.pdf"
    mv /Docker/aspen/multi.pdf ../samples/multi.pdf
else
    docker container run --rm -ti -v /Docker/aspen:/work bigpapoo/sae4-php php scripts/builder.php > /Docker/aspen/mono.html
    docker container run --rm -ti -v /Docker/aspen:/work bigpapoo/sae4-html2pdf "html2pdf mono.html mono.pdf"
    mv /Docker/aspen/mono.pdf ../samples/mono.pdf
fi

rm -r /Docker/aspen/scripts
rm -r /Docker/aspen/modele
rm  /Docker/aspen/builder.css
rm /Docker/aspen/multi.html
rm /Docker/aspen/mono.html

# docker container rm alizon-website
# docker container rm catalogueur
