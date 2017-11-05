import re
import httplib
import urllib2
import urllib
from urlparse import urlparse
from bs4 import BeautifulSoup
from collections import deque
import webbrowser
import socket
import requests
import hashlib
import logging
logging.captureWarnings(True)
from whoosh.index import create_in
from whoosh.fields import *
import os.path, os

def file_to_list(file_name):
    results = []
    with open(file_name, 'rt') as f:
        for line in f:
            results.append(line.replace('\n', ''))
    return results

urls = file_to_list('url.txt')
target=open('1.txt','a')
if not os.path.exists("indexdir"):
    os.mkdir("indexdir")
schema = Schema(title=TEXT(stored=True), path=ID(stored=True), url=TEXT, content=TEXT(stored=True, spelling=True))
ix = create_in("indexdir", schema)
writer = ix.writer()
for page in urls:
	title=""
	text=""
	try:
		pagesource=requests.get(page, verify=False, timeout=10)
		if str(pagesource.headers['Content-Type']).find('html') >= 0:
			s=pagesource.text
			soup=BeautifulSoup(s,'lxml')
			
			for script in soup(["script", "style"]):
				script.extract()    # rip it out
			# get text
			text = soup.get_text()

			# break into lines and remove leading and trailing space on each
			lines = (line.strip() for line in text.splitlines())
			# break multi-headlines into a line each
			chunks = (phrase.strip() for line in lines for phrase in line.split("  "))
			# drop blank lines
			text = '\n'.join(chunk for chunk in chunks if chunk)
			if soup.title:
				title = soup.title.string
			var = ['.',':','/','_','~','%',',','-','?','&','=','+']
			temp = page
			for v in var:
				temp = temp.replace(v,' ')
			writer.add_document(title=unicode(title), path=unicode(page), url=unicode(temp), content=unicode(text))
			print 'indexed: ' + page
	except:
		print 'not url: ' + page
		target.write(str(page) + '\n')
		continue
writer.commit()
target.close()