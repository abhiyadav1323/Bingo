#!/usr/bin/python
import sys, json
from whoosh.qparser import *
from whoosh.index import *
from whoosh.fields import *

try:
    data = json.loads(sys.argv[1])
except:
    print "ERROR"
    sys.exit(1)

fields=['url','title','content']
title={}
path={}
content={}
correct = {}
paths=set()
ix = open_dir("/var/www/html/search/indexdir")


def search(search_string):
    temp=""
    with ix.searcher() as searcher:
        c=0
        for j in range(0,2):
            inp = search_string
            edit_distance = j
            inp+="~"+str(edit_distance)
            for field in fields:
                parser = QueryParser(field, ix.schema)
                parser.add_plugin(FuzzyTermPlugin())
                query=parser.parse(str(inp))
                results = searcher.search(query,limit=None)
                for i in range(0,len(results)):
                    if results[i]['path'] not in paths:
                        paths.add(results[i]['path'])
                        path[c]=results[i]['path']
                        title[c]=results[i]['title']
                        if field == "url":
                            content[c]=results[i]['title']
                        else:
                            content[c]=results[i].highlights(field)
                        c = c+1
        if len(paths) is 0:
            corrected=searcher.correct_query(query,search_string)
            if corrected.query!=query:
                correct['corr'] = corrected.string
                temp = correct['corr']
    return temp


search_string = data['search']
temp = search(search_string)
if len(temp):
    search(temp)


# Send it to stdout (to PHP)
print json.dumps(title)
print json.dumps(path)
print json.dumps(content)
print json.dumps(correct)
