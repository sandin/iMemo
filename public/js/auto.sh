#!/bin/sh
#合并文件,并jsmin化
#目标文件:
#  本文件夹下所有js文件,
#	../share/下的所有js文件
#
#根据文件前的序号等级排序

rm all.min.js
#合并本文件夹中和share文件夹下所有js
cat ../share/*.js ../share/jquery/plugins/*.js *.*.js > all.js

#jsmin
#~/script/jsmin.py < all.js > all.temp.min.js
java -jar ~/script/yuicompressor-2.4.2/build/yuicompressor-2.4.2.jar all.js > all.min.js 

#删除临时文件
rm all.js
