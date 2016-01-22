import os,sys
import csv

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

	with open(outputFilePath, 'w') as csvfile:
		fieldnames = ['slug','path']
		writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
		for dir in dirs:
			if dir.startswith('.'):
				continue
			dirpath = os.path.join(itemDir,dir)
			if os.path.isdir(dirpath):
				files = os.listdir(dirpath)
				for file in files:
					if file.startswith('.'):
						continue
					path = os.path.join(dirpath,file)
					slug = dir
					print slug,path
					writer.writerow({'slug': slug, 'path':path})
