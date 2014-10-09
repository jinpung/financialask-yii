#!/usr/bin/env python
# Kijan Maharjan, 2014 FinancialAsk
# Python 3

#This is responsible for "compiling" less.css files to regular css files for production. It also minifies the css at the same time. 

# There is an exact mapping of ONE TO ONE of pages to CSS files - each page should import ONLY ONE
# CSS file, which is actually one or more compiled less files. Dependencies are declared in map.py

import os
import sys
import re

o = open('pages', 'r')
pages = o.readlines()[4:]
        
dirCSS = 'css/'
dirLESS = 'less/'

done=1
for x in pages:
        x = x.rstrip()
        cmd = 'lessc -x %s.less > %s.css' % (dirLESS+x,dirCSS+x)
        msg = '[%d/%d] %d%% - {%s}' % (done,len(pages),done/float(len(pages))*100, cmd)
        print(msg)
        os.system(cmd)
        done+=1
