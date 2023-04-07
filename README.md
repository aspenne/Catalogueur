# Catalogueur

---

## Introduction

Catalogueur is a tool who's working with the website [Alizon](http://alizon.website.com) (not online yet ) to create a catalog of many articles thats you select before on the website or eventually manually in the json files. 

---

## Utilisation

Before you necessarly need to have export mono.json or multi.json from the website Alizon and it need to be in the folder catalogueur/samples name as mono.json or multi.json, depending the number of sellers. They will be placed in this folder after export but if they are not, you can move them in this folder.

in command line :

```
git clone https://github.com/aspenne/catalogueur.git
cd catalogueur/scripts
chmod +x go.sh
./go.sh
```

**notice 1** : you need to be log as root to use the script. so prefix the command with sudo.

**notice 2** : if you have a muilti.json file and a mono.json file, the script will use the multi.json file.

After that in catalogueur/samples, the script gonna return you the pdf file in catalogueur/samples as mono.json or multi.json.



After the process all the file in .docker will be deleted.

---

## Docker

### Containers :

[html2pdf](https://hub.docker.com/r/bigpapoo/sae4-html2pdf) : Convert html to pdf <br>
[sae4-php](https://hub.docker.com/r/bigpapoo/sae4-php) :
Convert a dyamic php page to static html

## Contributing

[aspenne](https://github.com/aspenne)