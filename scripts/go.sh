#!/bin/bash

cp -r ../modele/ /Docker/aspen/
cp -r ../scripts/ /Docker/aspen/

docker pull bigpapoo/sae4-html2pdf
docker pull bigpapoo/sae4-php


docker container run --rm -ti -v /Docker/aspen:/work bigpapoo/sae4-html2pdf "html2pdf modele/modele.html modele/modele.pdf"

mv /Docker/aspen/modele/modele.pdf ../modele/
