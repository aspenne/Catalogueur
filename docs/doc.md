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

