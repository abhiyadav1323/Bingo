import re
import httplib
import urllib2
from urlparse import urlparse
from bs4 import BeautifulSoup
from collections import deque
import webbrowser
import socket
import requests
import hashlib
import logging
logging.captureWarnings(True)

regex = re.compile(
		r'^(?:http|https|ftp)s?://|///|/' # http:// or https://
		r'(?:(?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)|' #domain...
		r'localhost|' #localhost...
		r'\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})' # ...or ip
		r'(?::\d+)?' # optional port
		r'(?:/?|[/?]\S+)$', re.IGNORECASE)

regexp = [re.compile(r'(&|\?)month=\d+'),
          re.compile(r'(&|\?)year=\d+'),
          re.compile(r'(&|\?)day=\d+'),
         ]

def isValidUrl(url):
	if str(url[0:4]) == "www.":
		return True
	if regex.match(str(url)) is not None:
		return True;
	return False

def check_domain_name(url):
	results = urlparse(url).netloc
	sub_domain = results.split('.')
	if len(sub_domain)>2:
		domain = sub_domain[-3] + '.' + sub_domain[-2] + '.' + sub_domain[-1]
		if domain == 'iitg.ernet.in' or domain == 'iitg.ac.in':
			return True
	return False

def crawler(SeedUrl):
	tocrawl=deque()
	tocrawl.append(SeedUrl)
	proxies = {
  	'http': 'http://ankit:bond@172.16.115.30:8080/',
  	'https': 'http://ankit:bond@172.16.115.30:8080/',
	}
	crawled=[]
	crawled.append(SeedUrl)
	crawled_hash=[]
	cnt=0
	target=open('url.txt','w')
	doc=open('doc.txt','w')
	skip=open('skip.txt','w')
	while tocrawl:
		page=tocrawl.popleft()
		page=page.encode('ascii','ignore')
		cnt=cnt+1
		flag=0
		for reg in regexp:
			if reg.search(str(page)) is not None:
				skip.write(page + '\n')
				print 'skipping: ' + page
				flag=1
				break
		if flag==1:
			continue
		if '?C=N;O=D' in page or '?C=M;O=A' in page or '?C=S;O=A' in page or '?C=D;O=A' in page or 'jatinga.iitg.ernet.in/~csesoftwarerepo' in page or 'calendar' in page or 'md/md' in page or 'eventcal' in page or ('news' in page and 'forum' in page) or ('day' in page and 'month' in page and 'year' in page) or 'listevents' in page or 'news/node' in page or 'icalrepeat' in page or 'search.form' in page or 'forums' in page or 'javascript' in page:
			skip.write(page + '\n')
			print 'skipping: ' + page
			continue 
		try:
			pagesource=requests.get(page, proxies=proxies, verify=False, timeout=10)
			if str(pagesource.headers['Content-Type']).find('html') == -1:
				print("document: " + str(page))
				doc.write(page + '\n')
				continue
		except:
			print "error: " + page
			target.write(page + '\n')
			continue
		
		s=pagesource.text
		soup=BeautifulSoup(s,'lxml')
		s=s.encode('ascii','ignore')
		m=hashlib.sha1(str(s)).hexdigest()
		if str(m) not in crawled_hash:
			crawled_hash.append(str(m))
			print "crawling: " + page
		else:
			continue
		target.write(page + '\n') 
		
		for link in soup.find_all('a'):
			if link.get('href'):
				temp=link.get('href').lstrip()
				temp=temp.encode('ascii','ignore')
				if 'mailto' in str(temp):
					continue
				if str(temp) not in crawled:
					if isValidUrl(str(temp)) and check_domain_name(str(temp)):
						tocrawl.append(str(temp))
						crawled.append(str(temp)) 
					elif isValidUrl(str(temp)):
						continue
					else:
						newstr=str(temp)
						if len(newstr) is 0:
							continue
						if newstr[0] is "#":
							continue
						if newstr[0] is "/":
							str1='http://' + urlparse(page).netloc + newstr
							if str1 not in crawled:
								tocrawl.append(str(str1))
								crawled.append(str(str1))
							continue
						urlval = str(page)
						k=urlval.rfind("/")
						newurlval=urlval[0:k+1]
						newurlval+=str(temp)
						if str(newurlval) not in crawled:
							tocrawl.append(str(newurlval))
							crawled.append(str(newurlval))
		for link in soup.find_all('frame'):
			if link.get('src'):
				temp=link.get('src').lstrip()
				temp=temp.encode('ascii','ignore')
				if 'mailto' in str(temp):
					continue
				if str(temp) not in crawled:
					if isValidUrl(str(temp)) and check_domain_name(str(temp)):
						tocrawl.append(str(temp))
						crawled.append(str(temp)) 
					elif isValidUrl(str(temp)):
						continue
					else:
						newstr=str(temp)
						if len(newstr) is 0:
							continue
						if newstr[0] is "#":
							continue
						if newstr[0] is "/":
							str1='http://' + urlparse(page).netloc + newstr
							if str1 not in crawled:
								tocrawl.append(str(str1))
								crawled.append(str(str1))
							continue
						urlval = str(page)
						k=urlval.rfind("/")
						newurlval=urlval[0:k+1]
						newurlval+=str(temp)
						if str(newurlval) not in crawled:
							tocrawl.append(str(newurlval))
							crawled.append(str(newurlval))
	target.close()
	doc.close()
	skip.close()
	print('Done! The number of webpages found are ' + str(cnt))
	
crawler('http://intranet.iitg.ernet.in/')
