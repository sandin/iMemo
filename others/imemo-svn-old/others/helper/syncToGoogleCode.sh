#!/bin/sh
#将本地副本复制到google code

rm -fr /home/svn/0019/branches/googlecode/imemo/*
svn checkout https://imemo.googlecode.com/svn/trunk/ /home/svn/0019/branches/googlecode/imemo --username lds1129 --password dc7Hg4Pn8mQ5
cd /home/svn/0019/branches/googlecode/imemo
cp -r  /home/svn/0019/trunk/* .
#rm -rf `find ./ -name .svn`
svn ci -m 'sync'
