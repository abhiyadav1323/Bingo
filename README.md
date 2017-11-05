## Bingo
A generic search engine for intranet website of IIT Guwahati.

## Installing / Getting started

* Clone the repository by typing the following command in the shell.
```shell
git clone https://github.com/abhiyadav1323/Bingo.git
```

## Requirements
* Apache2 server
* PHP5
* Python 
* Whoosh (https://pypi.python.org/pypi/Whoosh/)

## Features
*	Provides three different interfaces for intranet search, Image Search and Form Search.
*	Provides five filters vis., .pdf, .doc, .exe, .zip, .iso, in Forms to narrow down searches.
*	Efficient and accurate Image search support for finding any picture on the local network.
*	Provides highlighted contents for indicating the relevant portion of the documents. 
*	Results sorted in order of relevance by url, title, and keyword frequency in content.
*	Matches edit distance of the query to give similar results – results are ordered by increasing edit distance.
*	Offers a did you mean feature to correct the user query.
*	Provides clickable links to all the urls.
*	Cronjob feature for automating crawling and indexing on a weekly basis. (using inbuilt Cron feature of Ubuntu)
*	Forms section provides direct links to the documents followed by urls of relevant webpages.
*	Voice search option to enhance user experience. 
*	Intelligent auto complete feature to help user in writing search queries.
*	Crawled approximately 25,000 urls on the IITG network using many regex filters and hashes to avoid duplicate and invalid pages. 
*	“I'm feeling lucky option” for the user to directly go to the first url of the search results.
*	Pagination feature to restrict the number of urls on a single page to enhance user interface.
*	Instant and live search feature to get results on the go.

## Licensing

The MIT License (MIT)

Copyright (c) 2016 Abhishek Yadav

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
