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

urls = file_to_list('doc.txt')
target=open('1.txt','a')
if not os.path.exists("indexdoc"):
    os.mkdir("indexdoc")
schema = Schema(ext=ID(stored=True), path=ID(stored=True), url=TEXT(stored=True))
ix = create_in("indexdoc", schema)
writer = ix.writer()
for page in urls:
	var = ['.',':','/','_','~','%',',','-','?','&','=','+']
	temp = page
	for v in var:
		temp = temp.replace(v,' ')
	k=page.rfind(".")
	ext=page[k:]
	print temp
	writer.add_document(ext=unicode(ext), path=unicode(page), url=unicode(temp))
	print 'indexed: ' + page
	
writer.commit()
target.close()