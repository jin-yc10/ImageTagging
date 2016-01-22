import os,sys
import csv

def usage():
	print '-Usage:'
	print '\tpython extract_standard_item standarditempath [outputfilepath(.csv)]'

if len(sys.argv) < 2:
	usage()
else:
	standardItemPath = sys.argv[1]
	# standardItemPath = 'dataset/facedataset/standard_item/'
	allfiles = os.listdir(standardItemPath)

	if len(sys.argv) < 3:
		if standardItemPath.endswith('/'):
			standardItemPath = standardItemPath[0:-1]
		outputFilePath = standardItemPath + '.csv'
	else:
		outputFilePath = sys.argv[2]
	# output = open(outputFilePath,'w')

	with open(outputFilePath, 'w') as csvfile:
		fieldnames = ['name', 'slug','path']
		writer = csv.DictWriter(csvfile, fieldnames=fieldnames)

		for line in allfiles: 
			if line.startswith('.'):
				continue
			name = line.split('_')[0]
			slug = line.split('.')[0]
		   	path = os.path.join(standardItemPath,line)
		   	if os.path.isfile(path):
		   		print name,slug,path
		   		writer.writerow({'name':name, 'slug': slug, 'path':path})
		   		# output.write(name + ',' + slug + ',' + path + "\n")
	print outputFilePath
	# # output.close()

