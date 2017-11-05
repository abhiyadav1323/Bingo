#!/bin/env bash
# uses Cron to manage time period of operation.
python spidey.py # this script crawls the intranet
python index.py # this indexes the HTML pages
python index_doc.py # this indexes all type of documents such as pdfs, docs, etc.
exit 1