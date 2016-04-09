import os,sys
import csv
import locale

def sort_tuple_by_pinyin(datalist):
    return sorted(datalist,cmp = tuple_cmp)

def tuple_cmp(x,y):
    locale.setlocale(locale.LC_COLLATE, 'zh_CN@pinyin.utf8')
    return locale.strcoll(x[1],y[1])

def usage():
	print '-Usage:'
	print '\tpython extract_item.py itemDir [outputfilepath(.csv)]'

if len(sys.argv) < 2:
	usage()
else:
	itemDir = sys.argv[1]

	if len(sys.argv) < 3:
		if itemDir.endswith('/'):
			itemDir = itemDir[0:-1]
		outputFilePath = itemDir + '.csv'
	else:
		outputFilePath = sys.argv[2]

	dirs = os.listdir(itemDir)

	flists = []
	for dir in dirs:
		if dir.startswith('.'):
			continue
		dirpath = os.path.join(itemDir,dir)
		if os.path.isdir(dirpath):
			splitdir = os.listdir(dirpath)
			for splitd in splitdir:
				if splitd.startswith('.'):
					continue
				obj_path = os.path.join(dirpath,splitd)
				files = 	os.listdir(obj_path)
				for file in files:
					if file.startswith('.'):
						continue
					path = os.path.join(obj_path,file)
					slug = splitd
					flists.append((slug,path))

	with open(outputFilePath, 'w') as csvfile:
		fieldnames = ['slug','path']
		writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
		flists  = sort_tuple_by_pinyin(flists)
		for slug,path in flists:
			print slug,path
			writer.writerow({'slug': slug, 'path':path})
